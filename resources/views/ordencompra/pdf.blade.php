<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Compra - {{ $ordenCompra->clave_orden }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 75%;
            margin: 20px auto;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1, h2, p {
            margin: 5px 0;
            text-align: center;
        }
        h1 {
            font-size: 26px;
            color: #2c3e50;
        }
        h2 {
            font-size: 20px;
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
            padding: 8px;
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
        <h1>Orden de Compra: {{ $ordenCompra->clave_orden }}</h1>
        <p><strong>Proveedor:</strong> 
            {{ $ordenCompra->proveedore ? $ordenCompra->proveedore->nombre : 'No se encontró proveedor' }}
        </p>
        <p><strong>Fecha:</strong> {{ $ordenCompra->fecha }}</p>
        <p><strong>Estado:</strong> 
            {{ ucfirst($ordenCompra->estado) }}
        </p>

        <h2>Detalles de la Orden</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ordenCompra->detalleordencompras as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->descripcion }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ number_format($detalle->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Total de la orden: {{ number_format($ordenCompra->detalleordencompras->sum('total'), 2) }}</p>

        <div class="footer">
            <p>Gracias por confiar en nosotros. ¡Esperamos poder atenderlo pronto!</p>
        </div>
    </div>

</body>
</html>
