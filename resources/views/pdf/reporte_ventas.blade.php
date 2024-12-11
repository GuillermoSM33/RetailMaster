<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .container { width: 100%; margin: 0 auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reporte de Ventas</h1>
            <p>Fecha: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Método de Pago</th>
                    <th>Total</th>
                    <th>Productos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->created_at->format('d-m-Y') }}</td>
                        <td>{{ $venta->metodo_pago }}</td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                        <td>
                            <ul>
                                @foreach ($venta->detalleVentas as $detalle)
                                    <li>{{ $detalle->producto->descripcion }} ({{ $detalle->cantidad }})</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>