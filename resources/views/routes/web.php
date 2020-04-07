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
Route::get('/registration_complete', function () {
    return view('registration_complete');
});
Route::get('/admin/home', 'ReporteController@reporteStock')->middleware('auth')->name('stock');
Route::get('/admin/reportes/stock', 'ReporteController@reporteStock')->middleware('auth')->name('stock');
//Route::get('/retiro', 'RetiroController@displayForm');
//Route::post('/retiro', 'RetiroController@store');
//Route::get('/admin/retiros', 'RetiroController@list')->middleware('auth')->name('retiros');
//Route::get('/admin/retiro/{id}', 'RetiroController@show')->middleware('auth');

Route::get('/admin/empresas', 'EmpresaController@list')->middleware('auth')->name('empresas');
Route::post('/admin/empresa/{id}', 'EmpresaController@update')->middleware('auth');
Route::post('/admin/empresa', 'EmpresaController@store')->middleware('auth');
Route::get('/admin/empresa/{id}', 'EmpresaController@show')->middleware('auth')->name('empresa');
Route::get('/admin/empresa/', 'EmpresaController@create')->middleware('auth');

Route::get('/admin/entregas', 'EntregaController@list')->middleware('auth')->name('entregas');
Route::get('/admin/entrega/', 'EntregaController@create')->middleware('auth');
Route::post('/admin/entrega/', 'EntregaController@store')->middleware('auth');



//Route::get('/admin/usuarios', 'UsuarioController@list')->middleware('auth')->name('usuarios');
//Route::get('/admin/usuario/{id}', 'UsuarioController@show')->middleware('auth')->name('usuario');
//Route::post('/admin/usuario/{id}', 'UsuarioController@update')->middleware('auth')->name('usuario');
//Route::delete('/admin/usuario/{id}', 'UsuarioController@delete')->middleware('auth')->name('usuario');

Route::get('/admin/logout', 'Auth\LoginController@logout')->middleware('auth');

//Route::get('/admin/', 'ReporteController@reporteStock')->name('stock');
