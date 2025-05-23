<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->input('category');

        $query = Product::query();

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories', 'categoryId'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'ratings']);
        return view('products.show', compact('product'));
    }
}
