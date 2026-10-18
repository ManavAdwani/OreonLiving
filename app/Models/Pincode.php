<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    use HasFactory;

    protected $fillable = [
        'pincode',
        'city',
        'state',
        'is_serviceable',
        'estimated_days',
        'cod_available',
        'shipping_charge',
    ];

    protected function casts(): array
    {
        return [
            'is_serviceable' => 'boolean',
            'cod_available' => 'boolean',
            'estimated_days' => 'integer',
            'shipping_charge' => 'decimal:2',
        ];
    }
}
