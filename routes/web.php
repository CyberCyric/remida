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

Auth::routes();
Route::get('/registration_complete', function () {
    return view('registration_complete');
});

/* RETIROS */
Route::get('/', 'RetiroController@displayForm');
Route::get('/retiro', 'RetiroController@displayForm');
Route::post('/retiro', 'RetiroController@store');
Route::get('/admin/retiros_pendientes/{exportToCSV?}', 'RetiroController@listPendientes')->middleware('auth')->name('retiros-pendientes');
Route::get('/admin/retiros_aprobados/{exportToCSV?}', 'RetiroController@listAprobados')->middleware('auth')->name('retiros-aprobados');
Route::get('/admin/retiro/{retiro_id}', 'RetiroController@show')->middleware('auth');
Route::post('/admin/retiro/{retiro_id}/approve', 'RetiroController@approve')->middleware('auth');
Route::delete('/admin/retiro/{retiro_id}/reject', 'RetiroController@reject')->middleware('auth')->name('retiros.destroy');

/* EMPRESAS */
Route::get('/admin/empresas/', 'EmpresaController@list')->middleware('auth')->name('empresas');

Route::get('/admin/empresa/{id}', 'EmpresaController@show')->middleware('auth')->name('empresa');
Route::post('/admin/empresa/{id}', 'EmpresaController@update')->middleware('auth');

Route::post('/admin/empresa/', 'EmpresaController@store')->middleware('auth');
Route::get('/admin/empresa/', 'EmpresaController@create')->middleware('auth');

/* ENTREGAS */
Route::get('/admin/entregas/{agno?}', 'EntregaController@list')->middleware('auth')->name('entregas');
Route::get('/admin/entrega/', 'EntregaController@create')->middleware('auth');
Route::post('/admin/entrega/', 'EntregaController@store')->middleware('auth');
Route::delete('/admin/entrega/{entrega_id}/', 'EntregaController@delete')->middleware('auth');
Route::get('/admin/entrega/{id}', 'EntregaController@show')->middleware('auth');
Route::get('/admin/entrega_items/{id}', 'EntregaItemController@showItems')->middleware('auth');
Route::post('/admin/entrega_items/{id}', 'EntregaItemController@storeItem')->middleware('auth');
Route::delete('/admin/entrega_items/{entrega_id}/{item_id}', 'EntregaItemController@removeItem')->middleware('auth');

/* USUARIOS */
Route::get('/admin/usuarios', 'UsuarioController@list')->middleware('auth')->name('usuarios');
Route::get('/admin/usuario/{id}', 'UsuarioController@show')->middleware('auth')->name('usuario');
Route::post('/admin/usuario/{id}', 'UsuarioController@update')->middleware('auth')->name('usuario');
Route::delete('/admin/usuario/{id}', 'UsuarioController@delete')->middleware('auth')->name('usuario');


Route::get('/admin/logout', 'Auth\LoginController@logout')->middleware('auth');

/************* REPORTES ****************/
Route::get('/admin/', 'ReporteController@reporteStock')->name('stock')->middleware('auth');
Route::get('/admin/home', 'ReporteController@reporteStock')->middleware('auth')->name('stock');
Route::get('/admin/reportes/stock', 'ReporteController@reporteStock')->middleware('auth')->name('stock');

Route::get('/admin/reportes/entregas/{desde?}/{hasta?}', 'ReporteController@reporteEntregas')->middleware('auth')->name('reporte-entregas');
Route::post('/admin/reportes/entregas/{desde?}/{hasta?}', 'ReporteController@getDataEntregas')->middleware('auth');

Route::get('/admin/reportes/distritos/{desde?}/{hasta?}', 'ReporteController@reporteDistritos')->middleware('auth')->name('reporte-distritos');
Route::post('/admin/reportes/distritos/{desde}/{hasta}', 'ReporteController@getDataDistritos')->middleware('auth');
Route::get('/admin/reportes/distritosTotales/{desde}/{hasta}', 'ReporteController@reporteDistritosTotales')->middleware('auth')->name('reporte-distritos-totales');

Route::get('/admin/reportes/empresas_registradas/{desde?}/{hasta?}', 'ReporteController@reporteEmpresasRegistradas')->middleware('auth');
Route::post('/admin/reportes/empresas_registradas/{desde?}/{hasta?}', 'ReporteController@getDataEmpresasRegistradas')->middleware('auth');

Route::get('/admin/reportes/retiros/{desde?}/{hasta?}', 'ReporteController@reporteRetiros')->middleware('auth')->name('reporte-retiros');
Route::post('/admin/reportes/retiros/{desde}/{hasta}', 'ReporteController@getDataReporteRetiros')->middleware('auth');

Route::get('/admin/reportes/stock_historico/{desde?}/{hasta?}', 'ReporteController@reporteStockHistorico')->middleware('auth')->name('reporte-stock-historico');
Route::post('/admin/reportes/stock_historico/{desde?}/{hasta?}', 'ReporteController@getDataStockHistorico')->middleware('auth');

Route::get('/admin/reportes/mapa_distritos/{desde?}/{hasta?}', 'ReporteController@reporteMapaDistritos')->middleware('auth');

Route::get('/admin/ayuda', 'Controller@showHelp')->middleware('auth')->name('ayuda');