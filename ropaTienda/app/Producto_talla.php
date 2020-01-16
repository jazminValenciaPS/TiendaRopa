<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_talla extends Model
{
    protected $table = 'producto_talla';
       
    protected $fillable = [
        'idTalla',
        'idProduc'
    ];

    public function producto(){
        return $this->belongsTo('App\Producto');
    }
    public function talla()
    {
        return $this->belongsTo('App\Talla');
    }
}
