<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

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


Route::get('/', [ClienteController::class, 'index'])->name('/');

Route::group(['middleware' => 'auth', 'prefix' => 'cliente'], function(){
    Route::get('/', ['as' => 'cliente.index', 'uses' => "App\Http\Controllers\ClienteController@index"]);
    Route::get('/administrativo', ['as' => 'cliente.administrativo', 'uses' => "App\Http\Controllers\ClienteController@administrativo"]);
    Route::get('/create', ['as' => 'cliente.create', 'uses' => "App\Http\Controllers\ClienteController@create"]);
    Route::post('/store', ['as' => 'cliente.store', 'uses' => "App\Http\Controllers\ClienteController@store"]);
    Route::get('/edit/{id}', ['as' => 'cliente.edit', 'uses' => "App\Http\Controllers\ClienteController@edit"]);
    Route::put('/update/{id}', ['as' => 'cliente.update', 'uses' => "App\Http\Controllers\ClienteController@update"]);
    Route::get('/show/{id}', ['as' => 'cliente.show', 'uses' => "App\Http\Controllers\ClienteController@show"]);
    Route::delete('/destroy/{id}', ['as' => 'cliente.destroy', 'uses' => "App\Http\Controllers\ClienteController@destroy"]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
