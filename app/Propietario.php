<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    //
    protected $fillable = [
        'dni', 'nombre', 'direccion','poblacion','postal','provincia','telefono','email','factura','observaciones'
    ];

    public function terrenos()
    {
        return $this->HasMany('App\Terreno');
    }

    public function vallas()
    {
        return $this->hasManyThrough('App\Valla', 'App\Terreno');
    }
}
