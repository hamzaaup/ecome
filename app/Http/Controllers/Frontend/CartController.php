<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product_id = $request->product_id;
        $quantity = $request->quantity;

        if (Auth::check()) {
            $product_check = Product::where('id', $product_id)->first();
            if ($product_check) {
                if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()){
                    return response()->json(['status' => $product_check->name.' Already Added To Cart']);
                }else{
                    $cartItem = new Cart();
                    $cartItem->user_id = Auth::id();
                    $cartItem->product_id = $product_id;
                    $cartItem->product_quantity = $quantity;
                    $cartItem->save();
                    return response()->json(['status' => $product_check->name.' Added To Cart']);
                }
            }
        }else {
            return response()->json(['message' => 'Unauthenticated']);
        }
    }
}
