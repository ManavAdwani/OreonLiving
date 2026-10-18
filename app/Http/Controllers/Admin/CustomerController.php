<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::where('role', 'customer')
            ->withCount('orders')
            ->withSum('orders', 'total');

        if ($request->filled('search')) {
            $s = $request->query('search');
            $query->where(function ($q) use ($s) {
                $q->where('name', 'LIKE', "%{$s}%")
                  ->orWhere('email', 'LIKE', "%{$s}%")
                  ->orWhere('phone', 'LIKE', "%{$s}%");
            });
        }

        $customers = $query->latest()->paginate(15)->withQueryString();
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer): View
    {
        abort_if($customer->role !== 'customer', 404);

        $customer->load(['addresses', 'orders.items']);
        return view('admin.customers.show', compact('customer'));
    }
}
