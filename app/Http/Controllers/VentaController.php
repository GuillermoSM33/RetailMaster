<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto; 
use Dompdf\Dompdf;
use Dompdf\Options;

class VentaController extends Controller
{
    public function verificarStock(Request $request)
    {
        try {
            // Validar los datos recibidos
            $validated = $request->validate([
                'producto_id' => 'required|exists:productos,id_producto',
                'cantidad' => 'required|integer|min:1',
            ]);

            // Obtener el producto por su ID
            $producto = Producto::findOrFail($validated['producto_id']);

            // Verificar el stock disponible
            if ($producto->stock < $validated['cantidad']) {
                return response()->json([
                    'success' => false,
                    'message' => "Stock insuficiente para el producto: {$producto->descripcion}. Disponible: {$producto->stock}",
                ], 400);
            }

            // Respuesta exitosa si hay suficiente stock
            return response()->json([
                'success' => true,
                'message' => "Producto agregado correctamente al carrito.",
            ]);
        } catch (\Exception $e) {
            // Manejar errores inesperados
            \Log::error('Error en verificarStock:', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Ha ocurrido un error en el servidor.',
            ], 500);
        }
    }
    
    public function guardarVenta(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
            'monto_recibido' => 'required|numeric|min:0',
            'metodo_pago' => 'required|in:Efectivo,Tarjeta',
        ]);
    
        // Calcular el total
        $total = collect($request->productos)->reduce(function ($carry, $producto) {
            $precio = Producto::find($producto['id'])->precio_venta;
            return $carry + ($precio * $producto['cantidad']);
        }, 0);
    
        // Crear la venta
        $venta = Venta::create([
            'total' => $total,
            'monto_recibido' => $request->monto_recibido,
            'cambio' => $request->monto_recibido - $total,
            'metodo_pago' => $request->metodo_pago,
        ]);
    
        // Guardar el detalle de la venta
        foreach ($request->productos as $producto) {
            DetalleVenta::create([
                'id_venta' => $venta->id_venta,
                'id_producto' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'subtotal' => Producto::find($producto['id'])->precio_venta * $producto['cantidad'],
            ]);
    
            // Reducir el stock del producto
            $prod = Producto::find($producto['id']);
            $prod->stock -= $producto['cantidad'];
            $prod->save();
        }
    
        // Generar el PDF del ticket
        $pdf = \PDF::loadView('pdf.venta', compact('venta'));
    
        // Retornar el PDF
        return $pdf->download("venta_{$venta->id_venta}.pdf");
    }
    
    
}
