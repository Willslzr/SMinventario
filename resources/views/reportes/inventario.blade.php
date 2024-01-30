<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SMinventario</title>
</head>
<body>
    <h2 class="mt-5" style="text-align: center;">Materiales en inventario</h2>
    <table style="margin: 40px auto; border-collapse: collapse; border: 1px solid black;">
        <thead style="background-color: #eee;">
            <tr>
                <th style="text-align: center; border: 1px solid black;">Nombre</th>
                <th style="text-align: center; border: 1px solid black;">Cantidad en inventario</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articulos as $item)
            <tr>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->nombre_categoria }}</td>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->cantidad }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
