<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colores;

class ColorController extends Controller
{
    public function index()
    {
        $colores = Colores::all();
        return $colores;
    }

    public function store(Request $request)
    {
        $colores = new Colores();
        $colores->Nombre = $request->Nombre;
        
        $colores->save();
    }
    public function update(Request $request)
    {
        $colores = Colores::findOrFail($request->id);
        $colores->Nombre = $request->Nombre;
        
        $colores->save();   
    }

    // public function desactivar(Request $request)
    // {
    //     $colores = Colores::findOrFail($request->id);
        
    //     $colores->save(); 
    // }
    
    // public function activar(Request $request)
    // {
    //     $colores = Colores::findOrFail($request->id);
        
    //     $colores->save();
    // }
}
