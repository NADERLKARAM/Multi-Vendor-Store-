<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FProductController extends Controller
{
    public function index()
    {
        // Retrieve all products from the database
        $products = Product::all();

        // Pass the products to the view
        return view('front.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('front.products.show', compact('product'));
    }
}