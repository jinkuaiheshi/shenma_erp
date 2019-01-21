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
Route::any('/admin/login','Admin\AdminController@login' );
Route::get('/admin/logout','Admin\AdminController@logout' );

Route::any('/admin/forget','Admin\AdminController@forget' );
Route::group(['middleware'=>['web','Admin']],function() {
    Route::any('/admin/index','Admin\AdminController@index' );

    Route::get('/admin/users','Admin\UserController@index' );
    Route::post('/admin/user/add','Admin\UserController@add' );
    Route::get('/admin/ajax/user/status/{id}','Admin\UserController@status' );
    Route::get('/admin/data','Admin\UserController@data' );
});