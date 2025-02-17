<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RutaVallaLinea extends Model
{
    protected $fillable = ['ruta_valla_id', 'valla_id','descripcion', 'notas','orden'
    ];
   
  
    public function rutaValla()
    {
        return $this->belongsTo('App\RutaValla');
    }

    public function valla()
    {
        return $this->belongsTo('App\Valla');
    }
}
