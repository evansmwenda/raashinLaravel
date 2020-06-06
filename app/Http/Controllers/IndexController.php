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


    	$categories = Category::with('categories')->where(['parent_id'=>0])->get();
        //$categories_menu="";
    	// foreach($main_categories as $cat){
    	// 	// echo $cat->name;echo "<br>";

    	// 	$categories_menu .= "<div class='panel-heading'>
					// 				<h4 class='panel-title'>
					// 					<a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
					// 						<span class='badge pull-right'><i class='fa fa-plus'></i></span>
					// 						".$cat->name."
					// 					</a>
					// 				</h4>
					// 			</div>
					// 			<div id='".$cat->id."' class='panel-collapse collapse'>
					// 				<div class='panel-body'>
					// 					<ul>";
					// 					$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
    		
					// 		    		foreach ($sub_categories as $sub_cats) {
					// 		    			// echo $sub_cats->name;echo "<br>";
					// 		    			$categories_menu .= "<li><a href='#'>".$sub_cats->name." </a></li>";
					// 		    		}
											
					// 					$categories_menu .= "</ul>
					// 				</div>
					// 			</div>";
    	// }
    	// dd($sub_cats);
    	return view('index')->with(compact('products','categories'));
    }
}
