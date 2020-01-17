<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['name', 'manifacture', 'description', 'exserpt_description', 'category_id', 'price', 'currency', 'image_id'];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function images()
    {
    	return $this->hasMany(Image::class);
    }
    public function orders()
    {
    	return $this
        ->belongsToMany(Order::class)
        ->withPivot('quantity','dimension_id')
        ->withTimestamps();
    }

}
