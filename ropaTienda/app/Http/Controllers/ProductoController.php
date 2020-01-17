<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;

class ProductoController extends Controller
{
    public function index(Request $request){
        // if (!$request->ajax()) return redirect('/');

        // $buscar = $request->buscar;
        // $criterio = $request->criterio;

        $productos = Producto::paginate(2);

        // if($buscar == ''){
        //     $productos = Producto::orderBy('id','desc')->paginate(3); 
        // }
        // $productos = Producto::all();
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
