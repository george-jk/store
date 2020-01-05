<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable=['product_id','customer_id','status_id','quantity','dimension_id'];
	
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

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}
