<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withStock()->get();

        return view('products', compact('products'));
    }
}
