<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

use App\Models\Espacio;
use App\Traits\ApiTrait;

class espacioController extends Controller
{
    use ApiTrait;

    public function list(){
        $response = [];
        
        try{
            $espacios = Espacio::all(); 

            $response = $this->formatearRespuesta('', 200, $espacios);

            if($espacios->isEmpty()){
                $response['message'] = 'No hay espacios cargados en la base de datos';
            }else{
                $response['message'] = 'LIST de Espacio';
            }


        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error obteniendo el istado de espacios', 500, $e, true);
        }
        
        return response()->json($response, $response['status']);
    }

    public function get(int $id){
        $response =[];
        
        try{
            $instance = Espacio::findOrFail($id);

            $response = $this->formatearRespuesta('GET de Espacio con id: ' .$id, 200, $instance);

        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error obteniendo el espacio con id: ' . $id, 500, $e, true);
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
                $response = $this->formatearRespuesta('Error, Datos invalidos', 400, $validator->errors(), true);
                
            }else{
                $espacio = Espacio::create([
                    'nombre'=> $request->nombre,
                    'piso' => $request->piso
                ]);

                $response = $this->formatearRespuesta('CREATE de Espacio', 201, $espacio);
            }
        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error creando un nuevo espacio', 500, $e, true);
        }

        return response()->json($response, $response['status']); 
    }

    public function update(Request $request, int $id){
        $response =[];

        try{
            $validator = Validator::make($request->all(), [
                'nombre'=> 'required',
                'piso' => 'required'
            ]);

            if($validator->fails()){
                $response = $this->formatearRespuesta('Error, Datos invalidos', 400, $validator->errors(), true);
                
            }else{
                $espacio = Espacio::findOrfail($id);

                $espacio->update($validator->validated());

                $response = $this->formatearRespuesta('UPDATE del espacio con id: '. $id, 200, $espacio);

            }
        }catch(Exception $e){
            $response =  $this->formatearRespuesta('Error, Ocurrio un error actualizando el espacio con id: ' . $id, 500, $e, true);
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

            $response = $this->formatearRespuesta('DELETE de Espacio', 200);

        }catch(Exception $e){
            $response =  $this->formatearRespuesta('Error, Ocurrio un error eliminando el espacio con id: ' . $id, 500, $e, true);
        }

        return response()->json($response, $response['status']); 
    }
}
