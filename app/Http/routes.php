<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','SiteController@index');

Route::group(['middleware'=>'admin'],function()
{
    Route::resource('admin/category','CategoryController');
    Route::resource('admin/product','ProductController');
    Route::get('admin/discounts','ProductController@get_discount_form');
    Route::post('admin/discounts','ProductController@discounts');
    Route::delete('admin/discounts/{id}','ProductController@del_discounts');
    Route::get('admin/order','OrderController@index');
    Route::get('admin/order/{id}','OrderController@show');
    Route::delete('admin/order/{id}','OrderController@delete');
    Route::get('admin','AdminController@index');
    Route::get('admin/comment','CommentController@index');
    Route::post('admin/comment/change_state','CommentController@change_state');
    Route::post('admin/comment/create','CommentController@create');
    Route::delete('admin/comment/{id}','CommentController@delete');
});

Route::group(['middleware'=>'install'],function()
{
    Route::get('install/admin','InstallController@admin');
    Route::post('install/admin/create','InstallController@create');
    Route::get('install/finish','InstallController@finish');
});


Route::post('cart','SiteController@addcart');
Route::get('cart','SiteController@cart');
Route::post('add_comment','SiteController@comment');
Route::get('register','Auth\AuthController@showRegistrationForm');
Route::post('register','Auth\AuthController@register');
Route::get('logout','Auth\AuthController@logout');
Route::post('login','Auth\AuthController@login');
Route::get('Captcha',function()
{
   $Captcha=new \App\lib\Captcha();
   $Captcha->create();
});

Route::post('del_cart','SiteController@del_cart');

Route::post('check_discounts','SiteController@check_discounts');

Route::get('Category/{menu}','SiteController@menu');

Route::get('Category/{menu}/{zip_menu}','SiteController@zip_menu');

Route::post('addorder','SiteController@addorder');

Route::post('order','SiteController@order');

Route::get('get_file','SiteController@get_file');


Route::get('password/reset/{token?}','Auth\PasswordController@showResetForm');
Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset','Auth\PasswordController@reset');
Route::get('search','SiteController@search');
Route::get('admin/login','Auth\AuthController@adminlogin');
Route::get('{title}','SiteController@show');
Route::get('/home', 'HomeController@index');
