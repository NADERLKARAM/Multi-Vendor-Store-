<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $orderBy = $request->input('order_by', 'name'); // Default ordering by name
        $orderDirection = $request->input('order_direction', 'asc'); // Default order direction ascending

        // Start the query on the Brand model
        $query = Brand::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Apply ordering
        $query->orderBy($orderBy, $orderDirection);

        // Paginate the results
        $brands = $query->paginate(3); // Fetch 3 brands per page

        return view('dashboard.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('dashboard.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image'
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('brands', 'public') : null;

        Brand::create([
            'name' => $request->name,
            'image' => $imagePath
        ]);

        return redirect()->route('brands.index');
    }

    public function show(Brand $brand)
    {
        return view('dashboard.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('dashboard.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->file('image')) {
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }
            $imagePath = $request->file('image')->store('brands', 'public');
        } else {
            $imagePath = $brand->image;
        }

        $brand->update([
            'name' => $request->name,
            'image' => $imagePath
        ]);

        return redirect()->route('brands.index');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->image) {
            Storage::disk('public')->delete($brand->image);
        }
        $brand->delete();
        return redirect()->route('brands.index');
    }
}