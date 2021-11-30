<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $hidden = ['descripcion','created_at','updated_at'];

    public function videos(){
        return $this ->hasMany(Video::class, 'curso_id');
    }
    public function usuarios(){
        return $this ->belongsToMany(Usuario::class, 'cursos_matriculados');
    }
}
