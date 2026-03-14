<?php

namespace App\Http\Controllers;

class ErrorControladoController extends Controller
{
    public function prueba()
    {
        try {
            $numero = 10;
            $resultado = $numero / 0; // ERROR provocado(breakpoint)

            return response()->json([
                "error" => false,
                "resultado" => $resultado
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                "error" => true,
                "message" => "Ocurrio un problema interno, intente mas tarde"
            ]);
        }
    }
}