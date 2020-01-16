<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    
    public function index()
    {
        $categorias = Categoria::all();
        return $categorias;
    }

    public function store(Request $request){

    }
    public function update(Request $request)
    {
        //
    }

    public function Desactivar(Request $request)
    {
        //
    }
    
    public function activar(Request $request)
    {
        //
    }
}
