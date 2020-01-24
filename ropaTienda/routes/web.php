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
Route::post('/subcategoria/registrar', 'SubCategoriaController@store');
Route::put('/subcategoria/actualizar', 'SubCategoriaController@update');
Route::put('/subcategoria/desactivar', 'SubCategoriaController@desactivar');
Route::put('/subcategoria/activar', 'SubCategoriaController@activar');

//Productos
Route::get('/productos', 'ProductoController@index');

//Colores
Route::get('/colores', 'ColorController@index');
Route::post('/colores/registrar', 'ColorController@store');
Route::put('/colores/desactivar', 'ColorController@desactivar');



//Slider
Route::get('/slider', 'SliderController@index');
Route::post('/slider/registrar', 'SliderController@store');
Route::put('/slider/actualizar', 'SliderController@update');
Route::put('/slider/desactivar', 'SliderController@desactivar');
Route::put('/slider/activar', 'SliderController@activar');
