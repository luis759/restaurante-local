<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class niveldeusuario extends Model
{
    use HasFactory;
    protected $table = 'nivel_usuario';
    protected $fillable = [
        'name',
    ];
}
