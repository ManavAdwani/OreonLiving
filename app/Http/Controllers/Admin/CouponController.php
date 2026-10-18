<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponController extends Controller
{
    public function index(): View
    {
        $coupons = Coupon::latest()->paginate(15);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create(): View
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:30|unique:coupons,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0.01',
            'minimum_order' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
            'status' => 'nullable|boolean',
        ]);

        $coupon = Coupon::create([
            'code' => strtoupper(trim($validated['code'])),
            'type' => $validated['type'],
            'value' => $validated['value'],
            'minimum_order' => $validated['minimum_order'] ?? 0,
            'max_discount' => $validated['max_discount'] ?? null,
            'max_uses' => $validated['max_uses'] ?? null,
            'starts_at' => $validated['starts_at'] ?? null,
            'expires_at' => $validated['expires_at'] ?? null,
            'status' => $request->boolean('status', true),
        ]);

        AuditLogService::log(
            action: 'coupon_created',
            entityType: 'Coupon',
            entityId: $coupon->id,
            entityName: $coupon->code,
            description: "Created discount coupon '{$coupon->code}' ({$coupon->type} {$coupon->value})"
        );

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created.');
    }

    public function edit(Coupon $coupon): View
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:30|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0.01',
            'minimum_order' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
            'status' => 'nullable|boolean',
        ]);

        $coupon->update([
            'code' => strtoupper(trim($validated['code'])),
            'type' => $validated['type'],
            'value' => $validated['value'],
            'minimum_order' => $validated['minimum_order'] ?? 0,
            'max_discount' => $validated['max_discount'] ?? null,
            'max_uses' => $validated['max_uses'] ?? null,
            'starts_at' => $validated['starts_at'] ?? null,
            'expires_at' => $validated['expires_at'] ?? null,
            'status' => $request->boolean('status'),
        ]);

        AuditLogService::log(
            action: 'coupon_updated',
            entityType: 'Coupon',
            entityId: $coupon->id,
            entityName: $coupon->code,
            description: "Updated discount coupon '{$coupon->code}'"
        );

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated.');
    }

    public function destroy(Coupon $coupon): RedirectResponse
    {
        $code = $coupon->code;
        $coupon->delete();

        AuditLogService::log(
            action: 'coupon_deleted',
            entityType: 'Coupon',
            entityId: null,
            entityName: $code,
            description: "Deleted coupon '{$code}'"
        );

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted.');
    }
}
