<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
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


    public function getProductsByCategory(Request $request, $category_id)
    {
         // Retrieve products for the specified category ID
         $query = Product::where('category_id', $category_id);

         // Apply sorting
         $query = $this->applySorting($query, $request->input('sort'));

         // Paginate the results
         $products = $query->paginate(12);

         // Fetch all categories along with the count of products associated with each category
         $categories = Category::withCount('products')->get();

         // Pass the data to the view
         return view('front.products.index', compact('products', 'categories', 'category_id'));
    }


    private function applySorting($query, $sort)
    {
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating_desc':
                $query->orderBy('rating', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                // Default sorting
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query;
    }



    public function searchProducts(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::withCount('products')->get();

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return view('front.products.index', compact('products', 'categories', 'query'));
    }
}