<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthClientController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
            'token_firebase' => 'required',
            'plataforma' => 'required | string | max:191'
        ]);

        $client = Client::where('email', $request->email)->first();

        if($request->plataforma == "Email"){
            if ($client && $client->plataforma != $request->plataforma) {
                return response()->json([
                    'message' => 'Você se cadastrou pelo '.$client->plataforma.', faça o login por ela.',
                    'plataforma' => $client->plataforma
                ], 403);
            }
        }
              

        if (!$client || !Hash::check($request->password, $client->password)) {
            return response()->json([
                'message' => 'Credenciais Inválidas'
            ], 404);
        }

        //ATUALIZAÇÃO TOKEN FIREBASE - PLATAFORMA
        $client->token_firebase = $request->token_firebase;
        $client->token_data = now();
        $client->plataforma = $request->plataforma;
        $client->save();
        //

        $token = $client->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }

    public function me(Request $request)
    {

        $client = $request->user();



        /*  return auth('sanctum')->check(); */

        return new ClientResource($client);
    }
}
