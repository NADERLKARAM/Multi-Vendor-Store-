<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('front.wishlist.index', compact('wishlists'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;

        // Check if the product is already in the user's wishlist
        $existingWishlistItem = Wishlist::where('user_id', $userId)
                                        ->where('product_id', $productId)
                                        ->first();

        if ($existingWishlistItem) {
            return redirect()->route('wishlist.index')->with('error', 'Product already in wishlist.');
        }

        // Add the product to the wishlist
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return back()->with('success', 'Product added to wishlist.');
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $wishlist->delete();

        return redirect()->route('wishlist.index')->with('success', 'Product removed from wishlist.');
    }


    public function count()
{
    // Retrieve the total count of wishlist items for the authenticated user
    $count = Wishlist::where('user_id', auth()->id())->count();

    // Return the count as JSON response
    return response()->json(['count' => $count]);
}
}