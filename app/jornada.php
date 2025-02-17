<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jornada extends Model
{
    protected $fillable = ['user_id', 'fecha','hora', 'fecha_real','hora_real','descripcion','observaciones','condicion'];
   
    protected $casts = [
        'fecha' => 'datetime',
        'fecha_real' => 'datetime'
        
        
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
