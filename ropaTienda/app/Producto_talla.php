<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_talla extends Model
{
    protected $table = 'producto_talla';
    protected $primaryKey = 'idProTalla';
       
    protected $fillable = [
        'idTalla',
        'idProduc'
    ];

    public function producto(){
        return $this->belongsToMany('App\Producto','idProTalla','idProducto');
    }
    public function talla()
    {
        return $this->belongsToMany('App\Talla','idProTalla','idTalla');
    }
}
