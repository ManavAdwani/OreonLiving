<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function index(): View
    {
        $staffMembers = User::where('role', '!=', 'customer')->latest()->get();
        return view('admin.staff.index', compact('staffMembers'));
    }

    public function create(): View
    {
        $roles = [
            'super_admin' => 'Super Admin (Full access to everything)',
            'content_manager' => 'Content Manager (Homepage, banners, FAQs, website text & copy)',
            'product_manager' => 'Product Manager (Add/edit products, prices, stock, images)',
            'order_manager' => 'Order Manager (View orders, status updates, shipping tracking)',
            'customer_support' => 'Customer Support (Customer details, inquiries, WhatsApp leads)',
            'marketing_manager' => 'Marketing Manager (Coupons, tracking, campaigns, basic reports)',
            'viewer' => 'Viewer (Read-only data access)',
        ];

        return view('admin.staff.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:150|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:super_admin,content_manager,product_manager,order_manager,customer_support,marketing_manager,viewer',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'is_active' => true,
            'password' => Hash::make($validated['password']),
        ]);

        AuditLogService::log(
            action: 'staff_created',
            entityType: 'User',
            entityId: $user->id,
            entityName: $user->name,
            description: "Super Admin created staff member '{$user->name}' with role '{$user->role}'"
        );

        return redirect()->route('admin.staff.index')->with('success', 'Staff account created successfully.');
    }

    public function toggleStatus(User $staff): RedirectResponse
    {
        abort_if($staff->id === auth()->id(), 403, 'You cannot deactivate your own account.');

        $staff->is_active = !$staff->is_active;
        $staff->save();

        $action = $staff->is_active ? 'activated' : 'deactivated';

        AuditLogService::log(
            action: 'staff_status_changed',
            entityType: 'User',
            entityId: $staff->id,
            entityName: $staff->name,
            description: "Staff account '{$staff->name}' was {$action}"
        );

        return back()->with('success', "Staff account {$action}.");
    }

    public function resetPassword(Request $request, User $staff): RedirectResponse
    {
        $request->validate(['password' => 'required|string|min:8']);

        $staff->password = Hash::make($request->input('password'));
        $staff->save();

        AuditLogService::log(
            action: 'staff_password_reset',
            entityType: 'User',
            entityId: $staff->id,
            entityName: $staff->name,
            description: "Super Admin reset password for staff '{$staff->name}'"
        );

        return back()->with('success', "Password reset for {$staff->name}.");
    }
}
