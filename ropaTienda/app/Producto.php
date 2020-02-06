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
        'idColor',
        'idTalla',
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
    public function colores()
    {
        return $this->belongsTo('App\Color');
    }
    public function tallas()
    {
        return $this->hasMany('App\Talla');
    }

}
