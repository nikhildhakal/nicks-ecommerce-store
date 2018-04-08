<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class FrontendController extends Controller
{

    public function index(){

      return view('index', ['products' => Product::paginate(6)]);

    }


    public function singleProduct($id){

      return view('single', ['product' => Product::find($id)]);

    }
}
