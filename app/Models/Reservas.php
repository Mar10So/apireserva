<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;
    protected $table = 'Reservas';
    protected $fillable = ['reserva_id','usuario_id','restaurante_id','fecha_reserva','hora_reserva','numero_personas','estado'];
}
