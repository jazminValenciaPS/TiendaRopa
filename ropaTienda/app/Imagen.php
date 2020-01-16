<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $fillable = [
        'Imagen',
        'Tipo'
    ];
    public function producto(){
        return $this->belongsTo('App\Producto');
    }
}
