<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartRepository
{

    protected $items;

 public function __construct(){
    $this->items = collect([]);
 }


 public function get() : Collection
 {
     if (!$this->items->count()) {
         $this->items = Cart::with('product')->get();
     }

     return $this->items;
 }


 public function add(Product $product, $quantity = 1)
 {
     $userId = auth()->id(); // Get the authenticated user's ID

     $item = Cart::where('product_id', $product->id)
                 ->where('user_id', $userId) // Add a condition to find the cart item for the authenticated user
                 ->first();

     if (!$item) {
         $cartData = [
             'product_id' => $product->id,
             'quantity' => $quantity,
         ];

         if ($userId) {
             $cartData['user_id'] = $userId; // Set user_id if the user is authenticated
         }

         $cart = Cart::create($cartData);

         $this->get()->push($cart);

         return $cart;
     }

     return $item->increment('quantity', $quantity);
 }


    public function update($id, $quantity)
    {
        Cart::where('id', '=', $id)
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id)
    {
        Cart::where('id', '=', $id)
            ->delete();
    }

    public function empty()
    {
        Cart::query()->delete();
    }

    public function total() : float
    {


        return $this->get()->sum(function($item) {
            return $item->quantity * $item->product->price;
        });
    }

}