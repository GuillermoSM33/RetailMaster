<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Asegúrate de que esta línea esté presente

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
}
