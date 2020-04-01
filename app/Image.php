<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $fillable=['path','description','product_id'];
	
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
