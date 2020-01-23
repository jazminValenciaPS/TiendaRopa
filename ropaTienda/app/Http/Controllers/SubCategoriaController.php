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

        return $subCat = subCategoria::all();

        // $subCat = subCategoria::join('categorias','sub_categorias.idCate', '=' ,'categorias.idCategorias')
        //     ->select('sub_categorias.idSubCategorias', 'sub_categorias.idCate', 'sub_categorias.Nombre', 'categorias.nombre as NombreCategorias','sub_categorias.Status')
        //     ->where('sub_categorias.Status = 1')
        //     ->orderBy('sub_categorias.idSubCategorias', 'desc');

        // return ['subCat' => $subCat];
         
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
        $subCat = subCategoria::findOrFail($request->idSubCategorias);
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

    public function desactivar(Request $request)
    {
        $subCat = subCategoria::findOrFail($request->i);
        $subCat->Status = '0';
        $subCat->save(); 
    }
    
    public function activar(Request $request)
    {
        $subCat = subCategoria::findOrFail($request->idSubCategorias);
        $subCat->Status = '1';
        $subCat->save();
    }
}
