<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $fillable=['user_id','name','family','phone','email','address','province','village','subscribe'];

	public function user()
	{
		return $this->hasOne(User::class);
	}

	public function order()
    {
        return $this->hasMany(Order::class);
    }
}
