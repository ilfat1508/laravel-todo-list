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
Route::patch('/project/{id}', 'ProjectController@update')->name('project.update');
Route::get('/project/show/{id}/{tasksStatus?}', 'ProjectController@show')->name('project.show');
Route::post('/project', 'ProjectController@store')->name('project.store');

Route::post('/task/{id}', 'TaskController@store')->name('task.store');
Route::get('/task/delete/{taskId}/{projectId}', 'TaskController@delete')->name('task.delete');
Route::patch('/task/{taskId}/{projectId}/{tasksStatus?}', 'TaskController@update')->name('task.update');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
