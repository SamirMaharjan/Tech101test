<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function add_to_cart(Request $request, $id)
    {
        if ($request->cart_id) {
            $cart_item = Cart::where('id', $request->cart_id)->first();
            $new_qty = $cart_item->quantity + 1;
            $new_sub = $new_qty * $cart_item->price;
            $cart_item->update([
                'quantity' => $new_qty,
                'sub_total' => $new_sub,
            ]);
            return response()->json(['status' => 200, 'message' => 'Item Quanitity added SuccessFully', 'qty' => $cart_item->quantity]);
        } else {
            $product = Product::find($id);
            $user = Auth::user();
            $previous_cart = Cart::where('product_id', $id)->where('user_id', $user->id)->first();
            if ($previous_cart) {
                $new_qty = $previous_cart->quantity + 1;
                $new_sub = $new_qty * $previous_cart->price;
                $previous_cart->update([
                    'quantity' => $new_qty,
                    'sub_total' => ($new_sub),
                ]);
                return response()->json(['status' => 200, 'message' => 'Item Add to Cart SuccessFully',]);
            } else {

                $cart_item = Cart::create([
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'sub_total' => $product->price,
                    'user_id' => $user->id,
                ]);
                return response()->json(['status' => 200, 'message' => 'Item Add to Cart SuccessFully',]);
            }
        }
    }

    public function sub_to_cart(Request $request, $id)
    {
        if ($request->cart_id) {
            $cart_item = Cart::where('id', $request->cart_id)->first();
            $new_qty = $cart_item->quantity - 1;
            $new_sub = $new_qty * $cart_item->price;
            $cart_item->update([
                'quantity' => $new_qty,
                'sub_total' => $new_sub,
            ]);
            return response()->json(['status' => 200, 'message' => 'Item Quanitity added SuccessFully', 'qty' => $cart_item->quantity]);
        }
    }
    public function delete_to_cart(Request $request)
    {
        if ($request->cart_id) {
            $cart_item = Cart::where('id', $request->cart_id)->first();
            $cart_item->delete();
            return response()->json(['status' => 200, 'message' => 'Item Removed added SuccessFully']);
        }
    }
}
