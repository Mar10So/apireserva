<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;
    protected $table = 'Restaurantes';
    protected $primaryKey = 'restaurante_id'; // Definir la clave primaria
    protected $fillable =['restaurante_id','id','admin_id','nombre','direccion','ciudad','tipo_cocina','rango_cocina','rango_precios','capacidad','horario_apertura','horario_cierre','email','telefono','imagen'];
    public $timestamps = true;
}
