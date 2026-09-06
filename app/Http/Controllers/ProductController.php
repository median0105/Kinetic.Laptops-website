<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'specification'])->where('is_active', true);

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($c) => $c->where('slug', $request->category));
        }

        if ($request->filled('brand')) {
            $query->whereHas('specification', fn ($s) => $s->where('brand', $request->brand));
        }

        if ($request->filled('ram')) {
            $query->whereHas('specification', fn ($s) => $s->where('ram', $request->ram));
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        $categories = Category::where('is_active', true)->get();
        $brands = Product::where('is_active', true)
            ->join('product_specifications', 'products.id', '=', 'product_specifications.product_id')
            ->pluck('product_specifications.brand')
            ->filter()
            ->unique()
            ->values();
        $rams = Product::where('is_active', true)
            ->join('product_specifications', 'products.id', '=', 'product_specifications.product_id')
            ->pluck('product_specifications.ram')
            ->filter()
            ->unique()
            ->values();

        return view('products.index', compact('products', 'categories', 'brands', 'rams'));
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        $product->load(['category', 'specification', 'reviews.user']);

        return view('products.show', compact('product'));
    }
}
