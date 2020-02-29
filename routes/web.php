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

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');



Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

//邮件激活账号的路由
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//冒泡 bubble
Route::resource('bubbles', 'BubblesController', ['only' => ['store', 'destroy']]);
Route::get('bubbles/{id}.html','BubblesController@show')->name('bubble.show');


//文章 post
Route::resource('post', 'PostsController', ['only' => ['create', 'store', 'update', 'edit', 'destroy']]);
Route::get('{category}/{id}.html','PostsController@show')->name('post.show');



//文章分类 category
Route::get('{category}','CategoriesController@show')->name('category.show');

//用户 user
Route::get('user/{user}','UsersController@show')->name('user.show');


//上传图片 admin后台，编辑器上传图片接口
Route::post('/uploadFile', 'UploadsController@uploadImg')->name('upload.img');
//上传图片 前台接口
Route::post('upload_image', 'UploadsController@uploadImage')->name('upload.image');