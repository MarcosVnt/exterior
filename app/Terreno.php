<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Terreno extends Model
{
    //
    public function vallas()
    {
        return $this->HasMany('App\Valla');
    }

    public function propietario(){
        return $this->belongsTo('App\Propietario');
    }

    public function contratos()
    {
        return $this->hasManyThrough(contrato::class, Valla::class);
    }

    public function sumaImporteContratos(){
        return $this->contratos->sum('alquiler_anual');

    }

    public static function MaxDNI()
    {
        $resultado = DB::table((new static)->getTable())
            ->select(DB::raw('MAX(CAST(dni AS UNSIGNED)) AS maximo_dni'))
            ->first();

        return $resultado ? $resultado->maximo_dni : null;
    }
    
}
