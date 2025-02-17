<?php

namespace App;
use Laravel\Nova\Actions\Actionable;

use Illuminate\Database\Eloquent\Model;


class ObraMano extends Model
{

    use Actionable;
    
    protected $table = 'obra_mano';
    protected $fillable = ['obra_id', 'user_id','tipo_hora','de_fecha_hora','a_fecha_hora','texto','condicion','fin','tipo_trabajo'];
    
    protected $dates = [
        'de_fecha_hora',
        'a_fecha_hora'
    ];
    
    protected $casts = [
        'de_fecha_hora' => 'datetime',
        'a_fecha_hora' => 'datetime'
    ];
    //public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

  

    public function obra()
    {
        return $this->belongsTo('App\Obra');
    }
}

