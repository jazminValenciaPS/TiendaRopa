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

// SubCategorias
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
Route::put('/productos/activar', 'ProductoController@activar');
Route::put('/productos/desactivar', 'ProductoController@desactivar');

//Producto
Route::get('/productosSub','ProductoController@productosSub');
Route::get('/detalleProducto' ,'ProductoController@detalleProducto');


// detalleProducto
Route::get('/slider','SliderController@index');
Route::post('/slider/registrar','SliderController@store');
Route::put('/slider/activar', 'SliderController@activar');
Route::post('/slider/actualizar', 'SliderController@update');


//colores
Route::get('/colores', 'colorController@index');
Route::post('/colores/registrar','colorController@store');
Route::put('/colores/activar', 'colorController@activar');
Route::put('/colores/desactivar', 'colorController@desactivar');

Route::get('/talla', 'TallaController@index');