<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});



Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('/', 'HomeController@index');
    Route::get('member/list', 'MemberController@show');
    Route::post('member/update', 'MemberController@update');
    Route::resource('member', 'MemberController');
    //Route::get('selfarticle', 'Self_articleController@show');
    Route::resource('article', 'ArticleController');
});
//管理員登入

Route::group(['middleware' => 'auth'], function() { //會員登入
    Route::post('comment', 'CommentController@store');
    Route::get('selfarticle', 'Auth\SelfArticleController@show');
    Route::get('login/fblogin', 'Auth\LoginController@redirectToProvider');
    Route::get('login/fblogin/callback', 'Auth\LoginController@handleProviderCallback');
});

Route::group(['middleware' => ['api','cors'],'prefix' => 'api'], function () {
    Route::post('register', 'ApiController@register');     // 註冊
    Route::post('login', 'ApiController@login');           // 登入
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('get_user_details', 'APIController@get_user_details');  // 獲取用戶詳情
    });
});

Route::resource('photo', 'PhotoController');//跑七項功能

Route::get('article/{id}', 'ArticleController@show');
//{id} 指代任意字符串，在我們的規劃中，此字段為文章 ID，為數字
Route::get('api_article/{id}', 'ArticleController@api_show');
Route::get('map', 'MapController@show');
//Route::get('api_create', 'HomeController@api_create');
//Route::get('map', 'MapController@index');

Route::get('article/{id}/edit', 'ArticleController@edit');
Route::patch('article/{id}', 'ArticleController@update');

Auth::routes();

Route::post('/admin/member', 'MemberController@save');

Route::get('/', 'HomeController@index');
Route::get('apimap', 'MapController@icon');

