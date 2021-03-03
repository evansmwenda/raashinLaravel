<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


//index page
Route::get('/','IndexController@index');

//admin login
Route::match(['get','post'],'/admin','AdminController@login');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//navigation header
Route::get('/account', 'HomeController@account')->name('account');
Route::get('/wish-list', 'HomeController@wishlist')->name('wishlist');
Route::get('/checkout', 'HomeController@checkout')->name('checkout');
Route::get('/cart', 'HomeController@cart')->name('cart');

//TODO:remove out of authed controller
Route::get('/contact-us', 'HomeController@contactus')->name('contactus');

//products listing
Route::get('/products/{url}','ProductsController@products');


//admin prefixed routes
Route::group(['middleware' => ['auth'],'prefix'=> 'admin'],function(){
	Route::get('dashboard','AdminController@dashboard');
	Route::match(['get','post'],'settings','AdminController@settings');
	Route::get('check-pwd','AdminController@checkpass');
	Route::match(['get','post'],'update-pwd','AdminController@updatePass');

	//Category routes
	Route::match(['get','post'],'add-category','CategoryController@addCategory');
	Route::get('view-categories','CategoryController@viewCategories');
	Route::match(['get','post'],'edit-category/{id}','CategoryController@editCategory');
	Route::match(['get','post'],'delete-category/{id}','CategoryController@deleteCategory');

	//product routes
	Route::match(['get','post'],'add-product','ProductsController@addProduct');
	Route::get('view-products','ProductsController@viewProducts');
	Route::match(['get','post'],'edit-product/{id}','ProductsController@editProduct');
	Route::get('delete-product/{id}','ProductsController@deleteProduct');
	Route::get('delete-product-image/{id}','ProductsController@deleteProductImage');
});



Route::get('/logout','AdminController@logout');
