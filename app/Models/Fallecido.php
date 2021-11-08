<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fallecido extends Model
{
    use HasFactory;

    protected $table = "fallecidos";

    protected $fillable = [
        'nombre','apellidos','fecha_nacimiento','fecha_fallecimiento','descripcion','user_id','clave'
    ];    
}
