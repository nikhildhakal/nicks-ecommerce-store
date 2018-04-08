<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cart;
use Session;

use App\Product;

class ShoppingController extends Controller
{

    public function add_to_cart(Request $request){

      $pid = $request->pid;

      $product = Product::find($pid);

      $cartItem = Cart::add([

            'id' => $pid,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $product->price

      ]);

      Cart::associate($cartItem->rowId, 'App\Product');

      Session::flash('success', 'Succesfully added to cart.');

      return redirect()->route('cart');

    }

    public function cart(){

      return view('cart');
    }

    public function cart_delete($id){

      Cart::remove($id);

      Session::flash('success', 'Succesfully removed.');

      return redirect()->back();
    }

    public function cart_incr($id , $qty){

      Cart::update($id, $qty + 1);

      Session::flash('success', 'Cart Succesfully updated.');

      return redirect()->back();
    }


    public function cart_decr($id , $qty){

      Cart::update($id, $qty - 1);

      Session::flash('success', 'Cart Succesfully updated.');

      return redirect()->back();
    }


    public function quick_add_cart($id){


      $product = Product::find($id);

      $cartItem = Cart::add([

            'id' => $id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price

      ]);

      Cart::associate($cartItem->rowId, 'App\Product');

      Session::flash('success', 'Added to cart.');

      return redirect()->route('cart');

    }

}
