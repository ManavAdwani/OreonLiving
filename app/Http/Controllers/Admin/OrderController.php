<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\WebsiteSetting;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::with(['items', 'user']);

        if ($request->filled('status')) {
            $query->where('order_status', $request->query('status'));
        }

        if ($request->filled('search')) {
            $s = $request->query('search');
            $query->where(function ($q) use ($s) {
                $q->where('order_number', 'LIKE', "%{$s}%")
                  ->orWhere('customer_name', 'LIKE', "%{$s}%")
                  ->orWhere('customer_email', 'LIKE', "%{$s}%")
                  ->orWhere('customer_phone', 'LIKE', "%{$s}%")
                  ->orWhere('tracking_number', 'LIKE', "%{$s}%");
            });
        }

        $orders = $query->latest()->paginate(15)->withQueryString();
        $statuses = ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled', 'return_requested', 'refunded'];

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show(Order $order): View
    {
        $order->load(['items.product.images', 'user']);
        $whatsappNumber = WebsiteSetting::get('whatsapp_number', '919876543210');
        $customerPhone = preg_replace('/[^0-9]/', '', $order->customer_phone);

        // Pre-filled WhatsApp notification message for customer (Item 110 & 152 in PDF)
        $waMsg = "Hello {$order->customer_name}, your Oreon Living Order #{$order->order_number} has been updated to: " . strtoupper($order->order_status) . ".";
        if ($order->tracking_number) {
            $waMsg .= " Tracking Number: {$order->tracking_number} ({$order->carrier_name}).";
        }
        $whatsappNotifyUrl = "https://wa.me/{$customerPhone}?text=" . urlencode($waMsg);

        return view('admin.orders.show', compact('order', 'whatsappNotifyUrl'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'order_status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled,return_requested,refunded',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'carrier_name' => 'nullable|string|max:100',
            'tracking_number' => 'nullable|string|max:100',
            'tracking_url' => 'nullable|url|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $oldStatus = $order->order_status;
        $order->update($validated);

        AuditLogService::log(
            action: 'order_status_updated',
            entityType: 'Order',
            entityId: $order->id,
            entityName: $order->order_number,
            description: "Order #{$order->order_number} status changed from {$oldStatus} to {$order->order_status}",
            oldValues: ['order_status' => $oldStatus],
            newValues: ['order_status' => $order->order_status]
        );

        return back()->with('success', "Order #{$order->order_number} has been updated.");
    }
}
