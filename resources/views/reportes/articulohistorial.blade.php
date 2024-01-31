<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SMinventario</title>
</head>
<body>
    @if ($historial->isEmpty())
        <tr>
            <td colspan="7" class="text-center py-4">No hay registros</td>
        </tr>
    @else
    <h2 style="text-align: center;"></h2>
    <table style="margin: 40px auto; border-collapse: collapse; border: 1px solid black;">
        <thead style="background-color: #eee;">
            <tr>
                <th style="text-align: center; border: 1px solid black;">ID</th>
                <th style="text-align: center; border: 1px solid black;">Equipo/Material</th>
                <th style="text-align: center; border: 1px solid black;">Origen</th>
                <th style="text-align: center; border: 1px solid black;">Destino</th>
                <th style="text-align: center; border: 1px solid black;">Fecha</th>
                <th style="text-align: center; border: 1px solid black;">observacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historial as $item)
            <tr>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->id_articulo }}</td>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->nombre_articulo }}</td>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->usuario_origen }}</td>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->usuario_destino }}</td>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->updated_at }}</td>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->observacion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</body>
</html>
