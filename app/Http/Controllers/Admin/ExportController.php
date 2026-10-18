<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function orders(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="oreon_orders_' . date('Ymd_His') . '.csv"',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Order Number', 'Date', 'Customer Name', 'Email', 'Phone', 'Subtotal', 'Discount', 'Shipping', 'Total', 'Payment Method', 'Payment Status', 'Order Status', 'Tracking Number', 'UTM Source']);

            Order::latest()->chunk(100, function ($orders) use ($handle) {
                foreach ($orders as $order) {
                    fputcsv($handle, [
                        $order->order_number,
                        $order->created_at->format('Y-m-d H:i:s'),
                        $order->customer_name,
                        $order->customer_email,
                        $order->customer_phone,
                        $order->subtotal,
                        $order->discount,
                        $order->shipping_fee,
                        $order->total,
                        strtoupper($order->payment_method),
                        ucfirst($order->payment_status),
                        ucfirst($order->order_status),
                        $order->tracking_number ?? 'N/A',
                        $order->utm_source ?? 'Direct',
                    ]);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

    public function products(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="oreon_products_' . date('Ymd_His') . '.csv"',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'SKU', 'Name', 'Category', 'Price (INR)', 'Compare Price', 'Stock', 'Low Stock Threshold', 'Status', 'Material', 'Weight (g)']);

            Product::with('category')->latest()->chunk(100, function ($products) use ($handle) {
                foreach ($products as $p) {
                    fputcsv($handle, [
                        $p->id,
                        $p->sku,
                        $p->name,
                        $p->category?->name,
                        $p->price,
                        $p->compare_price,
                        $p->stock,
                        $p->low_stock_threshold,
                        $p->status,
                        $p->material,
                        $p->weight_grams,
                    ]);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }

    public function customers(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="oreon_customers_' . date('Ymd_His') . '.csv"',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Name', 'Email', 'Phone', 'Registered Date', 'Orders Count', 'Total Spent (INR)']);

            User::where('role', 'customer')
                ->withCount('orders')
                ->withSum('orders', 'total')
                ->latest()
                ->chunk(100, function ($customers) use ($handle) {
                    foreach ($customers as $c) {
                        fputcsv($handle, [
                            $c->id,
                            $c->name,
                            $c->email,
                            $c->phone ?? 'N/A',
                            $c->created_at->format('Y-m-d H:i:s'),
                            $c->orders_count,
                            $c->orders_sum_total ?? 0,
                        ]);
                    }
                });

            fclose($handle);
        }, 200, $headers);
    }
}
