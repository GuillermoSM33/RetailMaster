<?php 
namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function buscar(Request $request)
    {
        $query = $request->input('q');

        // Busca productos que coincidan con la descripción o nombre
        $productos = Producto::where('descripcion', 'LIKE', "%{$query}%")
            ->orWhere('id_producto', 'LIKE', "%{$query}%")
            ->get(['descripcion','id_producto','precio_venta']);

        return response()->json($productos);
    }
}
?>