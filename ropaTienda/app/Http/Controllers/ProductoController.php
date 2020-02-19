<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Imagen;
use App\Producto_color;
use App\Producto_talla;



use Illuminate\Support\Facades\Log;
use Request as Peticion ;


use File;

class ProductoController extends Controller
{

    public function selectProductos(Request $request){
        if (!$request->ajax()) return redirect('/administrador');

        return  $productos = DB::table('producto')
        ->join('producto_talla','producto_talla.idProduc','=','producto.idProducto')
        ->join('tallas','tallas.idTalla', '=','producto_talla.idTalla')
        ->join('imagenes','imagenes.idImagen', '=','producto.idImg')
        ->join('sub_categorias','sub_categorias.idSubCategorias', '=','producto.idSubCat')
        ->select('producto.NombreProducto','producto.Descripcion','producto.Status','producto.Precio',
        'producto.idProducto','producto.Existencia','imagenes.idImagen','imagenes.Imagen','sub_categorias.idSubCategorias',
        'sub_categorias.NombreSub')
        ->distinct()
        ->get();

    }

    public function index(Request $request){
        if (!$request->ajax()) return redirect('/administrador');


        return  $productos = DB::table('producto')
        ->join('producto_talla','producto_talla.idProduc','=','producto.idProducto')
        ->join('tallas','tallas.idTalla', '=','producto_talla.idTalla')
        ->join('imagenes','imagenes.idImagen', '=','producto.idImg')
        ->join('sub_categorias','sub_categorias.idSubCategorias', '=','producto.idSubCat')
        ->select('producto.NombreProducto',
        'producto.Descripcion','producto.Status','producto.Precio','producto.idProducto',
        'producto.Existencia','imagenes.idImagen','imagenes.Imagen','sub_categorias.idSubCategorias',
        'sub_categorias.NombreSub')
        ->where('producto.Status','=',1)
        ->distinct()
        ->get();

    }

    public function detalleProducto(Request $request){
        if (!$request->ajax()) return redirect('/administrador');

        $id = $request->id;


        return $productos = DB::table('producto')
        ->join('producto_talla','producto_talla.idProduc','=','producto.idProducto')

        ->join('tallas','tallas.idTalla', '=','producto_talla.idTalla')
        ->join('imagenes','imagenes.idImagen', '=','producto.idImg')
        ->join('sub_categorias','sub_categorias.idSubCategorias', '=','producto.idSubCat')
        ->select('producto.NombreProducto','producto.Descripcion',
        'producto.Precio','producto.Existencia','imagenes.idImagen','imagenes.Imagen','sub_categorias.idSubCategorias',
        'sub_categorias.NombreSub','producto.idProducto')
        ->where([
            ['producto.idProducto','=',$id],
            ['producto.Status','=',1]   
        ])
        ->distinct()
        ->get();


        
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/administrador');
       
        $producto = new Producto();        
        $imagenes = new Imagen();
        
        $img = Peticion::file('file');
        $extension = $img -> guessExtension();
        $date = date('d-m-Y_h-i-s-ms-a');
        $prefijo = 'Image';
        $nombreImagen = $prefijo.'_'.$date.'.'.$extension;
        $img->move('img', $nombreImagen);
        $imagenes->Imagen = $nombreImagen;        
        $imagenes->Tipo = 'P';
        $imagenes->save();
        $idImg = $imagenes->idImagen;



        
        //    Inserción a productos
        $producto->NombreProducto = $request->NombreProducto;
        $producto->Descripcion = $request->Descripcion;
        $producto->Precio = $request->Precio;
        $producto->Existencia = $request->Existencia;
        $producto->idSubcat = $request->idSubcat;
        // $producto->idColor = $request->idColor;
        // $producto->idTalla = $request->idTalla;
        $producto->idImg = $idImg ;
        $producto->Status = '1';
        $producto->save();
        $idProduc = $producto->idProducto;
        $data = explode(",", $request->idColor);

        foreach ($data as $idColor){
            $color = new Producto_color();
            $color->idProduc = $idProduc;
            $color->idColor = $idColor;
            $color->save();
        }
        $data = explode(",", $request->idTalla);
        foreach ($data as $idTalla){
            // error_log('entro' . $idTalla . $idProduc);
            $talla = new Producto_talla();
            $talla->idProduc = $idProduc;
            $talla->idTalla = $idTalla ;
            $talla->save();
        }
        // error_log('salio');
    }

    public function productosSub(Request $request){
        $id = $request->id;
        return  $productos = DB::table('producto')
        ->join('producto_talla','producto_talla.idProduc','=','producto.idProducto')
        ->join('tallas','tallas.idTalla', '=','producto_talla.idTalla')
        ->join('imagenes','imagenes.idImagen', '=','producto.idImg')
        ->join('sub_categorias','sub_categorias.idSubCategorias', '=','producto.idSubCat')
        ->select('producto.NombreProducto','producto.Descripcion','producto.Status',
        'producto.Precio','producto.idProducto','producto.Existencia','imagenes.idImagen','imagenes.Imagen','sub_categorias.idSubCategorias',
        'sub_categorias.NombreSub')
        ->where([
            ['producto.idSubcat','=',$id],
            ['producto.Status','=',1]   
        ])
        ->distinct()
        ->get();

    }

    

    public function show(Request $request){

    }
    
   
    
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/administrador');
        
        $idProducto = $request->idProducto;
        $producto = Producto::findOrFail($idProducto);
        $producto->NombreProducto = $request->NombreProducto;
        $producto->Descripcion = $request->Descripcion;
        $producto->Precio = $request->Precio;
        $producto->Existencia = $request->Existencia;
        $producto->idSubcat = $request->idSubcat;

        $producto->save();
        $idProduc = $producto->idProducto;
        $data = explode(",", $request->idColor);
        DB::table('producto_color')->where('idProduc', $idProduc)->delete();
        foreach ($data as $idColor){
            $color = new Producto_color();
            $color->idProduc = $idProduc;
            $color->idColor = $idColor;
            $color->save();
        }
        $data = explode(",", $request->idTalla);
        DB::table('producto_talla')->where('idProduc', $idProduc)->delete();
        foreach ($data as $idTalla){
            // error_log('entro' . $idTalla . $idProduc);
            $talla = new Producto_talla();
            $talla->idProduc = $idProduc;
            $talla->idTalla = $idTalla ;
            $talla->save();
        }
 
    }

    public function desactivar(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->Status = '0';
        $producto->save(); 
        
    }
    
    
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/administrador');
        $producto = Producto::findOrFail($request->id);
        $producto->Status = '1';
        $producto->save();
    }

    public function recientes(Request $request){
        return  $productos = DB::table('producto')
        ->join('imagenes','imagenes.idImagen', '=','producto.idImg')
        ->select('producto.NombreProducto','producto.Descripcion','producto.idProducto',
        'imagenes.idImagen','imagenes.Imagen')->orderBy('idProducto', 'desc')->limit(3)
        ->get();


    }
}
