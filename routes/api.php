<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::post("/Login", [AuthController::class, "Login"]);
Route::post("/Register", [AuthController::class, "Register"]);
Route::middleware("auth:sanctum")->group(function(){
    Route::get("/Logout", [AuthController::class, "logout"]);
    Route::get("/Profile", [UserController::class, "index"]);
    Route::get("/wallets", [WalletController::class, "index"]);
    Route::get("/wallets/{wallet}", [WalletController::class, "show"]);
    Route::post("/wallets/create", [WalletController::class, "store"]);
    Route::post("/wallets/{wallet}/deposit", [TransactionController::class, "deposit"]);
    Route::post("/wallets/{wallet}/withdraw", [TransactionController::class, "withdraw"]);
    Route::post("/wallets/{wallet}/transfer", [TransactionController::class, "transfer"]);
    Route::get("/wallets/{wallet}/transactions", [TransactionController::class, "index"]);
});