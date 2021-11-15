<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    use HasFactory;
    protected $table = 'ordenes';
    protected $fillable = [
        'fecha',
        'subtotal',
        'total',
        'id_mesa',
        'codigo',
        'id_usuario',
        'tipodeorden',
        'propina',
        'pagado',
    ];
}
