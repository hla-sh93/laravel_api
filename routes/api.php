<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\Admin\AuthController;

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

// all api here must be authenticated

Route::group(['middleware' => ['api','checkPassword','changeLang'],'namespace' => 'Api'], function(){

    Route::post('get-main-categories', [CategoriesController::class, 'index']);
    Route::post('get-category-by-id', [CategoriesController::class, 'getCatById']);

    // admin login
    Route::group(['prefix'=>'admin', 'namespace'=>'Admin'],function () {
        Route::get('login', [AuthController::class, 'login']);
    });
    

});

Route::group(['middleware' => ['api','checkPassword','changeLang', 'checkAdminToken:admin-api'],'namespace' => 'Api'], function(){

    Route::post('get-main-categories', [CategoriesController::class, 'index']);

});