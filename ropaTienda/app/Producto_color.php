<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_color extends Model
{
    protected $table = 'producto_color';
    protected $primaryKey = 'idProColor';
    
    
    protected $fillable = [
        'idColor',
        'idProduc'
    ];

    public function color()
    {
        return $this->belongsToMany('App\Color');
    }
    public function producto(){
        return $this->belongsToMany('App\Producto');
    }
   
}
