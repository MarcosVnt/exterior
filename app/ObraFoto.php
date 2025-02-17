<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;



class ObraFoto extends Model  
{
    
    protected $fillable = ['obra_id', 'user_id','imagen','texto','slug'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

  

    public function obra()
    {
        return $this->belongsTo('App\Obra');
    }

   

   }