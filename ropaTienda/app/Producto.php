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
        'NombreProducto',
        'Descripcion',
        'Precio',
        'Existencia',
        'Status'
    ];

    public function imagenes()
    {
        return $this->belongsTo('App\Imagen', 'idImg','idImagen');
    }
    public function subCategorias()
    {
        return $this->belongsTo('App\subCategoria', 'idSubcat', 'idSubCategorias');
    }
    // public function colors()
    // {
    //     return $this->hasManyThrough(
    //                                 'App\Colores', 
    //                                 'App\Producto_color'
    //                             );
    // }
    // public function tallas()
    // {
    //     return $this->hasManyThrough('App\Talla', 'App\Producto_talla');
    // }
  

}
