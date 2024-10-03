<?php

namespace App\Traits;

use function Laravel\Prompts\error;

trait ApiTrait
{
    public function formatearRespuesta(string $message, int $status, $data = null, bool $error = false){
        $respuestaFormateada = [];

        if($error){
            $respuestaFormateada = [
                'message' => $message,
                'errors' => $data,
                'status' => $status,
            ];
        }else{
            $respuestaFormateada = [
                'message' => $message,
                'data' => $data,
                'status' => $status,
            ];
        }

        return $respuestaFormateada;
    }
}
