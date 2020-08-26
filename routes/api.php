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

Route::group(['middleware' => ['cors', 'json.response']], function () {
	Route::post('/register','Auth\AuthController@register');
	Route::post('/login','Auth\AuthController@login');
});

Route::middleware('auth:api')->group(function () {
	// Products API Routes
	Route::get('product/list','ProductController@listPaginate');
	Route::get('sortBy/{order}/{val}','ProductController@sortProduct');
	Route::get('product/{id}','ProductController@getProductById');
	Route::get('product/list/category/{id}','ProductController@getProductByCategoryID');
	Route::post('product/create','ProductController@createProduct');
	Route::delete('product/delete/{id}','ProductController@deleteProduct');

	// Category API Routes
	Route::get('category/list','CategoryController@listCategory');
	Route::post('category/create','CategoryController@createCategory');

	//Room API
	Route::get('room/list','RoomController@list');
});