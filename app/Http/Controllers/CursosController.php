<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Curso;
use App\Models\Video;


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

    public function listar(Request $search)
    {
        $respuesta = ["status" => 1, "msg" => ""];

        if($search ->has('search')){
            try {
                $cursos = Curso::select(['titulo', 'foto_portada'])
                    ->withCount('videos as numero_videos')
                    ->where('titulo', 'like','%'.$search -> input('search').'%')
                    ->get();
              
            } catch (\Exception $e) {
                $respuesta['status'] = 0;
                $respuesta['msg'] = "Se ha producido un error: " . $e->getMessage();
            }

        }else{
            $cursos = Curso::select(['titulo', 'foto_portada'])
            ->withCount('videos as numero_videos')
            ->get();

        }
        $respuesta['Cursos'] = $cursos;

       
        return response()->json($respuesta);
    }
}
