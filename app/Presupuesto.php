<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\presupuestos;

class Presupuesto extends Model
{
    //
    protected $fillable = [

        'id','fecha_presupuesto','cliente_descripcion','contacto','descripcion_trabajo','estado','referencia','fecha_entrega','fecha_envio','direccion_envio','opcion_envio','tipo_envio','contacto_envio',
        'gastos','montaje','subcontratado','beneficios','importefinal','comentarios','costes',
        'nombre_fiscal','dni','direccion','codigo_postal','poblacion','provincia','telefono','movil','email','observaciones','ejercicio','documento',
        'forma_pago','codigo_obra'
       

    ];


    public function users()
    {
        return $this->belongsToMany('App\User');
    }
/*  public function fotos()
    {
        return $this->HasMany('App\ObraFoto');
    } */

    public function lineas()
    {
        return $this->HasMany('App\PresupuestoDetalle');
    }



    public function articulos()
    {
        return $this->HasMany('App\Articulo');
    }


    public function componentes()
    {
        return $this->HasMany('App\PresupuestoComponentes');
    }
}
