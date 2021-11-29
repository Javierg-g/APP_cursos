<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;


class VideosController extends Controller
{
    public function crear(Request $req)
    {

        $respuesta = ["Status" => 1, "msg"];

        $datos = $req->getContent();

        $datos = json_decode($datos);

        $video = new Video();

        $video->enlace = $datos->enlace;
        $video->titulo = $datos->titulo;
        $video->foto = $datos->foto;
        $video->visto = $datos->visto = 0;
        $video->curso_id = $datos->curso_id;


        //Escribir en BBDD
        try {
            $video->save();
            $respuesta['msg'] = "Video guardado con id" . $video->id;
        } catch (\Exception $e) {
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error" . $e->getMessage();
        }

        return response()->json($respuesta);
    }

        public function listar(){

        $respuesta = ["status" => 1, "msg" => ""];
        try{
            $videos = Video::all();
            $respuesta['datos'] = $videos;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }

}
