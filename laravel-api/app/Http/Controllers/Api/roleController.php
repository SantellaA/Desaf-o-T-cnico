<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;

use App\Models\Role;
use App\Traits\ApiTrait;

class roleController extends Controller
{
    use ApiTrait;

    public function list(){
        $response =[];
        
        try{
            $roles = Role::all(); 

            $response =  $this->formatearRespuesta('', 200, $roles);

            if($roles->isEmpty()){
                $response['message'] = 'No hay roles cargados en la base de datos';
            }else{
                $response['message'] = 'Listado de roles';
            }

        }catch(Exception $e){
            $response =  $this->formatearRespuesta('Error, Ocurrio un error obteniendo el istado de roles', 500, $e, true);
        }
        
        return response()->json($response, $response['status']);
    }

    public function get(int $id){
        $response =[];
        
        try{
            $instance = Role::findOrFail($id);

            $response =  $this->formatearRespuesta('GET de Role con id: ' .$id, 200, $instance);

        }catch(Exception $e){;
            $response =  $this->formatearRespuesta('Error, Ocurrio un error obteniendo el role con el id: ' . $id, 500, $e, true);
        }

        return response()->json($response, $response['status']);
    }

}
