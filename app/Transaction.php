<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';


    public function siswa()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    protected $dates = ['created_at'];

}
