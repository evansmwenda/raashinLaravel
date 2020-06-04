<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class IndexController extends Controller
{
    //
    public function index(){
    	//in descending order
    	// $products = Product::orderBy('id','DESC')->get();

    	//in random order
    	$products = Product::inRandomOrder()->get();


    	$main_categories = Category::where('parent_id',0)->get();
    	// dd($main_categories);
    	return view('index')->with(compact('products','main_categories'));
    }
}
