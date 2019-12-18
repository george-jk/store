<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::resource('categories','CategoriesController')->names([
'create'=>'category.create',
])->middleware('verified');
Route::get('category/{id}','CategoriesController@getProducts')->name('category.getProducts');
Route::resource('products','ProductsController');
Route::get('product/{id}','ProductsController@getCategory')->name('product.getCategory');
Route::resource('orders','OrderController')->middleware('verified');
Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@index');
Route::get('/admin/categories', 'CategoriesController@admin')->name('categories.admin')->middleware('verified');
Route::get('/admin/products', 'ProductsController@admin')->name('products.admin')->middleware('verified');
