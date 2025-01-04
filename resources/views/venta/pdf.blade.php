<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1, h2, p {
            margin: 5px 0;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            color: #2c3e50;
        }
        h2 {
            font-size: 18px;
            color: #34495e;
        }
        p {
            font-size: 14px;
            color: #7f8c8d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #ecf0f1;
        }
        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #95a5a6;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Venta</h1>
        <p><strong>Cliente:</strong> 
            {{ $venta->cliente ? $venta->cliente->representante : 'No se encontró cliente' }}
        </p>
        <p><strong>Fecha:</strong> {{ $venta->fecha_venta }}</p>
        <p><strong>Tipo de Venta:</strong> {{ ucfirst($venta->tipo_venta) }}</p>
        <p><strong>Método de Pago:</strong> {{ ucfirst($venta->metodo_pago) }}</p>

        <h2>Detalles de la Venta</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>IVA</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta->detalleventas as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->descripcion }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ number_format($detalle->precio_unitario, 2) }}</td>
                        <td>{{ number_format($detalle->subtotal, 2) }}</td>
                        <td>{{ number_format($detalle->iva, 2) }}</td>
                        <td>{{ number_format($detalle->subtotal + $detalle->iva, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Total de la venta: {{ number_format($venta->total, 2) }}</p>

        <div class="footer">
            <p>Gracias por su compra. ¡Esperamos poder atenderlo pronto!</p>
        </div>
    </div>

</body>
</html>
