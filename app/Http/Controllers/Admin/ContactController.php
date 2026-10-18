<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Models\WebsiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(Request $request): View
    {
        $query = ContactSubmission::query();

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        $submissions = $query->latest()->paginate(15)->withQueryString();
        return view('admin.contacts.index', compact('submissions'));
    }

    public function show(ContactSubmission $contact): View
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $contact->phone ?? '');
        $whatsappUrl = $cleanPhone ? "https://wa.me/{$cleanPhone}?text=" . urlencode("Hello {$contact->name}, regarding your Oreon Living inquiry: ") : null;

        return view('admin.contacts.show', compact('contact', 'whatsappUrl'));
    }

    public function updateStatus(Request $request, ContactSubmission $contact): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:new,in_progress,resolved',
            'admin_notes' => 'nullable|string',
        ]);

        $contact->update($validated);

        return back()->with('success', 'Inquiry status updated.');
    }
}
