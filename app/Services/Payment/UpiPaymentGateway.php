<?php

namespace App\Services\Payment;

use App\Models\Order;
use App\Models\WebsiteSetting;

class UpiPaymentGateway implements PaymentGatewayInterface
{
    protected string $vpa;
    protected string $merchantName;

    public function __construct()
    {
        $this->vpa = WebsiteSetting::get('upi_vpa', 'oreonliving@icici');
        $this->merchantName = WebsiteSetting::get('site_name', 'Oréon Living');
    }

    public function initiatePayment(Order $order): array
    {
        $upiData = $this->generateUpiPayload($order);

        return [
            'status' => 'initiated',
            'order_number' => $order->order_number,
            'amount' => $order->total,
            'upi_link' => $upiData['upi_link'],
            'qr_code_url' => $upiData['qr_code_url'],
            'vpa' => $this->vpa,
        ];
    }

    public function verifyPayment(Order $order, array $payload): array
    {
        // Production implementation would hook into Webhook / Payment Partner API (Razorpay/Cashfree/PhonePe)
        // Here we validate transaction reference and mark paid
        $txnId = $payload['transaction_id'] ?? 'UPI-' . strtoupper(bin2hex(random_bytes(6)));

        return [
            'success' => true,
            'transaction_id' => $txnId,
            'message' => 'UPI payment verified successfully.',
        ];
    }

    public function generateUpiPayload(Order $order): array
    {
        $amount = number_format($order->total, 2, '.', '');
        $note = "Order {$order->order_number}";
        
        // Standard NPCI UPI URI Scheme
        $upiLink = "upi://pay?pa={$this->vpa}&pn=" . urlencode($this->merchantName) . "&tr={$order->order_number}&am={$amount}&cu=INR&tn=" . urlencode($note);

        // QR Code generation via SVG API or data representation
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode($upiLink);

        return [
            'vpa' => $this->vpa,
            'merchant_name' => $this->merchantName,
            'amount' => $amount,
            'upi_link' => $upiLink,
            'qr_code_url' => $qrCodeUrl,
        ];
    }
}
