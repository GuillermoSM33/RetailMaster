<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Venta</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        .details, .products { margin-bottom: 20px; }
        .products table { width: 100%; border-collapse: collapse; }
        .products table th, .products table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ticket de Venta</h1>
        </div>
        <div class="details">
            <p><strong>Fecha:</strong> {{ $venta->fecha_venta }}</p>
            <p><strong>Método de Pago:</strong> {{ $venta->metodo_pago }}</p>
            <p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
            <p><strong>Monto Recibido:</strong> ${{ number_format($venta->monto_recibido, 2) }}</p>
            <p><strong>Cambio:</strong> ${{ number_format($venta->cambio, 2) }}</p>
        </div>
        <div class="products">
            <h2>Detalle de Productos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->detalleVentas as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->descripcion }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->producto->precio_venta, 2) }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
