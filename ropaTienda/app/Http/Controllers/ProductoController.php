<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Imagen;

use Illuminate\Support\Facades\Log;
use Request as Peticion ;


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
        ->select('tallas.idTalla','tallas.Talla','tallas.idTalla','producto.NombreProducto','producto.Descripcion','producto.Status',
        'producto.Precio','producto.idProducto','producto.Existencia','imagenes.idImagen','imagenes.Imagen','sub_categorias.idSubCategorias',
        'sub_categorias.NombreSub','colores.NombreColor','colores.id')
        ->get();

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
        'sub_categorias.NombreSub','colores.NombreColor','colores.id','producto.idProducto')->where('producto.idProducto','=',$id)
        ->get();
        // return $productos;

        

        // return ['productos' => $productos]; 
            //    $producto = Producto::all()->where('idProducto','=',$id);
            //  return  $producto; 
        
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = new Producto();
        $imagenes = new Imagen();
        $imagenes->Imagen = $request->Imagen;
        $imagenes->Tipo = 'P';
        $imagenes->save();

       // $tipo = 'P';
        $idImg=1;
        $imagen = new Imagen();
        $imagen = Peticion::file('file');
        $extension = $imagen -> guessExtension();
        $date = date('d-m-Y_h-i-s-ms-a');
        $prefijo = 'Image';
        $nombreImagen = $prefijo.'_'.$date.'.'.$extension;
        $imagen->Imagen = $nombreImagen;
        $idImg++;
 
        // $imagen = Peticion::file('file');
        
        // $extension = $imagen->guessExtension();
        // $date = date('d-m-Y_h-i-s-ms-a');
        // $prefijo = 'Image';
        // $nombreImagen = $prefijo.'_'.$date.'.'.$extension;
        // $imagen->move('img', $nombreImagen);
        // $slider->Imagen = $nombreImagen;


       

        $producto->NombreProducto = $request->NombreProducto;
        $producto->Descripcion = $request->Descripcion;
        $producto->Precio = $request->Precio;
        $producto->Existencia = $request->Existencia;
        $producto->idSubcat = $request->idSubcat;
        $producto->idColor = $request->idColor;
        $producto->idTalla = $request->idTalla;
        $producto->idImg = $idImg ;
        $producto->Status = '1';
        
        // $imagenSub = Peticion::file('file');
               
        $producto->save();
        $imagen->save();

        $producto = Producto::create([
            'idImg' => $imagenes['idImagen']
        ]);

    }

    public function productosSub(Request $request){
        $id = $request->id;


        return  $productos = DB::table('producto')
        ->join('tallas','tallas.idTalla', '=','producto.idTalla')
        ->join('imagenes','imagenes.idImagen', '=','producto.idImg')
        ->join('sub_categorias','sub_categorias.idSubCategorias', '=','producto.idSubCat')
        ->join('colores','colores.id', '=','producto.idcolor')
        ->select('tallas.idTalla','tallas.Talla','tallas.idTalla','producto.NombreProducto','producto.Descripcion','producto.Status',
        'producto.Precio','producto.idProducto','producto.Existencia','imagenes.idImagen','imagenes.Imagen','sub_categorias.idSubCategorias',
        'sub_categorias.NombreSub','colores.NombreColor','colores.id')->where('producto.idSubcat','=',$id)
        ->get();

        //  return $productos = DB::table('producto')
        // ->join('tallas','tallas.idTalla', '=','producto.idTalla')
        // ->join('imagenes','imagenes.idImagen', '=','producto.idImg')
        // ->join('sub_categorias','sub_categorias.idSubCategorias', '=','producto.idSubCat')
        // ->join('colores','colores.id', '=','producto.idcolor')
        // ->select('tallas.idTalla','tallas.Talla','tallas.idTalla','producto.NombreProducto','producto.Descripcion',
        // 'producto.Precio','producto.idProducto','producto.Existencia','imagenes.idImagen','imagenes.Imagen','sub_categorias.idSubCategorias',
        // 'sub_categorias.NombreSub','colores.NombreColor','colores.id')->where('producto.idSubcat','=',$id)
        // ->get();

        // return $productos;


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

        $producto = Producto::findOrFail($request->idProducto);
        
        $producto->NombreProducto = $request->NombreProducto;
        $producto->Descripcion = $request->Descripcion;
        $producto->Precio = $request->Precio;
        $producto->Existencia = $request->Existencia;
        $producto->idSubcat = $request->idSubcat;
        $producto->idColor = $request->idColor;
        $producto->idTalla = $request->idTalla;
        
        $producto->save();   
    }

    public function desactivar(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->Status = '0';
        $producto->save(); 
        
    }
    
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($request->id);
        $producto->Status = '1';
        $producto->save();
    }
}
