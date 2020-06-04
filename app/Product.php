<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public $timestamps = false;
    protected $table = 'products';
    public $fillable = ['id','category_id','product_name','product_code','product_color','description','price','image','created_at','updated_at'];
}
