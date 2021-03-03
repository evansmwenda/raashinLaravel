<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    public $timestamps = true;
    protected $table = 'order_items';
    public $fillable = ['id','order_id','product_id','product_quantity','price','created_at','updated_at'];
}
