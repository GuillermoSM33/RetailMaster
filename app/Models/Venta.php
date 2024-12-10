<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas'; // Nombre de la tabla
    protected $primaryKey = 'id_venta'; // Llave primaria

    public $timestamps = false; // Si no usas created_at/updated_at

    protected $fillable = [
        'total',
        'monto_recibido',
        'cambio',
        'metodo_pago',
        'fecha_venta',
    ];

    /**
     * Relación con DetalleVenta
     */
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta', 'id_venta');
    }
}
