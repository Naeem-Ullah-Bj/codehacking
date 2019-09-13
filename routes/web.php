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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'admin'],function (){
    Route::get('/AdminU/{id}','AdminUserController@destroy');
    Route::resource('admin/users','AdminUserController');


});

Route::resource('admin/posts','AdminPostController');
Route::post('post','AdminPostController@update');
Route::get('destroy/{id}','AdminPostController@destroy');




