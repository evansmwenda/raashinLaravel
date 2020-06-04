<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps = false;
    protected $table = 'category';
    public $fillable = ['id','parent_id','name','description','url','status','created_at','updated_at'];
}
