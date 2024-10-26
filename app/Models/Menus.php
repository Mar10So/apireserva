<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;
    protected $table = 'Menus';
    protected $fillable = ['menu_id','restaurante_id','categoria_id','nombre'];
}
