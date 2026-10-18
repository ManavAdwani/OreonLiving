<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'slug' => 'nullable|string|max:120|unique:categories,slug',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:3072',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $slug = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        $category = Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'parent_id' => $validated['parent_id'] ?? null,
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'status' => $request->boolean('status', true),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        AuditLogService::log(
            action: 'category_created',
            entityType: 'Category',
            entityId: $category->id,
            entityName: $category->name,
            description: "Created category '{$category->name}'"
        );

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        $parentCategories = Category::whereNull('parent_id')->where('id', '!=', $category->id)->get();
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'slug' => 'required|string|max:120|unique:categories,slug,' . $category->id,
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:3072',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data = [
            'name' => $validated['name'],
            'slug' => Str::slug($validated['slug']),
            'parent_id' => $validated['parent_id'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $request->boolean('status'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        AuditLogService::log(
            action: 'category_updated',
            entityType: 'Category',
            entityId: $category->id,
            entityName: $category->name,
            description: "Updated category '{$category->name}'"
        );

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->count() > 0) {
            return back()->with('error', "Cannot delete category '{$category->name}' because it contains products.");
        }

        $name = $category->name;
        $category->delete();

        AuditLogService::log(
            action: 'category_deleted',
            entityType: 'Category',
            entityId: null,
            entityName: $name,
            description: "Deleted category '{$name}'"
        );

        return redirect()->route('admin.categories.index')->with('success', "Category '{$name}' removed.");
    }
}
