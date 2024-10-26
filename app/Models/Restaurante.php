<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;
    protected $table = 'Restaurantes';
    protected $fillable =['restaurante_id','admin_id','nombre','direccion','ciudad','tipo_cocina','rango_cocina','rango_precios','calificacion_promedio','capacidad','horario_apertura','hoario_cierre','email','telefono','imagen'];
}
