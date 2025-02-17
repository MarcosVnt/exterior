<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresupuestosDetalle extends Model
{
    //
    protected $table = "presupuestos_detalle";


     //
     protected $fillable = [

        'id','idpresupuesto','articulo','contacto','descripcion','proveedor','ancho',
        'longitud','m2','linea','bultos','cantidad','precio','descuento',
        'preciofinal','gastos','montaje','subcontratado','beneficios','importefinal',
        'comentarios','costes','tipounidad','mermas','base'

        
       

    ];


    public function presupuesto()
    {
        return $this->belongsTo('App\Presupuesto');
    }

    public function componentes()
    {
        return $this->hasMany('App\PresupuestoComponentes');
    }
}
