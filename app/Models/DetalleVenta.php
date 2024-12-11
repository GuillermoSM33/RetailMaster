<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas'; // Nombre de la tabla
    protected $primaryKey = 'id_detalle_venta'; // Llave primaria

    public $timestamps = false; // Si no usas created_at/updated_at

    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'subtotal',
    ];

    /**
     * Relación con Producto
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
