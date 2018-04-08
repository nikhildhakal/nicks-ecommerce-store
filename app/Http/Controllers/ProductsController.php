<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductsController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateWith([

              'name' => 'required',
              'description' => 'required',
              'price' => 'required',
              'image' => 'required|image'

        ]);


        $product = new Product;


        $product_image = $request->image;

        $product_image_name = time() . $product_image->getClientOriginalName();

        $product_image->move('uploads/products', $product_image_name);


        $product->name = $request->name;

        $product->description = $request->description;

        $product->price = $request->price;

        $product->image = 'uploads/products/' . $product_image_name;


        $product->save();

        $request->session()->flash('success', 'Product created.');


        return redirect()->route('products.index');


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
        return view('products.edit', [ 'product' => Product::find($id) ]);
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
        $this->validateWith([

              'name' => 'required',
              'description' => 'required',
              'price' => 'required',

        ]);


        $product = Product::find($id);

        if ($request->hasFile('image')) {

          $product_image = $request->image;

          unlink($product->image);

          $product_image_name = time() . $product_image->getClientOriginalName();

          $product_image->move('uploads/products', $product_image_name);

          $product->image = 'uploads/products/' . $product_image_name;


          $product->save();

        }

        $product->name = $request->name;

        $product->description = $request->description;

        $product->price = $request->price;

        $product->save();

        $request->session()->flash('success', 'Product updated.');


        return redirect()->route('products.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id)
    {

        $product = Product::find($id);

        if (file_exists($product->image)) {

          unlink($product->image);

        }

        $product->delete();

        $request->session()->flash('success', 'Product Deleted');


        return redirect()->back();

    }

}
