<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\WebsiteSetting;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\Payment\PaymentGatewayInterface;
use App\Services\PincodeService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected OrderService $orderService,
        protected PaymentGatewayInterface $paymentGateway,
        protected PincodeService $pincodeService
    ) {}

    public function index(): View|RedirectResponse
    {
        $calculations = $this->cartService->getCalculations();

        if ($calculations['items_count'] === 0) {
            return redirect()->route('cart.index')->with('info', 'Your cart is empty. Please add items before checking out.');
        }

        $user = Auth::user();
        $savedAddresses = $user ? $user->addresses : collect();
        $defaultAddress = $user ? $user->addresses()->where('is_default', true)->first() : null;

        return view('web.checkout.index', array_merge($calculations, [
            'user' => $user,
            'savedAddresses' => $savedAddresses,
            'defaultAddress' => $defaultAddress,
        ]));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:150',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'country' => 'nullable|string|max:60',
            'payment_method' => 'required|in:upi,card,cod,netbanking',
            'notes' => 'nullable|string|max:500',
            'save_address' => 'nullable|boolean',
        ]);

        // Save address for logged-in user if checked
        if (Auth::check() && $request->boolean('save_address')) {
            Address::create([
                'user_id' => Auth::id(),
                'type' => 'shipping',
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'address_line_1' => $validated['address_line_1'],
                'address_line_2' => $validated['address_line_2'] ?? null,
                'landmark' => $validated['landmark'] ?? null,
                'city' => $validated['city'],
                'state' => $validated['state'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'] ?? 'India',
                'is_default' => Auth::user()->addresses()->count() === 0,
            ]);
        }

        try {
            $order = $this->orderService->createOrder(
                customerData: $validated,
                paymentMethod: $validated['payment_method'],
                notes: $validated['notes'] ?? null,
                utmData: [
                    'utm_source' => session('utm_source'),
                    'utm_medium' => session('utm_medium'),
                    'utm_campaign' => session('utm_campaign'),
                ]
            );

            return redirect()->route('order.confirmation', $order->order_number);
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function confirmation(string $orderNumber): View
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['items.product.images'])
            ->firstOrFail();

        $upiData = $this->paymentGateway->generateUpiPayload($order);
        $whatsappNumber = WebsiteSetting::get('whatsapp_number', '919876543210');

        // Pre-filled WhatsApp message for order confirmation (Item 150 & 152 in PDF)
        $waText = "Hello Oréon Living, I placed Order #{$order->order_number} for ₹" . number_format($order->total, 2) . ". Please confirm my order details.";
        $whatsappOrderUrl = "https://wa.me/{$whatsappNumber}?text=" . urlencode($waText);

        return view('web.checkout.confirmation', compact('order', 'upiData', 'whatsappOrderUrl'));
    }

    public function invoice(string $orderNumber): View
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['items.product'])
            ->firstOrFail();

        return view('web.checkout.invoice', compact('order'));
    }
}
