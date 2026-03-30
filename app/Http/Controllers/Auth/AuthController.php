<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        if (Auth::attempt($validate)) {
            $user = User::where("email", $request->email)->firstOrFail();
            $token = $user->createToken("UserToken")->plainTextToken;
                    
            return response()->json([
                "success" => true,
                "message" => "Connexion réussie.",
                "data" => ["user" => $user, "token" => $token],
            ]);
        }   else{
            return response()->json([
                "success" => false,
                "message" => "Identifiants incorrects."
            ]);
        }
    }

    public function logout(){

        $user= Auth::user();

        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'Non authentifié.',
            ], 401);
        }

        $user->currentAccessToken()->delete();

        return response()->json([
            'success'=> true,
            'message'=> 'Déconnexion réussie.' 
        ]);
    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required|confirmed|min:8",
        ]);

        $validate["password"] = Hash::make($validate["password"]);

        if (User::where("email", $validate["email"])->exists()) {
            return response()->json([
                "success" => false,
                "message" => "Erreur de validation.",
                "errors" => [
                    "email" => ["L'adresse email est déjà utilisée."],
                    "password" => ["Le mot de passe doit contenir au moins 8 caractères."]
                ]
            ], 201);
        } else {
            $user = User::create($validate);
            $token = $user->createToken("UserToken")->plainTextToken;
            
            return response()->json([
                "success" => true,
                "message" => "Inscription réussie.",
                "data" => ["user" => $user, "token" => $token],
            ], 201);
        }
        
    }
}
