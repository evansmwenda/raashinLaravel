<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public $timestamps = true;
    protected $table = 'carts';
    public $fillable = ['id','user_id','created_at','updated_at'];

    public function cartItems(){
    	return $this->hasMany(CartItem::class);
    }
}
