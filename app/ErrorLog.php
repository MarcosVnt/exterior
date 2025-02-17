<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    //
    protected $fillable = ['type', 'message', 'stack','user_id'];



    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
