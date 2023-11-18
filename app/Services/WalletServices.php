<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Support\Str;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\Auth;

class WalletServices 
{

    /**
     * credits user's wallet.
     */
    public function creditWallet(string $email, float $amount, string $reference)
    {
        if($this->getTransactionByReference($reference) !== null) return;
        
        $wallet = Wallet::where('email', $email)->first();

        if($wallet === null){
            $new_wallet = Wallet::create([
                'user_id' => Auth::id(),
                'email' => $email,
                'balance' => 0
            ]);

            $wallet_id = $new_wallet->id;
            $new_wallet_balance = $amount;

        }else{

            $wallet_id = $wallet->pluck('id')[0];
            $wallet_balance = $wallet->pluck('balance');
    
            $new_wallet_balance = $wallet_balance[0] + $amount;
        }


        Wallet::where('email', $email)->update(['balance' => $new_wallet_balance]);

        TransactionHistory::create([
            'wallet_id' => $wallet_id,
            'type' => 'credit',
            'reference' => $reference,
            'amount' => $amount
        ]);
    }


    /**
     * Debits user's wallet.
     */
    public function debitWallet(string $email, float $amount){
        $reference = 'KIDSCODE-' . time() . $email;

        $wallet = Wallet::where('email', $email)->first();

        if($wallet === null){
            return "failed";
        }

        $wallet_id = $wallet->pluck('id');
        $wallet_balance = $wallet->pluck('balance');

        if($amount > $wallet_balance[0]) return "failed";

        $new_wallet_balance = $wallet_balance[0] - $amount;

        Wallet::where('email', $email)->update(['balance' => $new_wallet_balance]);

        TransactionHistory::create([
            'wallet_id' => $wallet_id[0],
            'type' => 'debit',
            'reference' => $reference,
            'amount' => $amount
        ]);

        return "successful";

    }


    /**
     * Gets a transaction by its reference from the database.
     */
    public function getTransactionByReference(string $reference)
    {
        $transaction = TransactionHistory::where('reference', $reference)->first();
        return $transaction;
    }
}