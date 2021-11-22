<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordenes_productos extends Model
{
    use HasFactory;
    protected $table = 'ordenes_productos';
    protected $fillable = [
        'id_orden',
        'tipoproducto',
        'id_productos',
        'cantidad',
        'total',
        'precio',
    ];
}
