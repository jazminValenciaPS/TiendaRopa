<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    // protected $primaryKey = 'flight_id';
    protected $fillable = ['Nombre'];

    public function subCategorias()
    {
        return $this->hasMany('App\subCategoria');
    }
}
