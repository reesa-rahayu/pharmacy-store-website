<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $products = ->paginate(12);
        return view('products.index', compact('products', 'categories', 'categoryId'));
    }
}
