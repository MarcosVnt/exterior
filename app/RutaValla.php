<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RutaValla extends Model
{
    protected $fillable = ['descripcion', 'email','fecha_inicio', 'fecha_final'
    ,'ruta','token','expires_at'
    ];
   
    protected $casts = [
        'fecha_incio' => 'date',
        'fecha_final' => 'date',
        
        
    ];
    public function vallaLineas()
    {
        return $this->hasMany('App\RutaVallaLinea');
    }
}
