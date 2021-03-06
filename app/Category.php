<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['visible','category_title','category_description','parent'];

    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}
