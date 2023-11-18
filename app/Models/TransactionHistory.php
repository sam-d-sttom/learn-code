<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $fillable = ['wallet_id', 'type', 'reference', 'amount'];


    //relationship with wallet
    public function wallet(){
        return $this->belongsTo(Wallet::class, 'wallet_id')->latest('id')->filters(request(['search']))->paginate(10);
    }

}
