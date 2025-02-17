<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaUser extends Model
{
     //
     protected $fillable = ['user_id', 'codigoVisual','codigoTeclado','descripcion','observaciones','condicion'];
   

     public function user()
     {
         return $this->belongsTo('App\User');
     }
   
     
}
