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


//后台路由在另外的文件里


//首页
Route::get('/', 'StaticPagesController@home')->name('home');

Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');





//登录与登出
//访问登录页面
Route::get('login', 'SessionsController@create')->name('login');
//访问注册页面
Route::get('signup', 'UsersController@create')->name('signup');
//登录
Route::post('login', 'SessionsController@store')->name('login');
//退出登录
Route::delete('logout', 'SessionsController@destroy')->name('logout');



//邮件激活账号的路由
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//冒泡 bubble
Route::resource('bubble', 'BubblesController', ['only' => ['store']]);


//文章 post
Route::resource('post', 'PostsController', ['only' => ['create', 'store', 'update', 'edit']]);
Route::get('{category}/{id}.html','PostsController@show')->name('post.show');
Route::get('post/{id}/delete','PostsController@softDeletes')->name('post.soft_delete');



//文章分类 category
Route::get('{category}','CategoriesController@show')->name('category.show');

//用户 user
Route::get('user/{user}','UsersController@show')->name('user.show');
Route::resource('user', 'UsersController');
//关注
Route::get('/followings/{user}', 'UsersController@followings')->name('user.followings');
//粉丝
Route::get('/followers/{user}', 'UsersController@followers')->name('user.followers');

Route::post('/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');


//上传图片 admin后台，编辑器上传图片接口
Route::post('/uploadFile', 'UploadsController@uploadImg')->name('upload.img');
//上传图片 前台接口
Route::post('upload_image', 'UploadsController@uploadImage')->name('upload.image');