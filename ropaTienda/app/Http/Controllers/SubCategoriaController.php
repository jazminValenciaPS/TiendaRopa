<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subCategoria;


use File;
use Request as Peticion;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; 

class SubCategoriaController extends Controller
{
    public function index(Request $request) {
        if (!$request->ajax()) return redirect('/');

        return $subCat = subCategoria::all()->where('Status','=','1');

        // $subCat = subCategoria::join('categorias','categorias.idCategorias', '=' ,)
        //     ->select('sub_categorias.idSubCategorias', 'sub_categorias.idCate', 'sub_categorias.Nombre', 
        //     'categorias.nombre as NombreCategorias','sub_categorias.Status')
        //     ->where('Status','=','1');
        //    ->orderBy('sub_categorias.idSubCategorias', 'desc');

        // return ['subCate' => $subCat];
         
    }

    public function store(Request $request)
    {

        $subCat = new subCategoria();
    
        $subCat->idCate = $request->idCate;
        $subCat->Nombre = $request->Nombre;
        $subCat->Status = '1';
        
        $imagenSub = Peticion::file('file');
               
        $extension = $imagenSub->guessExtension();
        $date = date('d-m-Y_h-i-s-ms-a');
        $prefijo = 'Image';
        $nombreImagen = $prefijo.'_'.$date.'.'.$extension;
        $imagenSub->move('img', $nombreImagen);
        $subCat->imagenSub = $nombreImagen;
        

        $subCat->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $subCat = subCategoria::findOrFail($request->id);
        $subCat->idCate = $request->idCate;
        $subCat->Nombre = $request->Nombre;
        // $subCat->Status = '1';
       
        $imagenSub = Peticion::file('file');
               
        $extension = $imagenSub->guessExtension();
        $date = date('d-m-Y_h-i-s-ms-a');
        $prefijo = 'Image';
        $nombreImagen = $prefijo.'_'.$date.'.'.$extension;
        $imagenSub->move('img', $nombreImagen);
        
        $subCat->imagenSub = $nombreImagen;
        
                
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
