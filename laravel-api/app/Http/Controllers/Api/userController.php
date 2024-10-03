<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Exception;

use App\Models\User;
use App\Models\Role;

class userController extends Controller
{
    public function list(){
        $response =[];
        
        try{
            $usuarios = User::all(); 

            if($usuarios->isEmpty()){
                $response['message'] = 'No hay usuarios cargados en la base de datos';
            }else{
                $response['message'] = 'Listado de usuarios';
            }

            $response['data'] = $usuarios;    
            $response['status'] = 200;

        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error obteniendo el istado de usuarios',
                'errors' => $e,
                'status' => 500
            ];
        }
        
        return response()->json($response, $response['status']);
    }

    public function get(int $id){
        $response =[];
        
        try{
            $instance = User::findOrFail($id);

            $response = [
                'message' => $instance,
                'status' => 200
            ];

        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error obteniendo el usuario con el id: ' . $id,
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
                'name' => 'required',
                'email'=> 'required',
                'password' => 'required',
                'role' => 'required',
            ]);

            if($validator->fails()){
                $response =[
                    'message' => 'Error, Datos invalidos',
                    'errors' => $validator->errors(),
                    'status' => 400 
                ];
            }else{

                $role = Role::where('authority', $request->role)->first();

                $usuario = User::create([
                    'name' => $request->name,
                    'email'=> $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' => $role->id,
                ]);

                $response = [
                    'message' => 'Se creo correctamente un nuevo usuario',
                    'data' => $usuario,
                    'status' => 201
                ];
            }
        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error creando un nuevo usuario',
                'errors' => $e,
                'status' => 500
            ];
        }

        return response()->json($response, $response['status']); 
    }

    public function update(Request $request, int $id){
        $response =[];

        try{
            $usuario = User::findOrfail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email'=> 'required',
                'password' => 'required',
                'role' => 'required',
            ]);

            if($validator->fails()){
                $response =[
                    'message' => 'Error, Datos invalidos',
                    'errors' => $validator->errors(),
                    'status' => 400 
                ];
            }else{
                $usuario->update($validator->validated());

                $response = [
                    'message' => 'se acualizo correctamente el usuario con el id: ' . $id,
                    'data' => $usuario,
                    'status' => 200
                ];
            }
        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error actualizando el usuario con el id: ' . $id,
                'errors' => $e,
                'status' => 500
            ];
        }

        return response()->json($response, $response['status']);
    }

    public function delete(int $id){
        $response =[];

        try{
            $instance = User::findOrFail($id);

            /*if (!auth()->user()->can('delete', $instance)) {
                return response()->json(['message' => 'No tienes permisos para eliminar este usuario.'], 403);
            }*/
        
            $instance->delete();

            $response = [
                'message' => 'usuario eliminado exitosamente',
                'status' => 200
            ];

        }catch(Exception $e){
            $response = [
                'message' => 'Error, Ocurrio un error eliminando el usuario con el id: ' . $id,
                'errors' => $e,
                'status' => 500
            ];
        }

        return response()->json($response, $response['status']); 
    }
}
