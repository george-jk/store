<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable=['product_id','user_id','status_id','quantity','dimension_id'];
	
    public function product()
    {
    	return $this
        ->belongsToMany(Product::class)
        ->withPivot('quantity','dimension_id')
        ->withTimestamps();
    }

    public function status()
    {
        return $this->belongsToMany(Status::class)->withTimestamps();
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
