<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Exception;

use App\Models\Reserva;


class reservaController extends Controller
{
    public function list(){
        $response =[];
        
        try{
            $reservas = Reserva::all(); 

            if($reservas->isEmpty()){
                $response['message'] = 'No hay reservas cargados en la base de datos';
            }else{
                $response['message'] = 'Listado de reservas';
            }

            $response['data'] = $reservas;    
            $response['status'] = 200;

        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error obteniendo la istado de reservas',
                'errors' => $e,
                'status' => 500
            ];
        }
        
        return response()->json($response, $response['status']);
    }

    public function get(int $id){
        $response =[];
        
        try{
            $instance = Reserva::findOrFail($id);

            $response = [
                'message' => $instance,
                'status' => 200
            ];

        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error obteniendo la reserva con el id: ' . $id,
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
                'fecha'=> 'required',
                'user_id'=> 'required',
                'espacio_id'=> 'required',
                'hora_inicio'=> 'required',
                'hora_final' => 'required',
            ]);

            if($validator->fails()){
                $response =[
                    'message' => 'Error, Datos invalidos',
                    'errors' => $validator->errors(),
                    'status' => 400 
                ];
            }else{

                $reserva = [];

                $horaInicioInt = intval($request->hora_inicio);
                $horaFinalInt = intval($request->hora_final);

                for ($i = $horaInicioInt; $i <= $horaFinalInt; $i += 100) {
                    
                    $instanciaReserva = Reserva::create([
                        'nombre'=> $request->nombre,
                        'piso' => $request->piso
                    ]);

                    array_push($reserva, $instanciaReserva);
                }

                $response = [
                    'message' => 'Se creo correctamente una nueva reserva',
                    'data' => $reserva,
                    'status' => 201
                ];
            }
        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error creando un nuevo reserva',
                'errors' => $e,
                'status' => 500
            ];
        }

        return response()->json($response, $response['status']); 
    }

    public function update(Request $request, int $id){
        $response =[];

        try{
            $reserva = Reserva::findOrfail($id);

            $validator = Validator::make($request->all(), [
                'fecha'=> 'required',
                'user_id'=> 'required',
                'espacio_id'=> 'required',
                'hora_inicio'=> 'required',
                'hora_final' => 'required',
            ]);

            if($validator->fails()){
                $response =[
                    'message' => 'Error, Datos invalidos',
                    'errors' => $validator->errors(),
                    'status' => 400 
                ];
            }else{
                $reserva->update($validator->validated());

                $response = [
                    'message' => 'se acualizo correctamente la reserva con el id: ' . $id,
                    'data' => $reserva,
                    'status' => 200
                ];
            }
        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error actualizando la reserva con el id: ' . $id,
                'errors' => $e,
                'status' => 500
            ];
        }

        return response()->json($response, $response['status']);
    }

    public function delete(int $id){
        $response =[];

        try{
            $instance = Reserva::findOrFail($id);

            /*if (!auth()->user()->can('delete', $instance)) {
                return response()->json(['message' => 'No tienes permisos para eliminar este reserva.'], 403);
            }*/
        
            $instance->delete();

            $response = [
                'message' => 'reserva eliminada exitosamente',
                'status' => 200
            ];

        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error eliminando la reserva con el id: ' . $id,
                'errors' => $e,
                'status' => 500
            ];
        }

        return response()->json($response, $response['status']); 
    }
}
