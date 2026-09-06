<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::with('category')->latest()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'product' => null,
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'sku' => 'required|unique:products,sku',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'brand' => 'nullable|max:255',
            'processor' => 'nullable|max:255',
            'ram' => 'nullable|max:255',
            'storage' => 'nullable|max:255',
            'gpu' => 'nullable|max:255',
            'display' => 'nullable|max:255',
            'operating_system' => 'nullable|max:255',
            'weight' => 'nullable|max:255',
        ]);

        $data['slug'] = Str::slug($data['name']).'-'.Str::lower(Str::random(5));
        $data['is_active'] = true;
        $data['is_featured'] = $request->boolean('is_featured');
        $data['thumbnail'] = $request->hasFile('image') ? $request->file('image')->store('products', 'public') : null;

        $specFields = ['brand', 'processor', 'ram', 'storage', 'gpu', 'display', 'operating_system', 'weight'];
        $specData = [];
        foreach ($specFields as $field) {
            $specData[$field] = $data[$field] ?? null;
            unset($data[$field]);
        }

        $product = Product::create($data);
        $product->specification()->create($specData);

        return redirect()->route('admin.products.index')->with('success', 'Produk dibuat.');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'specification', 'reviews.user']);

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load('specification');

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'sku' => 'required|unique:products,sku,'.$product->id,
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'brand' => 'nullable|max:255',
            'processor' => 'nullable|max:255',
            'ram' => 'nullable|max:255',
            'storage' => 'nullable|max:255',
            'gpu' => 'nullable|max:255',
            'display' => 'nullable|max:255',
            'operating_system' => 'nullable|max:255',
            'weight' => 'nullable|max:255',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $data['thumbnail'] = $request->file('image')->store('products', 'public');
        }

        $specFields = ['brand', 'processor', 'ram', 'storage', 'gpu', 'display', 'operating_system', 'weight'];
        $specData = [];
        foreach ($specFields as $field) {
            $specData[$field] = $data[$field] ?? null;
            unset($data[$field]);
        }

        $product->update($data);
        $product->specification()->updateOrCreate([], $specData);

        return redirect()->route('admin.products.index')->with('success', 'Produk diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Produk dihapus.');
    }
}
