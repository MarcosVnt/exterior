<?php

namespace App;

use App\Nova\Contrato;
use Illuminate\Database\Eloquent\Model;

class Valla extends Model
{
    //
    public function terreno(){
        return $this->belongsTo(Terreno::class);
    }

    public function contratos(){
        return $this->HasMany('App\Contrato');
    }
}
