<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['visible', 'name', 'manifacture', 'description', 'exserpt_description', 'category_id', 'price', 'currency', 'stock', 'image_id'];

    /**
     * Return category that product belong.
     */

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    /**
     * Return images that product has.
     * Return default if hasn't (from config file).
     */

    public function images()
    {
    	$image=$this->hasMany(Image::class);
        if ($image->count()){
            return $image;
        }else{
            return $this
            ->find(config('app_products.products.image.default_product_id_image'))
            ->hasMany(Image::class);
        }
    }

    /**
     * Return orders of product.
     */

    public function orders()
    {
    	return $this
        ->belongsToMany(Order::class)
        ->withPivot('quantity','dimension_id')
        ->withTimestamps();
    }

}
