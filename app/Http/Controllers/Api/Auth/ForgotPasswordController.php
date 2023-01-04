<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgot(Request $request)
    {
        $credentials =   $request->validate([
            'email' => 'required|email|exists:clients,email'
        ]);

        Password::sendResetLink($credentials);

        return response()->json(['message' => 'Reset password link sent on your email id.'], 200);
    }

    public function reset()
    {
        $credentials =    request()->validate([
            'email' => 'required|email|exists:clients,email',
            'password' => 'required|confirmed | max:20',
            'token' => 'required | string'
        ]);

        $email_password_status = Password::reset($credentials, function ($client, $password) {

            $client->password = Hash::make($password);
            $client->save();


            $client->tokens()->delete();
        });

        if ($email_password_status == Password::INVALID_TOKEN) {
            return response()->json(['message' => 'Erro ao resetar senha'], 400);
        }

        return response()->json(['message' => 'Senha resetada com sucesso'], 200);
    }
}
