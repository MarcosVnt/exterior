<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\obra_usuarios;

class Obra extends Model
{
   //
   protected $fillable = [
    'id', 'codigo', 'nombre','descripcion','movil','email', 'responsable', 'cliente','fecha_alta','slug','condicion'
];

public function users()
    {
        return $this->belongsToMany('App\User');
    }
 public function fotos()
    {
        return $this->HasMany('App\ObraFoto');
    }

    public function horas()
    {
        return $this->HasMany('App\ObraMano');
    }

    
}
