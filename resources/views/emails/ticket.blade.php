<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #333;
            color: white;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
            text-align: right;
            color: #2d572c;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Ticket de Venta</h1>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalleventas as $venta)
                <tr>
                    <td>{{ $venta->producto->descripcion }}</td>
                    <td>{{ $venta->cantidad }}</td>
                    <td>${{ number_format($venta->precio_unitario, 2) }}</td>
                    <td>${{ number_format($venta->precio_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">
        Total General: ${{ number_format($detalleventas->sum('precio_total'), 2) }}
    </p>
</div>

</body>
</html>
