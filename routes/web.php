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

// Route::get('/', function () {
//     return view('welcome');
// });




Auth::routes();

Route::view('/', 'landing-page/landing-page')->name('landing-page');
// logout
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// acces feature_group
Route::get('/feature_group','App\Http\Controllers\access\FeatureGroupController@index')->name('feature-group-list');
Route::get('/feature_group/form/{feature_group_id?}','App\Http\Controllers\access\FeatureGroupController@Form')->name('feature-group-form');
Route::delete('/feature_group/{feature_group_id?}','App\Http\Controllers\access\FeatureGroupController@Delete')->name('feature-group-delete');
Route::post('/feature_group','App\Http\Controllers\access\FeatureGroupController@Setup')->name('feature-group-submit');
Route::put('/feature_group','App\Http\Controllers\access\FeatureGroupController@Setup')->name('feature-group-submit');


//use App\Http\Controllers\HomeController;
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
//Route::view('/', 'master/m_grup_fitur');

// dependent
Route::post('/dependent','App\Http\Controllers\dependent\DependentController@fetch_dropdown')->name('dynamic-dropdown');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
