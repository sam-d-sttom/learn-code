<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Services\WalletServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WalletController extends Controller
{

    //show wallet main page
    public function index()
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();

        if ($wallet == NULL) {
            $transactions = NULL;
        } else {
            $transactions = $wallet->transactionHistories;
        }

        return view('wallet.index', [
            'wallet' => $wallet,
            'transactions' => $transactions
        ]);
    }


    //Show top up page
    public function topUp()
    {
        $user = User::find(Auth::id());

        return view('wallet.topUp', [
            'user_email' => $user->email
        ]);
    }


    //top up webhook
    public function topUpWebhook(Request $request, WalletServices $walletServices)
    {


        //verify request is from paystack
        $content = $request->getContent();

        $content_reference = json_decode($content)->data->reference;

        if (!isset($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        define('PAYSTACK_SECRET_KEY', env("PAYSTACK_SECRET_KEY"));

        if ($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $content, PAYSTACK_SECRET_KEY)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        //Verifying transaction.
        $verified_transaction = Http::withHeaders([
            "Authorization" => "Bearer " . PAYSTACK_SECRET_KEY
        ])->get("https://api.paystack.co/transaction/verify/$content_reference")->json();

        if ($verified_transaction['status'] === true && isset($verified_transaction['data']) && !empty($verified_transaction['data'])) {
          
            if ($verified_transaction['data']['status'] == 'success') {

                $customer_email = $verified_transaction['customer']['email'];
                $amount = round($verified_transaction['data']['amount'] / 100, 2);
                $reference = $verified_transaction['data']['reference'];

                $walletServices->creditWallet($customer_email, $amount, $reference);

                return response()->json(['message' => 'Thanks'], 200);
            }else{
                return response()->json(['message' => 'Thanks'], 200);

            }
        }
    }

}
