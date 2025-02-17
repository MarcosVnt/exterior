<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresupuestosFichero extends Model
{
    //
    protected $fillable = ['presupuesto_id', 'user_id','nombre','texto','slug'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

  

    public function presupuesto()
    {
        return $this->belongsTo('App\Presupuesto');
    }

   
}
