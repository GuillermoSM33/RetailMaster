<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Nombre de la tabla
    protected $primaryKey = 'id_producto'; // Llave primaria

    public $timestamps = false; // Si no usas created_at/updated_at

    protected $fillable = [
        'descripcion',
        'precio_costo',
        'precio_venta',
        'stock',
    ];

    /**
     * Relación con DetalleVenta
     */
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'id_producto', 'id_producto');
    }
}
