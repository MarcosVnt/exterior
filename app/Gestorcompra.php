<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestorcompra extends Model
{
    //
    protected $fillable = ['referencia','descripcion','proveedor'
    ,'ancho','longitud','m2','precio','unidad','dto'
    ,'preciofinal','comentarios','costeunidad','fecha','compra','oferta'];
}
