<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'Producto';
    protected $fillable = ['producto_id','restaurante_id','categoria_id','menu_id','nombre','precio','descripcion','imagen'];
}
