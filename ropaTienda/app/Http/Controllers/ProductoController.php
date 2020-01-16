<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return $productos;
    }

    public function store(Request $request)
    {
        // $subCat = new subCategoria();
        // $subCat->Nombre = $request->Nombre;
        // $subCat->Status = '1';
        // $subCat->save();
    }
    public function update(Request $request)
    {
        // $subCat = subCategoria::findOrFail($request->id);
        // $subCat->Nombre = $request->Nombre;
        // $subCat->Status = '1';
        // $subCat->save();   
    }

    public function desactivar(Request $request)
    {
        // $subCat = subCategoria::findOrFail($request->id);
        // $subCat->Status = '0';
        // $subCat->save(); 
    }
    
    public function activar(Request $request)
    {
        // $subCat = subCategoria::findOrFail($request->id);
        // $subCat->Status = '1';
        // $subCat->save();
    }
}
