<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $primaryKey = 'idImagen';

    protected $fillable = [
        'Imagen',
        'Tipo'
    ];
    public function producto(){
        return $this->hasMany('App\Producto');
    }
}
