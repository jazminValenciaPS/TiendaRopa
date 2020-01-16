<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subCategoria extends Model
{
    protected $fillable = [
        'idCate',
        'Nombre',
        'Status'
    ];
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
    public function producto(){
        return $this->belongsTo('App\Producto');
    }
}
