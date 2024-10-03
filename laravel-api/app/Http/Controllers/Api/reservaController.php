<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Exception;

use App\Models\Reserva;

use App\Traits\ApiTrait;

class reservaController extends Controller
{
    use ApiTrait;
    public function list(){
        $response =[];
        
        try{
            $reservas = Reserva::all(); 

            $response = $this->formatearRespuesta('', 200, $reservas);

            if($reservas->isEmpty()){
                $response['message'] = 'No hay reservas cargados en la base de datos';
            }else{
                $response['message'] = 'LIST de Reserva';
            }

        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error obteniendo la istado de reservas', 500, $e, true);
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

            $response = $this->formatearRespuesta('GET de Reserva con id:' . $id, 200, $instance);
            
        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error obteniendo la reserva con id: ' . $id, 500, $e, true);
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
            }else{

                $reserva = [];

                $horaInicioInt = intval($request->hora_inicio);
                $horaFinalInt = intval($request->hora_final);
                $response = $this->formatearRespuesta('Error, Datos invalidos', 400, $validator->errors(), true);

                for ($i = $horaInicioInt; $i <= $horaFinalInt; $i += 100) {
                    
                    $instanciaReserva = Reserva::create([
                        'nombre'=> $request->nombre,
                        'piso' => $request->piso
                    ]);

                    array_push($reserva, $instanciaReserva);
                }
                $response = $this->formatearRespuesta('CREATE de Reserva', 201, $reserva, true);

            }
        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error creando un nuevo reserva', 500, $e, true);
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
            $response = $this->formatearRespuesta('DELETE de Reserva', 200);

        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error eliminando la reserva con id: ' . $id, 500, $e, true);
        }

        return response()->json($response, $response['status']); 
    }
}
