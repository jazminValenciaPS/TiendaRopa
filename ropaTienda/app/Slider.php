<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'Slider';
    protected $fillable = [
        'imagen'
    ];

    public function imagen(){
        return $this->belongsTo('App\Imagen');
    }

}
