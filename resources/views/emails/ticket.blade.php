<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Venta</title>
    <style>
        /* Integrar Tailwind CSS para el correo electrónico */
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Ticket de Venta</h1>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden mb-4">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Producto</th>
                    <th class="px-4 py-2 text-left">Cantidad</th>
                    <th class="px-4 py-2 text-left">Precio</th>
                    <th class="px-4 py-2 text-left">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalleventas as $venta)
                    <tr>
                        <td class="px-4 py-2">{{ $venta->producto }}</td>
                        <td class="px-4 py-2">{{ $venta->cantidad }}</td>
                        <td class="px-4 py-2">${{ number_format($venta->precio, 2) }}</td>
                        <td class="px-4 py-2">${{ number_format($venta->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="font-semibold text-lg">
            <span class="mr-2">Total General:</span>
            <span class="text-green-600">${{ number_format($detalleventas->sum('total'), 2) }}</span>
        </p>
    </div>

</body>
</html>
