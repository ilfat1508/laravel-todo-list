<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;

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


    /**
     * Show Task Dashboard
     */
Route::get('/', function () {
    return redirect('/home');
});

Route::get('/project', 'ProjectController@index');
Route::get('/project/delete/{id}', 'ProjectController@delete')->name('project.delete');
Route::get('/project/show/{id}', 'ProjectController@show')->name('project.show');
Route::post('/project', 'ProjectController@store')->name('project.store');

Route::post('/task/{id}', 'TaskController@store')->name('task.store');

Route::get('/test', 'TestController@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
