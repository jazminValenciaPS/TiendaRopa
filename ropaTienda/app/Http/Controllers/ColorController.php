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
        $validateData = $request->validate([
           'NombreColor' => 'unique:colores,NombreColor'
         ] );

        $colores = new Colores();
        $colores->NombreColor = $request->Nombre;
        
        $colores->save();
    }
    public function update(Request $request)
    {
        $colores = Colores::findOrFail($request->id);
        $colores->Nombre = $request->Nombre;
        
        $colores->save();   
    }

    
    public function desactivar(Request $request)
    {
        $colores = Colores::findOrFail($request->id);
        $colores->Status = '0';
        $colores->save(); 
    }
    
    public function activar(Request $request)
    {
        $colores = Colores::findOrFail($request->id);
        $colores->Status = '1';
        $colores->save();
    }
}
