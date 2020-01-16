<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colores extends Model
{
    protected $table = 'Colores';
    // protected $primaryKey = 'flight_id';
    protected $fillable = ['nombre'];
    
    public function producto(){
        return $this->belongsTo('App\Producto');
    }
}
