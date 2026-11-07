<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Services\AuditLogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with(['category', 'images']);

        if ($request->filled('search')) {
            $s = $request->query('search');
            $query->where(function ($q) use ($s) {
                $q->where('name', 'LIKE', "%{$s}%")
                  ->orWhere('sku', 'LIKE', "%{$s}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->query('category_id'));
        }

        if ($request->filled('stock_status')) {
            if ($request->query('stock_status') === 'low') {
                $query->whereColumn('stock', '<=', 'low_stock_threshold')->where('stock', '>', 0);
            } elseif ($request->query('stock_status') === 'out') {
                $query->where('stock', '<=', 0);
            }
        }

        $products = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::active()->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::active()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200|unique:products,slug',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'low_stock_threshold' => 'required|integer|min:0',
            'weight_grams' => 'nullable|integer|min:0',
            'dimensions' => 'nullable|string|max:150',
            'material' => 'nullable|string|max:200',
            'care_instructions' => 'nullable|string',
            'video_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published,archived',
            'featured' => 'nullable|boolean',
            'bestseller' => 'nullable|boolean',
            'seo_title' => 'nullable|string|max:150',
            'seo_description' => 'nullable|string|max:300',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $slug = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        // Ensure unique slug
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        // Auto-generate SKU if blank (PDF item 117)
        $sku = $validated['sku'] ?: 'OL-' . strtoupper(Str::random(3)) . '-' . rand(100, 999);

        $product = Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'sku' => $sku,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'compare_price' => $validated['compare_price'] ?? null,
            'cost_price' => $validated['cost_price'] ?? null,
            'stock' => $validated['stock'],
            'low_stock_threshold' => $validated['low_stock_threshold'] ?? 5,
            'weight_grams' => $validated['weight_grams'] ?? null,
            'dimensions' => $validated['dimensions'] ?? null,
            'material' => $validated['material'] ?? null,
            'care_instructions' => $validated['care_instructions'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
            'status' => $validated['status'],
            'featured' => $request->boolean('featured'),
            'bestseller' => $request->boolean('bestseller'),
            'seo_title' => $validated['seo_title'] ?? $validated['name'] . ' | Oréon Living',
            'seo_description' => $validated['seo_description'] ?? $validated['short_description'],
        ]);

        // Upload images if provided
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'alt_text' => $product->name,
                    'sort_order' => $index,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        AuditLogService::log(
            action: 'product_created',
            entityType: 'Product',
            entityId: $product->id,
            entityName: $product->name,
            description: "Product '{$product->name}' was created (SKU: {$product->sku}, Price: ₹{$product->price})"
        );

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::active()->get();
        $product->load(['images', 'variants']);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:products,slug,' . $product->id,
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'low_stock_threshold' => 'required|integer|min:0',
            'weight_grams' => 'nullable|integer|min:0',
            'dimensions' => 'nullable|string|max:150',
            'material' => 'nullable|string|max:200',
            'care_instructions' => 'nullable|string',
            'video_url' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published,archived',
            'featured' => 'nullable|boolean',
            'bestseller' => 'nullable|boolean',
            'seo_title' => 'nullable|string|max:150',
            'seo_description' => 'nullable|string|max:300',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $oldPrice = $product->price;
        $oldStock = $product->stock;

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['slug']),
            'sku' => $validated['sku'],
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'compare_price' => $validated['compare_price'] ?? null,
            'cost_price' => $validated['cost_price'] ?? null,
            'stock' => $validated['stock'],
            'low_stock_threshold' => $validated['low_stock_threshold'] ?? 5,
            'weight_grams' => $validated['weight_grams'] ?? null,
            'dimensions' => $validated['dimensions'] ?? null,
            'material' => $validated['material'] ?? null,
            'care_instructions' => $validated['care_instructions'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
            'status' => $validated['status'],
            'featured' => $request->boolean('featured'),
            'bestseller' => $request->boolean('bestseller'),
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
        ]);

        // Upload additional images
        if ($request->hasFile('images')) {
            $currentMaxOrder = $product->images()->max('sort_order') ?? 0;
            foreach ($request->file('images') as $i => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'alt_text' => $product->name,
                    'sort_order' => $currentMaxOrder + $i + 1,
                    'is_primary' => $product->images()->count() === 0,
                ]);
            }
        }

        // Audit Logging (Item 133 & 174 in PDF)
        $auditDescription = "Updated product '{$product->name}'";
        if ($oldPrice != $product->price) {
            $auditDescription .= ". Price changed from ₹{$oldPrice} to ₹{$product->price}";
        }
        if ($oldStock != $product->stock) {
            $auditDescription .= ". Stock updated from {$oldStock} to {$product->stock}";
        }

        AuditLogService::log(
            action: 'product_updated',
            entityType: 'Product',
            entityId: $product->id,
            entityName: $product->name,
            description: $auditDescription,
            oldValues: ['price' => $oldPrice, 'stock' => $oldStock],
            newValues: ['price' => $product->price, 'stock' => $product->stock]
        );

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Quick price & stock update without full edit screen (PDF items 96 & 97)
     */
    public function quickUpdate(Request $request, Product $product): JsonResponse
    {
        $validated = $request->validate([
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
        ]);

        $oldPrice = $product->price;
        $oldStock = $product->stock;

        if (isset($validated['price'])) {
            $product->price = $validated['price'];
        }
        if (isset($validated['stock'])) {
            $product->stock = $validated['stock'];
        }
        $product->save();

        AuditLogService::log(
            action: 'product_quick_updated',
            entityType: 'Product',
            entityId: $product->id,
            entityName: $product->name,
            description: "Quick update for '{$product->name}': Price ₹{$oldPrice} -> ₹{$product->price}, Stock {$oldStock} -> {$product->stock}",
            oldValues: ['price' => $oldPrice, 'stock' => $oldStock],
            newValues: ['price' => $product->price, 'stock' => $product->stock]
        );

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully.',
            'price' => number_format($product->price, 2),
            'stock' => $product->stock,
        ]);
    }

    public function deleteImage(int $imageId): JsonResponse|RedirectResponse
    {
        $image = ProductImage::findOrFail($imageId);
        $productId = $image->product_id;
        
        if (!str_starts_with($image->image_path, 'http')) {
            Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();

        return back()->with('success', 'Product photo removed.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;
        $id = $product->id;
        $product->delete();

        AuditLogService::log(
            action: 'product_deleted',
            entityType: 'Product',
            entityId: $id,
            entityName: $name,
            description: "Deleted product '{$name}'"
        );

        return redirect()->route('admin.products.index')->with('success', "Product '{$name}' has been deleted.");
    }
}
