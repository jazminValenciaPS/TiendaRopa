<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subCategoria;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; 


use File;
use Request as Peticion;


class SubCategoriaController extends Controller
{
   
    public function index(Request $request) {
        // if (!$request->ajax()) return redirect('/');

      //  return $subCat = subCategoria::all();
       
        return  $subCat = DB::table('sub_categorias')
        ->join('categorias','categorias.idCategorias', '=','sub_categorias.idCate')
        ->select('categorias.idCategorias','categorias.nombre','sub_categorias.*')
        ->get();

         
    }

  
    public function accesorios(Request $request){
        return $subCat = subCategoria::all()->where('idCate','==','2')->where('Status','==','1');
    }

    public function ropa(Request $request){
        return $subCat = subCategoria::all()->where('idCate','=','1')->where('Status','=','1');
    }
    public function cosmeticos(Request $request){
        return $subCat = subCategoria::all()->where('idCate','=','3')->where('Status','=','1');
    }
    public function store(Request $request)
    {

        $subCat = new subCategoria();
    
        $subCat->idCate = $request->idCate;
        $subCat->NombreSub = $request->NombreSub;
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
        $subCat->NombreSub = $request->NombreSub;
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
