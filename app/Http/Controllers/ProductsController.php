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
            'products'=>$this->getProducts()->paginate(6),
            'categories'=>$this->getCategories()
        ]));
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
            'product'=>['numeric', 'exists:categories,id']
        ]);
        return (view('products.index',[
            'products'=>$this->getProducts($request->product)->paginate(6),
            'categories'=>$this->getCategories()
        ]));
    }

    private function getCategories()
    {
        foreach (Category::all() as $category) {
            $categories[$category->id]=$category;
        }
        return $categories;
    }

    private function getProducts($product='')
    {
        if ($product) {   
            $products=Product::select('id','visible','name')->where('category_id',$product)->with('images');
        } else {
            $products=Product::select('id','visible','name')->with('images');
        }
        
        return $products;
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
        if ($request->product_image) {
            foreach ($request->product_image as $key=>$image) {
                Image::findOrFail($key)->product()->dissociate()->save();
                Image::findOrFail($image)->product()->associate($product)->save();
            }
        }
        return(redirect(route('products.edit',[$product->id]))->with('success','Product Updated!'));
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

    // public function getCategory($id)
    // {
    //     return Product::firstOrFail($id)->category;
    // }

}
