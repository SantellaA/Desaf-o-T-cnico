<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Exception;

use App\Models\User;
use App\Models\Role;
use App\Traits\ApiTrait;

class userController extends Controller
{
    use ApiTrait;

    public function list(){
        $response =[];
        
        try{
            $usuarios = User::all(); 

            $response = $this->formatearRespuesta('', 200, $usuarios);

            if($usuarios->isEmpty()){
                $response['message'] = 'No hay usuarios cargados en la base de datos';
            }else{
                $response['message'] = 'LIST de User';
            }

        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error obteniendo el istado de usuarios', 500, $e, true);
        }
        
        return response()->json($response, $response['status']);
    }

    public function get(int $id){
        $response =[];
        
        try{
            $instance = User::findOrFail($id);

            $response = $this->formatearRespuesta('GET de User con id: ' . $id, 200, $instance);    

        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error obteniendo el usuario con id: ' . $id, 500, $e, true);

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
                $response = $this->formatearRespuesta('Error, Datos invalidos', 400, $validator->errors(), true);

            }else{

                $role = Role::where('authority', $request->role)->first();

                $usuario = User::create([
                    'name' => $request->name,
                    'email'=> $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' => $role->id,
                ]);
                
                $response = $this->formatearRespuesta('CREATE de User', 201, $usuario);

            }
        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error creando un nuevo usuario', 500, $e, true);
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
                $response = $this->formatearRespuesta('Error, Datos invalidos', 400, $validator->errors(), true);

            }else{
                $usuario->update($validator->validated());

                $response = $this->formatearRespuesta('UPDATE de User con id: ' . $id, 200, $usuario);
               
            }
        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error actualizando el usuario con id: ' . $id, 500, $e, true);
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

            $response = $this->formatearRespuesta('DELETE del User con id: ' . $id, 200);

        }catch(Exception $e){
            $response = $this->formatearRespuesta('Error, Ocurrio un error eliminando el usuario con id: ' . $id, 500, $e, true);
        }

        return response()->json($response, $response['status']); 
    }
}
