<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $fillable = [
        'cart',
        'nombre',
        'stock',
        'descripcion',
        'foto',
        'productotipo',
        'precio',
    ];
    public function scopeProductoTipo($query, $tipo) {
    	if ($tipo!='A') {
    		return $query->where('productotipo','=',"$tipo");
    	}else{
    		return $query;
        }
    }
    public function scopeCart($query, $cart) {
    	if ($cart) {
    		return $query->where('cart','LIKE',"%$cart%");
    	}
    }
}
