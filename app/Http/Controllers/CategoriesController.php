<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (view('categories.index',['categories'=>Category::all()->sortBy('parent')]));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return (view('categories.create',['categories'=>Category::where('parent',0)->get()]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create($request->validate([
            'category_title'=>['required','min:3','max:255','unique:categories,category_title'],
            'category_description'=>'required',
            'parent'=>'required'
        ]));
        return(redirect('/admin/categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $mainCategories=Category::where('parent',0)->get();
        return(view('categories.edit',
            ['category'=>$category,
            'mainCategories'=>$mainCategories]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->validate([
            'category_title'=>['required','min:3','max:255'],
            'category_description'=>'required',
            'parent'=>'required'
        ]));
        return(redirect(route('categories.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return(redirect('categories'));
    }

    /**
     * Display the specified related resource.
     *
     * @param  \App\Category  $category_id
     * @return \Illuminate\Http\Response
     */
    public function getProducts($id)
    {
        return Category::find($id)->products;
    }

}
