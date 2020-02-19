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
        return $this->belongsTo('App\Imagen', 'idImg','idImagen');
    }
    public function subCategorias()
    {
        return $this->belongsTo('App\subCategoria', 'idSubcat', 'idSubCategorias');
    }
    // public function producto_color()
    // {
    //     return $this->belongsToMany('App\Producto_color','');
    // }
    // public function producto_talla()
    // {
    //     return $this->belongsToMany('App\Producto_talla');
    // }
  

}
