<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SMinventario</title>
</head>
<body>
    <h2 style="text-align: center;">{{$persona->nombre}}</h2>
    <table style="margin: 40px auto; border-collapse: collapse; border: 1px solid black;">
        <thead style="background-color: #eee;">
            <tr>
                <th style="text-align: center; border: 1px solid black;">Nombre</th>
                <th style="text-align: center; border: 1px solid black;">Recibido</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materiales as $item)
            <tr>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->categoria->nombre }}</td>
                <td style="text-align: center; padding: 10px; border: 1px solid black;">{{ $item->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
