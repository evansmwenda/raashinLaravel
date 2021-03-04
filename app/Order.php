<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $timestamps = true;
    protected $table = 'orders';
    public $fillable = ['id','user_id','price','status','address_id','created_at','updated_at'];

    public function orderItem(){
    	return $this->hasMany(OrderItem::class);
    }
}
