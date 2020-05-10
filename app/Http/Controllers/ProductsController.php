<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Input;
use Image;

class ProductsController extends Controller
{
    //
    public function addProduct(Request $request){

        if($request->isMethod('post')){
            $data=$request->all();
            // dd($data);
            $product = new Product;
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->description = $data['description'];
            $product->price = $data['price'];

            //upload the image
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111,99999).'.'.$extension;

                $large_image_path  = 'images/backend_images/products/large/'.$filename;
                $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                $small_image_path  = 'images/backend_images/products/small/'.$filename;

                //Resize the images
                Image::make($image_tmp)->save($large_image_path);
                Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                //store into products table
                $product->image = $filename;
            }
            $product->save();
            return redirect()->back()->with('flash_message_success','Product added successfully!');
        }


    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option value='' selected>Select</option>";
    	foreach ($categories as $cat) {
    		$categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
    		foreach ($sub_categories as $sub_cat) {
    			$categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}
    	}


    	return view('admin.products.add_product')->with(compact('categories_dropdown')); 
    }

    public function viewProducts(Request $request){
        return view('admin.products.view_products');

    }
}
