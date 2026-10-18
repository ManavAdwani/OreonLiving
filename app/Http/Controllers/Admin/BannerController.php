<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageBanner;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function index(): View
    {
        $banners = HomepageBanner::orderBy('sort_order')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create(): View
    {
        return view('admin.banners.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'subtitle' => 'nullable|string|max:500',
            'badge_text' => 'nullable|string|max:100',
            'button_text' => 'required|string|max:60',
            'button_url' => 'required|string|max:255',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $imagePath = $validated['image_url'] ?? '';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
        }

        $banner = HomepageBanner::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'badge_text' => $validated['badge_text'] ?? null,
            'button_text' => $validated['button_text'],
            'button_url' => $validated['button_url'],
            'image_path' => $imagePath ?: 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1800&q=85',
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => $request->boolean('status', true),
        ]);

        AuditLogService::log(
            action: 'banner_created',
            entityType: 'HomepageBanner',
            entityId: $banner->id,
            entityName: $banner->title,
            description: "Created homepage banner '{$banner->title}'"
        );

        return redirect()->route('admin.banners.index')->with('success', 'Banner created.');
    }

    public function edit(HomepageBanner $banner): View
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, HomepageBanner $banner): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'subtitle' => 'nullable|string|max:500',
            'badge_text' => 'nullable|string|max:100',
            'button_text' => 'required|string|max:60',
            'button_url' => 'required|string|max:255',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'badge_text' => $validated['badge_text'] ?? null,
            'button_text' => $validated['button_text'],
            'button_url' => $validated['button_url'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => $request->boolean('status'),
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('banners', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image_path'] = $request->input('image_url');
        }

        $banner->update($data);

        AuditLogService::log(
            action: 'banner_updated',
            entityType: 'HomepageBanner',
            entityId: $banner->id,
            entityName: $banner->title,
            description: "Updated homepage banner '{$banner->title}'"
        );

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated.');
    }

    public function destroy(HomepageBanner $banner): RedirectResponse
    {
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted.');
    }
}
