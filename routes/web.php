<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\ZonesController;

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


  //Rutas de archivos y reportes
  Route::resource('/reports', 'App\Http\Controllers\ReportController');
  Route::get('/exportWorker', 'App\Http\Controllers\ReportController@exportWorker')->name('exportWorker');
  Route::get('/exportResult', 'App\Http\Controllers\ReportController@exportResult')->name('exportResult');
  Route::get('exportResultForm/{id}', 'App\Http\Controllers\ReportController@exportResultForm');
  
  //Route::resource('/zones', 'App\Http\Controllers\ZonesController');
   //Route::get('/download', 'App\Http\Controllers\ReportController@download')->name('download');
  




  //Rutas autenticacion
  Auth::routes();
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');

  
  //Ruta acceso a load result
  
 


Route::group(['middleware' => ['cors']], function () {
  //Rutas a las que se permitirá acceso
  //Rutas crud usuarios
  Route::resource('admin/users', 'App\Http\Controllers\AdminUserController');

  //Rutas crud areas
  Route::resource('admin/areas', 'App\Http\Controllers\AdminAreaController');

  //Rutas crud rosters
  Route::resource('admin/rosters', 'App\Http\Controllers\AdminRosterController');

  //Rutas crud workers
  Route::resource('workers', 'App\Http\Controllers\WorkersController');
  
  //Rutas crud zones
  Route::resource('zones', 'App\Http\Controllers\ZonesController');

  //Rutas crud results
  Route::resource('zones/{id}/results', 'App\Http\Controllers\ResultsController');


  Route::post('workers/results/load', [ResultsController::class, 'load'])->name('results.load');
 
  Route::post('zones/load', [ZonesController::class, 'load'])->name('zones.load'); 

  Route::get('zones/download', [ZonesController::class, 'download'])->name('zones.download');

  
});
