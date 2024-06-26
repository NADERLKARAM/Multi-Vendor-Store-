<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Wishlist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FProductController extends Controller
{
    public function index($productId)
    {
         // Retrieve the product along with its reviews
         $products = Product::with('reviews')->findOrFail($productId);

          // Retrieve brands from the database
           $brands = Brand::all();

        // Pass the products to the view
        return view('front.products.index', compact('products','brands'));
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

        // Filter by selected price range
        if ($request->filled('price_range')) {
            $priceRange = explode('-', $request->input('price_range'));
            $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
        }

        // Filter by selected brands
        if ($request->filled('brands')) {
            $query->whereIn('brand_id', $request->input('brands'));
        }

        // Paginate the results
        $products = $query->paginate(6);

        // Fetch all categories along with the count of products associated with each category
        $categories = Category::withCount('products')->get();

        // Calculate price ranges
        $priceRanges = $this->calculatePriceRanges();

        // Retrieve brands from the database
        $brands = Brand::all();

        // Pass the data to the view, including the brand filtering HTML code
        return view('front.products.index', compact('products', 'categories', 'priceRanges', 'category_id', 'brands'));
    }

    private function calculatePriceRanges()
    {
        $priceRanges = [];

        // Retrieve minimum and maximum prices from products
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        // Define price ranges based on the minimum and maximum prices
        $ranges = [
            [0, 100],
            [100, 500],
            [500, 1000],
            [1000, 5000],
            [5000, 10000],
            [10000, 15000],
            [15000, 20000],
        ];

        // Calculate the number of products in each price range
        foreach ($ranges as $range) {
            $rangeProductsCount = Product::whereBetween('price', $range)->count();
            $priceRanges[] = [
                'range' => '$' . $range[0] . ' - $' . $range[1],
                'value' => $range[0] . '-' . $range[1],
                'count' => $rangeProductsCount
            ];
        }

        return $priceRanges;
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

        // Paginate the search results
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(6); // You can adjust the pagination size as needed

        // Calculate price ranges
        $priceRanges = $this->calculatePriceRanges();

         // Retrieve brands from the database
         $brands = Brand::all();

        // Pass the data to the view
        return view('front.products.index', compact('products', 'categories', 'query', 'priceRanges','brands'));
    }



    public function storeReview(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
        ]);

        $product->reviews()->create($validated);

        return redirect()->route('product-details', ['product' => $product->id])->with('success', 'Review submitted successfully');
    }
}