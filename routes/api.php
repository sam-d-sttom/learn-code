<?php

use App\Http\Controllers\WalletController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Models\Role;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ability', function(){
    $user = User::find(1);
    $role = Role::find($user->role_id);
    return Role::all();
});

//top up wallet webhook
Route::post('/wallet/top-up', [WalletController::class, 'topUpWebhook']);

