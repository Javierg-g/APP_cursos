<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;


class CursosController extends Controller
{
    public function crear(Request $req)
    {

        $respuesta = ["Status" => 1, "msg"];

        $datos = $req->getContent();

        $datos = json_decode($datos);

        $curso = new Curso();

        $curso->descripcion = $datos->descripcion;
        $curso->titulo = $datos->titulo;
        $curso->foto_portada = $datos->foto_portada;

        //Escribir en BBDD
        try {
            $curso->save();
            $respuesta['msg'] = "Curso guardado con id" . $curso->id;
        } catch (\Exception $e) {
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error" . $e->getMessage();
        }

        return response()->json($respuesta);
    }

        public function listar(){

        $respuesta = ["status" => 1, "msg" => ""];
        try{
            $cursos = Curso::all();
            $respuesta['datos'] = $cursos;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }

    
}
