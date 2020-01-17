<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subCategoria;

class SubCategoriaController extends Controller
{
    public function index()
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $subCat = subCategoria::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $subCat = subCategoria::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $subCat->total(),
                'current_page' => $subCat->currentPage(),
                'per_page'     => $subCat->perPage(),
                'last_page'    => $subCat->lastPage(),
                'from'         => $subCat->firstItem(),
                'to'           => $subCat->lastItem(),
            ],
            'subCat' => $subCat
        ];
         
    }

    public function store(Request $request)
    {
        $subCat = new subCategoria();
        $subCat->Nombre = $request->Nombre;
        $subCat->Status = '1';
        $subCat->save();
    }
    public function update(Request $request)
    {
        $subCat = subCategoria::findOrFail($request->id);
        $subCat->Nombre = $request->Nombre;
        $subCat->Status = '1';
        $subCat->save();   
    }

    public function desactivar(Request $request)
    {
        $subCat = subCategoria::findOrFail($request->id);
        $subCat->Status = '0';
        $subCat->save(); 
    }
    
    public function activar(Request $request)
    {
        $subCat = subCategoria::findOrFail($request->id);
        $subCat->Status = '1';
        $subCat->save();
    }
}
