<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subCategoria extends Model
{
    protected $table = 'sub_categorias';
    protected $primaryKey = 'idSubCategorias';

    protected $fillable = [
        'idCate',
        'NombreSub',
        'Status'
    ];
    
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
    public function producto(){
        return $this->hasMany('App\Producto');
    }
}
