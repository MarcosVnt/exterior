<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tarifaproducto extends Model
{

    protected $fillable = [

    'id','articulo', 'componente', 'tipo', 'descripcion','proveedor','ancho',
        'longitud','tipounidad','m2','cantidad','precio','descuento',
        'preciofinal','gastos','montaje','subcontratado','beneficios','importefinal',
        'comentarios','costes', 'mermas','base','referencia','documento','linea','bultos'
    ];




}
