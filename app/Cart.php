<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public $timestamps = true;
    protected $table = 'cart';
    public $fillable = ['id','user_id','created_at','updated_at'];
}
