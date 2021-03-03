<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    //
    public $timestamps = true;
    protected $table = 'cart_items';
    public $fillable = ['id','cart_id','product_id','quantity','created_at','updated_at'];
}
