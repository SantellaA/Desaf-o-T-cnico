<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class roleController extends Controller
{
    public function list(){
        $response =[];
        
        try{
            $roles = Role::all(); 

            if($roles->isEmpty()){
                $response['message'] = 'No hay roles cargados en la base de datos';
            }else{
                $response['message'] = 'Listado de roles';
            }

            $response['data'] = $roles;    
            $response['status'] = 200;

        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error obteniendo el istado de roles',
                'errors' => $e,
                'status' => 500
            ];
        }
        
        return response()->json($response, $response['status']);
    }

    public function get(int $id){
        $response =[];
        
        try{
            $instance = Role::findOrFail($id);

            $response = [
                'message' => $instance,
                'status' => 200
            ];

        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error obteniendo el role con el id: ' . $id,
                'errors' => $e,
                'status' => 500
            ];
        }

        return response()->json($response, $response['status']);
    }

}
