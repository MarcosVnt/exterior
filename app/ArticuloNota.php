<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticuloNota extends Model
{
    //
    protected $fillable = [
        'id', 'codigo', 'codigo_proveedor','nota'
        
    ];
}
