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
Route::get('/', function(){
	return view('welcome');
});

Route::get('todo/lists', 'TodoController@lists')->name('todoLists');

Route::post('todo/store', 'TodoController@store')->name('todoCreate');
Route::delete('todo/bulkdestroy', 'TodoController@bulkdestroy')->name('todoBulkDelete');
Route::delete('todo/destroy/{id}', 'TodoController@destroy')->name('todoDelete');
