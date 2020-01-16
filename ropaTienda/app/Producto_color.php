<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_color extends Model
{
    protected $table = 'producto_color';
    
    protected $fillable = [
        'idColor',
        'idProduc'
    ];

    public function producto(){
        return $this->belongsTo('App\Producto');
    }
    public function color()
    {
        return $this->belongsTo('App\Color');
    }
}
