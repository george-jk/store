<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable=['user_id'];
	
    public function product()
    {
    	return $this->belongsToMany(Product::class)->withTimestamps();
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
