<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(Request $request): View
    {
        $query = ActivityLog::with('user');

        if ($request->filled('action')) {
            $query->where('action', $request->query('action'));
        }

        if ($request->filled('search')) {
            $s = $request->query('search');
            $query->where(function ($q) use ($s) {
                $q->where('entity_name', 'LIKE', "%{$s}%")
                  ->orWhere('user_name', 'LIKE', "%{$s}%")
                  ->orWhere('description', 'LIKE', "%{$s}%");
            });
        }

        $logs = $query->latest()->paginate(25)->withQueryString();
        return view('admin.activity-logs.index', compact('logs'));
    }
}
