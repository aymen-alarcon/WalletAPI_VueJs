<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Models\User;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $wallets = Wallet::where("user_id", Auth::user()->id)->get();

        return response()->json([
            "success" => true,
            "message" => "Liste des wallets récupérée.",
            "wallets" => $wallets,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(WalletRequest $request, Wallet $wallet)
    {
            $validate = $request->validated();
            $validate["user_id"] = Auth::user()->id;
            $wallet->create($validate);
            
            return response()->json([
                "success" => true,
                "data" => ["wallet" => $wallet],
                "message" => "Created a wallet successfully",
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Wallet $wallet)
    {
        if (!$wallet) {
            return response()->json([
                "success" => false,
                "message" => "Wallet introuvable.",
            ], 404);
        }else if ($wallet->user->id !== Auth::user()->id) {
            return response()->json([
                "success" => false,
                "message" => "Vous n'êtes pas autorisé à accéder à ce wallet.",
            ], 403);
        } else {
            return response()->json([
                "success" => true,
                "message" => "Détail du wallet récupéré.",
                "wallet" => $wallet,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function withdraw(Request $request, Wallet $wallet)
    {
        $balance = $wallet->balance;
        $validate["balance"] = $balance - $request->balance;

        $wallet->update($validate);

        return response()->json(["balance" => $wallet->balance]);
    }
}