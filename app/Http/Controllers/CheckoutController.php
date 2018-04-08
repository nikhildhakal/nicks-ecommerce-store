<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Mail;

use Stripe\Stripe;
use Stripe\Charge;

use Cart;

class CheckoutController extends Controller
{
    public function checkout(){

      if ( Cart::content()->count() == 0 ) {

        Session::flash('info', 'Your cart is still empty. Do some shopping :D');

        return redirect()->back();

      }

      return view('checkout');

    }

    public function pay(){

      Stripe::setApiKey('sk_test_HNPb5xPdDpWRUrCS9DoRYSX9');

      $token = request()->stripeToken;

      $charge = Charge::create([
          'amount' => Cart::total() * 100,
          'currency' => 'usd',
          'description' => "Nick's Store",
          'source' => $token,
      ]);

      Cart::destroy();

      Session::flash('success', 'Succesfully purchased. Please wait for confirmation email.');

      Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseSuccesfull);

      return redirect('/');

    }
}
