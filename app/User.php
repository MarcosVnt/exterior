<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','rol_id','avatar','condicion','visual_id','teclado_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol(){
        return $this->belongsTo('App\Rol');
    }
    public function obras(){
        return $this->HasMany('App\ObraUser');
    }
    public function horas(){
        return $this->HasMany('App\ObraMano');
    }
    public function fotos(){
        return $this->HasMany('App\ObraFoto');
    }
    public function horarios(){
        return $this->HasMany('App\Horario');
    }
    public function jornadas(){
        return $this->HasMany('App\jornada');
    }

    public function presupuestosfichero()
    {
      return $this->hasMany('App\Presupuestosfichero');
    }
}
