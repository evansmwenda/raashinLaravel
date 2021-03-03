<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Image;
use DB;

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
            return redirect('/admin/view-products')->with('flash_message_success','Product added successfully!');
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

    public function viewProducts(){
        $products = Product::get();
        foreach($products as $key => $val){
           $category_name = Category::where(['id' => $val->category_id])->first();
           $products[$key]->category_name = $category_name->name;
        }
        return view('admin.products.view_products')->with(compact('products'));

    }

    public function editProduct(Request $request,$id=null){
        if($request->isMethod('post')){
            #form submitted
            $data=$request->all();

            //upload the image
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                $extension = $image_tmp->getClientOriginalExtension();
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111,99999).'.'.$extension;

                $large_image_path  = 'images/backend_images/products/large/'.$filename;
                $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                $small_image_path  = 'images/backend_images/products/small/'.$filename;

                //Resize the images
                Image::make($image_tmp)->save($large_image_path);
                Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                
            }else{
                //has not updated image
                $filename = $data['current_image'];
            }

            //update the product here
            $product = Product::where(['id'=>$id])->first();
            // dd($product);
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->description = $data['description'];
            $product->price = $data['price'];
            $product->image = $filename;
            $product->price = $data['price'];
            $product->save();
            // Product::where(['id'=>$id])->update([
            //     'product_name'=>$data['product_name'],
            //     'product_code'=>$data['product_code'],
            //     'product_color'=>$data['product_color'],
            //     'description'=>$data['description'],
            //     'price'=>$data['price'],
            //     'image'=>$filename,
            //     'category_id'=>$data['category_id']]);

            return redirect('/admin/view-products')->with('flash_message_success','Product updated Successfully');
        }


        $productDetails = Product::where(['id'=>$id])->first();

        //get categories data
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected>Select</option>";
        foreach ($categories as $cat) {
            if($cat->id == $productDetails->category_id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                if($sub_cat->id == $productDetails->category_id){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                $categories_dropdown .= "<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }


        return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));
    }
    public function deleteProduct($id =null){
        if(!empty($id)){
            Product::where(['id'=>$id])->delete();

            //delete the images in the images folder

            return redirect()->back()->with('flash_message_success','Product deleted Successfully');
        }
    }

    public function deleteProductImage($id){
        //attempt to delete image
        $image = DB::table('products')->where('id', $id)->value('image');
        if($image == NULL){
            //no image here
            return redirect()->back()->with('flash_message_error','Product Image not found');
        }

        //has image
        $path = $_SERVER['DOCUMENT_ROOT'].'/images/backend_images/products/small/'.$image;
        $path_medium = $_SERVER['DOCUMENT_ROOT'].'/images/backend_images/products/medium/'.$image;
        $path_large = $_SERVER['DOCUMENT_ROOT'].'/images/backend_images/products/large/'.$image;
        unlink($path);
        unlink($path_medium);
        unlink($path_large);

        Product::where(['id'=>$id])->update(['image'=>'']);

        
        return redirect()->back()->with('flash_message_success','Product Image deleted Successfully');
        //delete product image here
    }

    public function products($url = null){
        //check if product url exists
        $countCategory =  Category::where(['url'=>$url])->count();
        // dd($countCategory);
        if($countCategory == 0){
            abort(404);
        }

        
        $categoryDetails = Category::where(['url'=>$url])->first();
        
        if($categoryDetails->parent_id == 0){
            //this is a main category
            $subCategories = Category::where(['parent_id' => $categoryDetails->id])->get();
            $cat_ids =$categoryDetails->id.",";//include products that dont have sub categories
            foreach($subCategories as $subCat){
                $cat_ids .= $subCat->id .",";
            }
            // echo $cat_ids;die();
            $my_ids =explode(',',$cat_ids);//create array from string
            $products = Product::whereIn('category_id',$my_ids)->get();
        }else{
            //this is a sub category
            $products = Product::where(['category_id' => $categoryDetails->id])->get();
        }

        
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        
        return view('products.listing')->with(compact('categoryDetails','products','categories'));
    }

    public function getTestApi(){
        $data = [
            "name" => "Evans Mwenda",
            "email" => "evansmwenda@gmail.com",
            "phone" => "999"
        ];
        return response()->json($data);
    }
}
