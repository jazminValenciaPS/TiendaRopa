<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; 

use File;
use Request as Peticion ;




class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        return $slider;
    }

    public function store(Request $request)
    {
        $slider = new Slider();
        $imagen = Peticion::file('file');
        
        $extension = $imagen->guessExtension();
        $date = date('d-m-Y_h-i-s-ms-a');
        $prefijo = 'Image';
        $nombreImagen = $prefijo.'_'.$date.'.'.$extension;
        $imagen->move('img', $nombreImagen);
        $slider->Imagen = $nombreImagen;
        $slider->save();


            
    }
    
    
    public function update(Request $request)
     {
        $slider = Slider::findOrFail($request->id);

        $imagen = Peticion::file('file');
        $extension = $imagen -> guessExtension();
        $date = date('d-m-Y_h-i-s-ms-a');
        $prefijo = 'Image';
        $nombreImagen = $prefijo.'_'.$date.'.'.$extension;
        $imagen->move('img', $nombreImagen);
        File::delete('img/' . $slider->Imagen);
        $slider->imagen = $nombreImagen;
        
        $slider->save(); 
        
        
    }

    public function desactivar(Request $request)
    {
        $slider = slider::findOrFail($request->id);
        $slider->Status = "0";
        $slider->save(); 
    }
    
    public function activar(Request $request)
    {
        $slider = slider::findOrFail($request->id);
        $slider->Status = "1";
        $slider->save();
    }
}
