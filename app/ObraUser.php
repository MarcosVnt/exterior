<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObraUser extends Model
{
    //
    protected $table = 'obra_user';

    protected $fillable = ['obra_id', 'user_id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

  

    public function obra()
    {
        return $this->belongsTo('App\Obra');
    }




}
