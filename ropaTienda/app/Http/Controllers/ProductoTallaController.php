<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Producto_talla;

class ProductoTallaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/administrador');

        $id = $request->id;

        return  $productos = DB::table('producto_talla')
        ->join('producto','producto.idProducto', '=','producto_talla.idProduc')
        ->join('tallas','tallas.idTalla', '=','producto_talla.idTalla')
        ->select('producto.idProducto','producto_talla.idTalla','tallas.Talla')
        ->where([
            ['producto.idProducto','=',$id],
            ['producto.Status','=',1]   
        ])
        ->get();
    }


    public function selectTalla(Request $request)
    {
        if (!$request->ajax()) return redirect('/administrador');


        return  $productos = DB::table('producto_talla')
        ->join('producto','producto.idProducto', '=','producto_talla.idProduc')
        ->join('tallas','tallas.idTalla', '=','producto_talla.idTalla')
        ->select('producto.idProducto','producto_talla.idTalla','tallas.Talla')
        ->where('producto.Status','=',1)
        ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
