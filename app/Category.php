<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps = true;
    protected $table = 'categories';
    public $fillable = ['id','parent_id','name','description','url','status','created_at','updated_at'];

    public function categories(){
    	return $this->hasMany('App\Category','parent_id');
    }
}
