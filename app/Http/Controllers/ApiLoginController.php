<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $usuario = $request->usuario;
        $password = $request->password;

        if ($usuario === 'admin' && $password === '1234') {
            session(['autenticado' => true]);

            return response()->json([
                "success" => true,
                "message" => "Login correcto"
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Credenciales incorrectas"
            ], 401);
        }
    }

    public function perfil()
    {
        if (!session('autenticado')) {
            return response()->json([
                "error" => true,
                "message" => "No autorizado"
            ], 401);
        }

        return response()->json([
            "error" => false,
            "message" => "Bienvenido a tu perfil"
        ]);
    }
}