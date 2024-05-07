<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
    $stores = Store::all();

    return view('dashboard.products.create', compact('categories', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Updated image validation rule
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'options' => 'nullable|json',
            'rating' => 'required',
            'featured' => 'boolean',
            'status' => 'required|in:active,draft,archived',
            'tags' => 'nullable|string',
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Store the image in the 'public/product_images' directory
            $imagePath = $request->file('image')->store('product_images', 'public');
            // Set the image path in the validated data
            $validatedData['image'] = $imagePath;
        }

        // Generate the slug based on the product name
        $slug = Str::slug($validatedData['name']);

        // Check if the slug already exists
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            // Append a unique identifier to the slug
            $slug .= '-' . ($count + 1);
        }

        // Add the slug to the validated data
        $validatedData['slug'] = $slug;

        // Create the product
        $product = Product::create($validatedData);

        // Attach tags to the product if provided
        if (!empty($validatedData['tags'])) {
            $tagNames = explode(',', $validatedData['tags']);
            $product->attachTags($tagNames);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // Fetch the product by its ID
    $product = Product::findOrFail($id);

    // Load any other data you need, such as categories or stores
    $categories = Category::all();
    $stores = Store::all();

    // Pass the product and other data to the view
    return view('dashboard.products.edit', compact('product', 'categories', 'stores'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
{
    // Validate the incoming request data
    // Validate the incoming request data
    $validatedData = $request->validate([
        'store_id' => 'required|exists:stores,id',
        'category_id' => 'nullable|exists:categories,id',
        'name' => 'required|string|max:255|unique:products,name',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'price' => 'required|numeric|min:0',
        'compare_price' => 'nullable|numeric|min:0',
        'options' => 'nullable|json',
        'rating' => 'nullable|numeric|min:0|max:5',
        'featured' => 'boolean',
        'status' => 'required|in:active,draft,archived',
        'tags' => 'nullable|string', // Adjust validation rule for tags
    ]);

    // Handle image upload if provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('product_images');
        $validatedData['image'] = $imagePath;
    }

    // Update product attributes
    $product->update($validatedData);

    // Generate the slug based on the product name if name is changed
    if ($product->isDirty('name')) {
        $product->slug = Str::slug($validatedData['name']);
    }

    // Save the product to the database
    $product->save();

    // Attach new tags to the product if provided
    if (!empty($validatedData['tags'])) {
        $tagNames = explode(',', $validatedData['tags']);
        $product->syncTags($tagNames);
    }

    return redirect()->route('products.index')->with('success', 'Product updated successfully');

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
