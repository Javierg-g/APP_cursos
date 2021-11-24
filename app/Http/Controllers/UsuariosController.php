<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuariosController extends Controller
{
    public function crear(Request $req)
    {

        $respuesta = ["Status" => 1, "msg"];

        $datos = $req->getContent();

        $datos = json_decode($datos);

        //Validar datos
        $usuario = new Usuario();

        $usuario->nombre = $datos->nombre;
        $usuario->foto = $datos->foto;
        $usuario->email = $datos->email;
        $usuario->contraseña = $datos->contraseña;
        $usuario->activado = $datos->activado = 1;

        //Escribir en BBDD
        try {
            $usuario->save();

            $respuesta['msg'] = "Usuario guardado con id" . $usuario->id;
        } catch (\Exception $e) {
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error" . $e->getMessage();
        }

        return response()->json($respuesta);
    }

    public function desactivar($id)
    {
        $respuesta = ["Status" => 1, "msg" => ""];
        $usuario = Usuario::find($id);

        if ($usuario && $usuario->activado == 1) {

            try {
                $usuario->activado = 0;
                $respuesta['msg'] = "Usuario desactivado";
            } catch (\Exception $e) {
                $respuesta['status'] = 0;
                $respuesta['msg'] = "Se ha producido un error" . $e->getMessage();
            }

        }else if(!$usuario->activado == 1){
            $respuesta["msg"] = "El usuario ya estaba desactivado";
            $respuesta["status"] = 0;
        } else {
            $respuesta["msg"] = "Usuario no econtrada";
            $respuesta["status"] = 0;
        }

        return response()->json($respuesta);
    }

    public function editar(Request $req, $id)
    {

        $respuesta = ["Status" => 1, "msg"];

        $datos = $req->getContent();

        $datos = json_decode($datos); 

        $usuario = Usuario::find($id);

        if ($usuario) {
            if (isset($datos->nombre)) {
                $usuario->nombre = $datos->nombre;
            }
            if (isset($datos->foto)) {
                $usuario->foto = $datos->foto;
            }
            if (isset($datos->contraseña)) {
                $usuario->contraseña = $datos->contraseña;
            }
        
            //Escribir en BBDD
            try {
                $usuario->save();

                $respuesta['msg'] = "Persona guardada con id" . $usuario->id;
            } catch (\Exception $e) {
                $respuesta['status'] = 0;
                $respuesta['msg'] = "Se ha producido un error" . $e->getMessage();
            }
        }

        return response()->json($respuesta);
    }
    /*public function listar(){

        $respuesta = ["status" => 1, "msg" => ""];
        try{
            $usuarios = Usuario::all();
            $respuesta['datos'] = $usuarios;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }*/

    /*public function ver($id){
        $respuesta = ["status" => 1, "msg" => ""];


        //Buscar a la persona
        try{
            $usuario = Usuario::find($id);
            $usuario->makeVisible(['direccion','created_at','updated_at']);
            $respuesta['datos'] = $usuario;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }*/
    
}
