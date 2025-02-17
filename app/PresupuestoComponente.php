<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresupuestoComponente extends Model
{
    protected $fillable = [

        'id','idpresupuesto','idpresupuestolinea','articulo_principal','articulo','descripcion','proveedor','ancho',
        'longitud','tipounidad','m2','linea','bultos','cantidad','precio','descuento',
        'preciofinal','gastos','montaje','subcontratado','beneficios','importefinal',
        'comentarios','costes','mermas'

        
       

    ];


    public function presupuesto()
    {
        return $this->belongsTo('App\Presupuesto');
    }

    public function linea()
    {
        return $this->belongsTo('App\PresupuestosDetalle');
    }


}
