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
Route::get('/contact-us', 'HomeController@contactus')->name('contactus');

//products listing
Route::get('/products/{url}','ProductsController@products');

Route::group(['middleware' => ['auth']],function(){
	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::match(['get','post'],'/admin/settings','AdminController@settings');
	Route::get('/admin/check-pwd','AdminController@checkpass');
	Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePass');

	//Category routes
	Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
	Route::get('/admin/view-categories','CategoryController@viewCategories');
	Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
	Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');

	//product routes
	Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
	Route::get('/admin/view-products','ProductsController@viewProducts');
	Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
	Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');
	Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
});



Route::get('/logout','AdminController@logout');
