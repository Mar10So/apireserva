<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificaciones extends Model
{
    use HasFactory;
    protected $table = 'Calificaiones';
    protected $fillable = ['calificacion_id','id','usuario_id','restaurante_id','calificacion','fecha_calificacion'];
}
