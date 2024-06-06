<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        // Get search and ordering inputs from the request
        $search = $request->input('search');
        $orderBy = $request->input('order_by', 'name'); // Default ordering by name
        $orderDirection = $request->input('order_direction', 'asc'); // Default order direction ascending

        // Query products
        $products = Product::query();

        // Add search functionality
        if ($search) {
            $products->where('name', 'like', '%' . $search . '%')
                     ->orWhere('description', 'like', '%' . $search . '%');
        }

        // Apply ordering
        $products->orderBy($orderBy, $orderDirection);

        // Paginate the results
        $products = $products->paginate(3); // Fetch 10 products per page

        // Return the view with the products
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
    $stores = Store::all();

    $brands = Brand::all();

    return view('dashboard.products.create', compact('categories', 'stores','brands'));
    }



    public function store(StoreProductRequest $request)
    {
        // The validated data is already available via $request->validated()
        $validatedData = $request->validated();

        // Store the uploaded image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        // Create and save the product
        $product = new Product();
        $product->store_id = $validatedData['store_id'];
        $product->category_id = $validatedData['category_id'];
        $product->name = $validatedData['name'];
        $product->brand_id = $validatedData['brand_id'];
        $product->slug = Str::slug($validatedData['name']);
        $product->description = $validatedData['description'];
        $product->image = $imagePath;
        $product->price = $validatedData['price'];
        $product->compare_price = $validatedData['compare_price'];
        $product->options = $validatedData['options'];
        $product->rating = $validatedData['rating'];
        if (isset($validatedData['featured'])) {
            $product->featured = $validatedData['featured'];
        }
        $product->status = $validatedData['status'];
        $product->save();

        // Redirect back with success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
       // Fetch the product by its ID
    $product = Product::findOrFail($id);

    // Load any other data you need, such as categories or stores
    $categories = Category::all();
    $stores = Store::all();

    $brands = Brand::all();
    // Pass the product and other data to the view
    return view('dashboard.products.edit', compact('product', 'categories', 'stores','brands'));

    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        // The validated data is already available via $request->validated()
        $validatedData = $request->validated();

        // Update the product attributes
        $product->store_id = $validatedData['store_id'];
        $product->category_id = $validatedData['category_id'];
        $product->name = $validatedData['name'];
        $product->slug = Str::slug($validatedData['name']);
        $product->description = $validatedData['description'];
        $product->brand_id = $validatedData['brand_id'];
        $product->price = $validatedData['price'];
        $product->compare_price = $validatedData['compare_price'];
        $product->options = $validatedData['options'];
        $product->rating = $validatedData['rating'];
        if (isset($validatedData['featured'])) {
            $product->featured = $validatedData['featured'];
        }
        $product->status = $validatedData['status'];

        // Update the image if provided
        if ($request->hasFile('image')) {
            // Store the new uploaded image
            $imagePath = $request->file('image')->store('product_images', 'public');
            // Delete the old image file if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Update the image path
            $product->image = $imagePath;
        }

        // Save the updated product
        $product->save();

        // Redirect back with success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Check if the authenticated user can delete the product
        // You may add additional authorization logic here if needed

        // Delete the product
        $product->delete();

        // Redirect back with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }


}