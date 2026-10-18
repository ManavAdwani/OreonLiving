<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->isStaff()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            if (!$user->isStaff() || !$user->is_active) {
                Auth::logout();
                return back()->with('error', 'Access restricted. Please sign in with an active staff account.');
            }

            $request->session()->regenerate();

            AuditLogService::log(
                action: 'staff_login',
                entityType: 'User',
                entityId: $user->id,
                entityName: $user->name,
                description: "Staff member logged in ({$user->role})"
            );

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'Invalid staff credentials.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if ($user) {
            AuditLogService::log(
                action: 'staff_logout',
                entityType: 'User',
                entityId: $user->id,
                entityName: $user->name,
                description: "Staff member logged out ({$user->role})"
            );
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been securely logged out.');
    }
}
