<?php

namespace App\Http\Controllers\API;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Article::where('visible',1)->get();
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
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        if ($article->visible) {
            $article->category;
            return response()->json([
                'article_id'=>$article->id,
                'article_title'=>$article->article_title,
                'article_content'=>$article->article_content,
                'categoriy_id'=>$article->categories_id,
                'category_title'=>$article->category->category_title,
                'created_at'=>$article->created_at->toDateTimeString(),
            ]); 
        } else {
            return response()->json(['visible'=>'false'],404);
        }
        
    }

    public function getByCategory($id)
    {
        return 'get last article from category '.$id; 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
