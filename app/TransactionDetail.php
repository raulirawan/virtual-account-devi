<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_detail';

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class,'pembayaran_id','id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaction::class,'id','transaction_id');
    }


}
