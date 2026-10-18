<?php

namespace App\Services\Payment;

use App\Models\Order;

interface PaymentGatewayInterface
{
    /**
     * Initiate payment transaction for an order
     */
    public function initiatePayment(Order $order): array;

    /**
     * Verify payment status
     */
    public function verifyPayment(Order $order, array $payload): array;

    /**
     * Generate UPI deep link & QR payload
     */
    public function generateUpiPayload(Order $order): array;
}
