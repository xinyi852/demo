<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->middleware('guest');

    Route::get('/tasks', 'TaskController@index');
    Route::get('/task/new', function (){
        return view("tasks/task_new");
    });
    Route::get('/tasks/my', 'TaskController@mytask');
    Route::get('/task/edit/{date}', 'TaskController@edit');
    Route::get('/task/{date}', 'TaskController@show');
    Route::post('/task', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');

    Route::auth();
    Route::get('/user', 'UserController@index');
    Route::post('/user/change', 'UserController@change');

    Route::get('/admin/tasks', 'AdminTaskController@index')->middleware('admin');
    Route::get('/admin/tasks/all', 'AdminTaskController@adminTask')->middleware('admin');

});


