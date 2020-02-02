<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStore;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $images=Image::all();
        return(view('products.create',['categories'=>$categories,'images'=>$images]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Product::create($request->validate([
            'visible'=>['required'],
            'name'=>['required','min:3','max:255'],
            'manifacture'=>['required','min:2','max:255'],
            'description'=>['required','min:3'],
            'exserpt_description'=>['required','min:3','max:255'],
            'category_id'=>'required',
            'price'=>['required','numeric'],
            'currency'=>['required','max:255'],
            'stock'=>['required','numeric','min:0'],
            'image_id'=>'required'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product->category;
        $product->images;
        $categories=Category::all();
        $images=Image::all();
        return (view('products.edit',['product'=>$product,'categories'=>$categories,'images'=>$images]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStore $request, Product $product)
    {
        $product->update($request->validated());
        return(redirect(route('products.admin')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getCategory($id)
    {
        return Product::firstOrFail($id)->category;
    }

    public function admin()
    {
        return (view('products.index',['products'=>Product::paginate(6)]));
    }
}
