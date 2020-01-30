<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;

class ProductoController extends Controller
{
    public function index(Request $request){
        // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        // $productos = Producto::paginate(2);
        if ($buscar==''){
            $personas = Producto::join('tallas','producto.idTalla','=','tallas.idTalla')
            ->join('imagenes','producto.idImg','=','imagenes.idImagen')
            ->join('sub_categorias','producto.idSubcat','=','sub_categorias.idSubCategorias')
            ->join('colores','producto.idColor','=','colores.id')
            ->select('tallas.idTalla','tallas.Talla','imagenes.idImagen',
            'imagenes.Imagen','sub_categorias.idSubCategorias','sub_categorias.Nombre',
            'colores.id','colores.Nombre','producto.Nombre','producto.Descripcion',
            'producto.Precio','producto.Existencia')
            ->orderBy('personas.id', 'desc')->paginate(3);
        }
        else{
            $personas = Producto::join('tallas','producto.idTalla','=','tallas.idTalla')
            ->join('imagenes','producto.idImg','=','imagenes.idImagen')
            ->join('sub_categorias','producto.idSubcat','=','sub_categorias.idSubCategorias')
            ->join('colores','producto.idColor','=','colores.id')
            ->select('tallas.idTalla','tallas.Talla','imagenes.idImagen',
            'imagenes.Imagen','sub_categorias.idSubCategorias','sub_categorias.Nombre',
            'colores.id','colores.Nombre','producto.Nombre','producto.Descripcion',
            'producto.Precio','producto.Existencia')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(3);
        }



        if($buscar == ''){
            $productos = Producto::orderBy('idProducto','desc')->paginate(3); 
        }
         $productos = Producto::all();
        return [
                "pagination" => [
                    "total" => $productos -> total(),
                    "current_page" => $productos -> currentPage(),
                    "per_page" => $productos -> perPage(),
                    "last_page" => $productos -> lastPage(),
                    "from" => $productos -> firstItem(),
                    "to" => $productos -> lastItem()
            ],
            'productos' => $productos
        ];
        
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        // $subCat = new subCategoria();
        // $subCat->Nombre = $request->Nombre;
        // $subCat->Status = '1';
        // $subCat->save();
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
