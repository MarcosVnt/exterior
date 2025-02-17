<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class horario extends Model
{
    //
    protected $fillable = ['user_id', 'hora_inicio','hora_fin','descripcion','observaciones','condicion'];
    protected $casts = [
        'hora_inicio' => 'time',
        'hora_fin' => 'time'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
