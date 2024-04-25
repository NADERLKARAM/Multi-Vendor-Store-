<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $parents = Category::all();
        return view('dashboard.categories.create',compact('categories','parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,archived',
       ]);

       $category = new Category();

       $category->name = $request->name;
       $category->slug = \Str::slug($request->name); // Generate slug from name
       $category->description = $request->description;
       $category->status = $request->status;


       //Handle image upload
       if($request->hasFile('image')){
        $imagePath = $request->file('image')->store('categories', 'public');
        $category->image = $imagePath;
       }

         // Set parent_id if provided
         if ($request->has('parent_id')) {
            $category->parent_id = $request->parent_id;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        $parents = Category::all(); // Assuming you need parent categories for the select dropdown
        return view('dashboard.categories.edit', compact('categories', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

         // Fetch the category by ID
    $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,archived',
            'parent_id' => 'nullable|exists:categories,id',

        ]);

        // Remove the old image if a new one is uploaded
        if ($request->hasFile('image')) {
            Storage::delete($category->image);
        }

        // Update the category
        $category->update($request->except('image'));

        // Store the new image if provided
        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('categories', 'public');
            $category->save();
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

            // Fetch the category by ID
       $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // Optionally, you may also delete associated images or perform other cleanup tasks

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}