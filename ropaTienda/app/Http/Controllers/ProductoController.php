<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;

use Illuminate\Support\Facades\Log;


use File;
class ProductoController extends Controller
{

    public function index(Request $request){
        // if (!$request->ajax()) return redirect('/');


        return  $productos = DB::table('producto')
        ->join('tallas','tallas.idTalla', '=','producto.idTalla')
        ->join('imagenes','imagenes.idImagen', '=','producto.idImg')
        ->join('sub_categorias','sub_categorias.idSubCategorias', '=','producto.idSubCat')
        ->join('colores','colores.id', '=','producto.idcolor')
        ->select('tallas.idTalla','tallas.Talla','tallas.idTalla','producto.NombreProducto','producto.Descripcion',
        'producto.Precio','producto.Existencia','imagenes.idImagen','imagenes.Imagen','sub_categorias.idSubCategorias',
        'sub_categorias.NombreSub','colores.NombreColor','colores.id')
        ->get();

        // return ['productos' => $productos]; 

    }

    public function detalleProducto(Request $request){
        $id = $request->id;

        //   print_r($id);

        return $productos = DB::table('producto')
        ->join('tallas','tallas.idTalla', '=','producto.idTalla')
        ->join('imagenes','imagenes.idImagen', '=','producto.idImg')
        ->join('sub_categorias','sub_categorias.idSubCategorias', '=','producto.idSubCat')
        ->join('colores','colores.id', '=','producto.idcolor')
        ->select('tallas.idTalla','tallas.Talla','tallas.idTalla','producto.NombreProducto','producto.Descripcion',
        'producto.Precio','producto.Existencia','imagenes.idImagen','imagenes.Imagen','sub_categorias.idSubCategorias',
        'sub_categorias.NombreSub','colores.NombreColor','colores.id')->where('producto.idProducto','=',$id)
        ->get();
        // return $productos;

        

        // return ['productos' => $productos]; 
            //    $producto = Producto::all()->where('idProducto','=',$id);
            //  return  $producto; 
        
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        // $subCat = new subCategoria();
        // $subCat->Nombre = $request->Nombre;
        // $subCat->Status = '1';
        // $subCat->save();
    }

    public function productosSub(Request $request){
        $id = $request->id;


         $productos = DB::table('producto')
        ->join('tallas','tallas.idTalla', '=','producto.idTalla')
        ->join('imagenes','imagenes.idImagen', '=','producto.idImg')
        ->join('sub_categorias','sub_categorias.idSubCategorias', '=','producto.idSubCat')
        ->join('colores','colores.id', '=','producto.idcolor')
        ->select('tallas.idTalla','tallas.Talla','tallas.idTalla','producto.NombreProducto','producto.Descripcion',
        'producto.Precio','producto.Existencia','imagenes.idImagen','imagenes.Imagen','sub_categorias.idSubCategorias',
        'sub_categorias.NombreSub','colores.NombreColor','colores.id')->where('producto.idSubcat','=',$id)
        ->get();

        return $productos;


    //   print_r($id);
        //    $productos = Producto::all()->where('idSubcat','=',$id);
        //  return  $productos;
        //  $pro =
        // return  $productos = Producto::where('idSubCate',$idSubCate);


    }

    

    public function show(Request $request){

    }
    
   
    
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        // $subCat = subCategoria::findOrFail($request->id);
        // $subCat->Nombre = $request->Nombre;
        // $subCat->Status = '1';
        // $subCat->save();   
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        // $subCat = subCategoria::findOrFail($request->id);
        // $subCat->Status = '0';
        // $subCat->save(); 
    }
    
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        // $subCat = subCategoria::findOrFail($request->id);
        // $subCat->Status = '1';
        // $subCat->save();
    }
}
