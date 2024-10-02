<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

use App\Models\Espacio;

class espacioController extends Controller
{
    public function list(){
        $response =[];
        
        try{
            $espacios = Espacio::all(); 

            if($espacios->isEmpty()){
                $response['message'] = 'No hay espacios cargados en la base de datos';
            }else{
                $response['message'] = 'Listado de espacios';
            }

            $response['data'] = $espacios;    
            $response['status'] = 200;

        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error obteniendo el istado de espacios',
                'errors' => $e,
                'status' => 500
            ];
        }
        
        return response()->json($response, $response['status']);
    }

    public function get(int $id){
        $response =[];
        
        try{
            $instance = Espacio::findOrFail($id);

            $response = [
                'message' => $instance,
                'status' => 200
            ];

        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error obteniendo el espacio con el id: ' . $id,
                'errors' => $e,
                'status' => 500
            ];
        }

        return response()->json($response, $response['status']);
    }

    public function create(Request $request){
        $response =[];
        
        try{
            $validator = Validator::make($request->all(), [
                'nombre'=> 'required',
                'piso' => 'required'
            ]);

            if($validator->fails()){
                $response =[
                    'message' => 'Error, Datos invalidos',
                    'errors' => $validator->errors(),
                    'status' => 400 
                ];
            }else{
                $espacio = Espacio::create([
                    'nombre'=> $request->nombre,
                    'piso' => $request->piso
                ]);

                $response = [
                    'message' => 'Se creo correctamente un nuevo espacio',
                    'data' => $espacio,
                    'status' => 201
                ];
            }
        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error creando un nuevo espacio',
                'errors' => $e,
                'status' => 500
            ];
        }

        return response()->json($response, $response['status']); 
    }

    public function update(Request $request, int $id){
        $response =[];

        try{
            $espacio = Espacio::findOrfail($id);

            $validator = Validator::make($request->all(), [
                'nombre'=> 'required',
                'piso' => 'required'
            ]);

            if($validator->fails()){
                $response =[
                    'message' => 'Error, Datos invalidos',
                    'errors' => $validator->errors(),
                    'status' => 400 
                ];
            }else{
                $espacio->update($validator->validated());

                $response = [
                    'message' => 'se acualizo correctamente el espacio con el id: ' . $id,
                    'data' => $espacio,
                    'status' => 200
                ];
            }
        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error actualizando el espacio con el id: ' . $id,
                'errors' => $e,
                'status' => 500
            ];
        }

        return response()->json($response, $response['status']);
    }

    public function delete(int $id){
        $response =[];

        try{
            $instance = Espacio::findOrFail($id);

            /*if (!auth()->user()->can('delete', $instance)) {
                return response()->json(['message' => 'No tienes permisos para eliminar este usuario.'], 403);
            }*/
        
            $instance->delete();

            $response = [
                'message' => 'Espacio eliminado exitosamente',
                'status' => 200
            ];

        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error eliminando el espacio con el id: ' . $id,
                'errors' => $e,
                'status' => 500
            ];
        }

        return response()->json($response, $response['status']); 
    }
}
