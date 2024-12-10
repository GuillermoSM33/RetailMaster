<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver')->only('index');
        $this->middleware('permission:crear')->only(['create', 'store']);
        $this->middleware('permission:editar')->only(['edit', 'update']);
        $this->middleware('permission:eliminar')->only('destroy');
    }

    /**
     * Muestra una lista de detalles de ventas.
     */
    public function index()
    {
        $detalles = DetalleVenta::with('venta', 'producto')->paginate(10);
        return view('admin.detalleVentas', compact('detalles'));
    }
    public function show($id)
{
    $detalleVenta = DetalleVenta::with('venta', 'producto')->findOrFail($id);
    return response()->json($detalleVenta);
}

    /**
     * Genera un PDF con los detalles de ventas.
     */
    public function generatePDF()
    {
        // Obtén todos los detalles con sus relaciones
        $detalles = DetalleVenta::with('venta', 'producto')->get();

        // Genera el contenido HTML del reporte
        $html = '
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Reporte de Detalle de Ventas</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
                h1 {
                    text-align: center;
                    color: #333;
                }
            </style>
        </head>
        <body>
            <h1>Reporte de Detalle de Ventas</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Fecha de Venta</th>
                        <th>Método de Pago</th>
                    </tr>
                </thead>
                <tbody>';
        
        foreach ($detalles as $detalle) {
            $html .= '
                <tr>
                    <td>' . $detalle->venta->id_venta . '</td>
                    <td>' . $detalle->producto->descripcion . '</td>
                    <td>' . $detalle->cantidad . '</td>
                    <td>$' . number_format($detalle->precio_unitario, 2) . '</td>
                    <td>$' . number_format($detalle->cantidad * $detalle->precio_unitario, 2) . '</td>
                    <td>' . $detalle->venta->fecha_venta . '</td>
                    <td>' . $detalle->venta->metodo_pago . '</td>
                </tr>';
        }

        $html .= '
                </tbody>
            </table>
        </body>
        </html>';

        // Configura DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Define el tamaño y la orientación del papel
        $dompdf->setPaper('A4', 'portrait');

        // Renderiza y muestra el PDF
        $dompdf->render();
        return $dompdf->stream('detalle_ventas.pdf', ['Attachment' => false]);
        
    }
}

