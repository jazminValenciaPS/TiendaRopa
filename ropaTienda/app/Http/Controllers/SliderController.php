<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

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
        $subCat->Status = '1';
        $slider->imagen = $request->imagen;
        
        $slider->save();
    }
    public function update(Request $request)
    {
        $slider = Slider::findOrFail($request->id);
        $subCat->Status = '1';
        $slider->imagen = $request->imagen;
        
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
