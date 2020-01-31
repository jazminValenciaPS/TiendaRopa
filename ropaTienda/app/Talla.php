<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $fillable = [
        'Talla'
    ];

    public function producto(){
        return $this->hasMany('App\Producto');
    }
}
