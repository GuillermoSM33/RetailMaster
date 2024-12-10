<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'id_producto';

    // Especifica los campos que son asignables en masa
    protected $fillable = [
        'id_producto',
        'descripcion',
        'precio_costo',
        'precio_venta',
        'stock'      
    ];

    public $incrementing = true;

    protected $keyType = 'int';
}
