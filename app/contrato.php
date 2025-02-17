<?php

namespace App;

use Illuminate\Database\Eloquent\Model;





class contrato extends Model
{

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_final' => 'datetime'
    ];

    public function cliente(){
        return $this->belongsTo('App\cliente');
    }
    public function agencia(){
        return $this->belongsTo('App\Agencia');
    }
    public function valla(){
        return $this->belongsTo(Valla::class);
    }

     public function terreno(){
        return $this->hasOneThrough(
            Terreno::class,
            Valla::class
        );
    }
 
   

   

   /*  public function terreno()
    {
        $valla = $this->belongsTo('App\Valla');
        return $valla->terreno;
      /*   return $this->hasOneThrough(
            Terreno::class,
            Valla::class,
            'terreno_id',
            'id',
            'id' 

    );*/
    
}
