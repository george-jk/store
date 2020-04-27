<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of all products with images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        foreach (Product::where('visible',1)->get() as $product){
            $product->images;
            $products[]=$product;
        }
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified product with images.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->images;
        return $product;
    }

    public function getByCategory($request)
    {
        //to do request verification
        $products=[];
        foreach(Product::where(['category_id'=>$request,'visible'=>1])->get() as $product){
            $product->images;
            $products[]=$product;
        }
        return $products;
    }

    /**
     * Return visible products with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JSON paginated Products
     */
    public function getByCategoryPaginate($request)
    {
        //to do request verification
        return Product::with('images')->where(['category_id'=>$request,'visible'=>1])->paginate(6)->toJson();
    }

    /**
     * Search visible products 'like'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Product or null
     */
    
    public function search($request)
    {
        $products=array();
        foreach (Product::where([
            ['name','like','%'.$request.'%'],
            ['visible','=',1]
        ])
            ->get() as $product){
            $product->images;
            $products[]=$product;
        }
        return ($products?$products:[null]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
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

}
