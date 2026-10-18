<?php

namespace App\Services;

use App\Models\Pincode;

class PincodeService
{
    public function check(string $pincode): array
    {
        $cleanPincode = trim($pincode);
        $record = Pincode::where('pincode', $cleanPincode)->first();

        if ($record && $record->is_serviceable) {
            return [
                'serviceable' => true,
                'city' => $record->city,
                'state' => $record->state,
                'estimated_days' => $record->estimated_days,
                'estimated_date' => now()->addDays($record->estimated_days)->format('D, d M'),
                'cod_available' => $record->cod_available,
                'shipping_charge' => $record->shipping_charge,
                'message' => "Delivery available to {$record->city}, {$record->state} in {$record->estimated_days} business days.",
            ];
        }

        // Generic fallback check for valid 6 digit Indian pin code
        if (preg_match('/^[1-9][0-9]{5}$/', $cleanPincode)) {
            return [
                'serviceable' => true,
                'city' => 'Standard Hub',
                'state' => 'India',
                'estimated_days' => 5,
                'estimated_date' => now()->addDays(5)->format('D, d M'),
                'cod_available' => true,
                'shipping_charge' => 0.0,
                'message' => "Standard courier delivery available (approx. 4-6 business days).",
            ];
        }

        return [
            'serviceable' => false,
            'message' => 'Please enter a valid 6-digit Indian postal code.',
        ];
    }
}
