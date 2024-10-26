<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administracion_Restaurante extends Model
{
    use HasFactory;
    protected $table = 'Administracion_Restaurante';
    protected $fillable = ['admin_id','nombre_admin','email','pasword','rol'];
}
