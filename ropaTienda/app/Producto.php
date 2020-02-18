<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $primaryKey = 'idProducto';
    protected $table = 'producto';

    protected $fillable = [
        'idImg',
        'idSubcat',
        // 'idTalla',
        'NombreProducto',
        'Descripcion',
        'Precio',
        'Existencia',
        'Status'
    ];

    public function imagenes()
    {
        return $this->belongsTo('App\Imagen');
    }
    public function subCategorias()
    {
        return $this->belongsTo('App\subCategoria');
    }
    public function producto_color()
    {
        return $this->hasMany('App\Producto_color');
    }
    public function producto_talla()
    {
        return $this->hasMany('App\Producto_talla');
    }
  

}
