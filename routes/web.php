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

// acces feature
Route::get('/feature','App\Http\Controllers\access\FeatureController@index')->name('feature-list');
Route::get('/feature/form/{feature_group_id?}','App\Http\Controllers\access\FeatureController@Form')->name('feature-form');
Route::delete('/feature/{feature_group_id?}','App\Http\Controllers\access\FeatureController@Delete')->name('feature-delete');
Route::post('/feature','App\Http\Controllers\access\FeatureController@Setup')->name('feature-submit');
Route::put('/feature','App\Http\Controllers\access\FeatureController@Setup')->name('feature-submit');


// masteri kategori
Route::get('/kategori','App\Http\Controllers\master_katalog\KategoriController@index')->name('kategori-list');
Route::get('/kategori/form/{kategori_id?}','App\Http\Controllers\master_katalog\KategoriController@Form')->name('kategori-form');
Route::delete('/kategori/{kategori_id?}','App\Http\Controllers\master_katalog\KategoriController@Delete')->name('kategori-delete');
Route::post('/kategori','App\Http\Controllers\master_katalog\KategoriController@Setup')->name('kategori-submit');
Route::put('/kategori','App\Http\Controllers\master_katalog\KategoriController@Setup')->name('kategori-submit');

// master jenis produk
Route::get('/jenis_produk','App\Http\Controllers\master_katalog\JenisProdukController@index')->name('jenis_produk-list');
Route::get('/jenis_produk/form/{jenis_produk_id?}','App\Http\Controllers\master_katalog\JenisProdukController@Form')->name('jenis_produk-form');
Route::post('/jenis_produk','App\Http\Controllers\master_katalog\JenisProdukController@Setup')->name('jenis_produk-submit');
Route::put('/jenis_produk','App\Http\Controllers\master_katalog\JenisProdukController@Setup')->name('jenis_produk-submit');
Route::delete('/jenis_produk/{jenis_produk_id?}','App\Http\Controllers\master_katalog\JenisProdukController@Delete')->name('jenis_produk-delete');

//use App\Http\Controllers\HomeController;
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
//Route::view('/', 'master/m_grup_fitur');

// dependent
Route::post('/dependent','App\Http\Controllers\dependent\DependentController@fetch_dropdown')->name('dynamic-dropdown');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
