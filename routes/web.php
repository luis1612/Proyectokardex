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
    return view('auth/login');
});

//Creado para realizar un grupo de rutas de recursos para CRUD y otras funciones
Route::resource('almacen/categoria', 'CategoriaController');
Route::resource('almacen/articulo', 'ArticuloController');
Route::get('descargar-articulos', 'ArticuloController@excel')->name('articulos.excel');
Route::get('almacen/articulo/kardex/{id}','ArticuloController@kardex')->name('articulo.kardex');
Route::resource('ventas/cliente', 'ClienteController');
Route::resource('compras/proveedor', 'ProveedorController');
Route::resource('compras/ingreso', 'IngresoController');
Route::resource('ventas/venta', 'VentaController');
Route::resource('seguridad/usuario', 'UsuarioController');
Route::resource('inventario', 'InventarioController');
Route::get('acercade', 'AcercadeController@index');
Route::get('ayuda', 'AyudaController@index');


Route::get('notificaciones', 'NotificationController@index')->name('notifications.index');
Route::patch('notificaciones/{id}', 'NotificationController@read')->name('notifications.read');
Route::delete('notificaciones/{id}', 'NotificationController@destroy')->name('notifications.destroy');

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout','Auth\LoginController@logout');
Route::get('/{slug?}','HomeController@index');