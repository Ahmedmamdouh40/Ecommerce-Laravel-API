<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;


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
Route::group(['prefix'=>'user'], function(){
    Route::post('/register',[UserController::class , 'store']);
    Route::post('/login', [UserController::class , 'login']);
    
});


Route::group(['prefix'=>'category' , 'middleware'=>['auth:sanctum' , 'role:admin']] ,function(){
    Route::post('/',[CategoryController::class , 'store'] );
    Route::put('/{category}',[CategoryController::class , 'update'] );
    Route::delete('/{category}',[CategoryController::class , 'destroy'] );
    
});

Route::group(['prefix'=>'category', 'middleware'=>['auth:sanctum']] ,function(){
    Route::get('/',[CategoryController::class , 'index'] );
    Route::get('/{category}',[CategoryController::class , 'show'] );
});

Route::group(['prefix'=>'brand' , 'middleware'=>['auth:sanctum' , 'role:admin']] ,function(){
    Route::post('/',[BrandController::class , 'store'] );
    Route::put('/{brand}',[BrandController::class , 'update'] );
    Route::delete('/{brand}',[BrandController::class , 'destroy'] );
    
});

Route::group(['prefix'=>'brand', 'middleware'=>['auth:sanctum']] ,function(){
    Route::get('/',[BrandController::class , 'index'] );
    Route::get('/{brand}',[BrandController::class , 'show'] );
    
});

Route::group(['prefix'=>'product' , 'middleware'=>['auth:sanctum' , 'role:admin']] ,function(){
    Route::post('/',[ProductController::class , 'store'] );
    Route::put('/{product}',[ProductController::class , 'update'] );
    Route::delete('/{product}',[ProductController::class , 'destroy'] );
});
                    
Route::group(['prefix'=>'product', 'middleware'=>['auth:sanctum']] ,function(){
    Route::get('/',[ProductController::class , 'index'] );
    Route::get('/{product}',[ProductController::class , 'show'] );
});