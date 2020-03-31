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
        return (view('products.index',[
            'products'=>Product::paginate(6),
            'categories'=>Category::all()
        ]));
    }

    public function filter(Request $request)
    {
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
        return(view('products.create',[
            'categories'=>$categories,
            'images'=>$images
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create($request->validate([
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
        return(redirect(route('products.index')));
    }

    /**
     * Display the specified product filtred by category.
     * Name of variable from GET requst is incorrect product, actualy get category id
     *
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'product'=>'numeric'
        ]);
        return (view('products.index',[
            'products'=>Product::where('category_id',$request->product)->paginate(6),
            'categories'=>Category::all()
        ]));
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
        return (view('products.edit',[
            'product'=>$product,
            'categories'=>$categories,
            'images'=>$images
        ]));
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
        return(redirect(route('products.index')));
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

    /*
     * Must delete admin, migrate to index
     */

    public function admin(Category $category=NULL)
    {
        return (view('products.index',[
            'products'=>Product::where('category_id',$category->category_id)->paginate(6),
            'categories'=>Category::all()
        ]));
    }
}
