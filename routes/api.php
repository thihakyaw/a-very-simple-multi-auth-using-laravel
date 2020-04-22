<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:user','userTokenValidate'])->group(function () {

    Route::get('/user/post','PostController@get');

    Route::post('/user/post','PostController@store');

    // Route::patch('/user/post','PostController@update');

    Route::delete('/user/post','PostController@delete');

    Route::get('/user/logout','UserController@logout');
});

Route::middleware(['auth:admin','adminTokenValidate'])->group(function () {


    Route::get('/admin/posts','AdminController@getAllPosts');

    Route::get('/admin/logout','AdminController@logout');

});


Route::post('/user/register','UserController@register');

Route::get('/user/login','UserController@login');


Route::post('/admin/register','AdminController@register');

Route::get('/admin/login','AdminController@login');
