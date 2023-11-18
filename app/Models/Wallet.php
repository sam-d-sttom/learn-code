<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'email', 'balance'];


     //relationship with Transaction histories
     public function transactionHistories(){
        return $this->hasMany(TransactionHistory::class, 'wallet_id');
    }

}
