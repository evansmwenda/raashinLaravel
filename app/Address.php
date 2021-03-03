<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    public $timestamps = true;
    protected $table = 'addresses';
    public $fillable = ['id','user_id','city','town','description','created_at','updated_at'];
}
