<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SMinventario</title>
</head>
<body>
    <h2 style="text-align: center;">Articulos recibidos</h2>
    <table style="margin: 40px auto; border-collapse: collapse; border: 1px solid black;">
        <thead style="background-color: #eee;">
            <tr>
                <th style="text-align: center; border: 1px solid black;">ID</th>
                <th style="text-align: center; border: 1px solid black;">Nombre</th>
                <th style="text-align: center; border: 1px solid black;">N° Serial</th>
                <th style="text-align: center; border: 1px solid black;">Recibido</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articulos as $item)
            <tr>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->nombre_categoria }}</td>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->cantidad }}</td>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->numero_de_serie ?? 'N/A' }}</td>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
