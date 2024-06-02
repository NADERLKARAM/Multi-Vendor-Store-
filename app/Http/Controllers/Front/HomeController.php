<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {

        $products = Product::all();
        $categories = Category::with('products')->get();


         // Retrieve best selling products (You need to implement this logic)
         $bestSellingProducts = Product::select('products.id', 'products.name', 'products.price', 'products.image', DB::raw('SUM(order_items.quantity) as total_sales'))
        ->join('order_items', 'products.id', '=', 'order_items.product_id')
        ->groupBy('products.id', 'products.name', 'products.price', 'products.image')
        ->orderBy('total_sales', 'desc')
        ->take(3)
        ->get();

         // Fetch the top-rated products
         $topRatedProducts = Product::orderBy('rating', 'desc')->take(3)->get();

          // Fetch the latest products
        $newArrivals = Product::orderBy('created_at', 'desc')->take(3)->get();


        return response()->view('front.Home', compact('products','categories','bestSellingProducts','topRatedProducts','newArrivals'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}