<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;
    protected $table = 'Usuarios';
    protected $fillable =['usuario_id','nombre','email','pasword','telefono','fecha_registro'];
}
