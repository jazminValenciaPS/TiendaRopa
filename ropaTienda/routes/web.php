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

//Ruta página principal
Route::get('/', function () {
    return view('contenido/contenido');
});

//Ruta página de administrador "consola"
Route::get('/consola', function () {
    return view('contenido/consola');
});

// Sub Categorias
Route::get('/subcategoria', 'SubCategoriaController@index');
Route::get('/subcategoria/accesorios', 'SubCategoriaController@accesorios');
Route::get('/subcategoria/ropa', 'SubCategoriaController@ropa');
Route::get('/subcategoria/cosmeticos', 'SubCategoriaController@cosmeticos');

Route::post('/subcategoria/registrar', 'SubCategoriaController@store');
Route::post('/subcategoria/actualizar', 'SubCategoriaController@update');
Route::put('/subcategoria/desactivar', 'SubCategoriaController@desactivar');
Route::put('/subcategoria/activar', 'SubCategoriaController@activar');

//Productos
Route::get('/productos', 'ProductoController@index');
Route::post('/productos/registrar', 'ProductoController@store');
Route::post('/productos/actualizar', 'ProductoController@update');

//Producto
Route::get('/productosSub','ProductoController@productosSub');
Route::get('/detalleProducto','ProductoController@detalleProducto');


// detalleProducto
Route::get('/slider','SliderController@index');
Route::put('/slider/activar', 'SliderController@activar');

//colores
Route::get('/colores', 'colorController@index');