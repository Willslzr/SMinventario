<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrega de Artículo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        p {
            text-align: justify;
        }
        hr {
            width: 50%;
            margin: 0 auto;
        }
        .firma {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h1>Entrega de Artículo</h1>
    <p>El artículo <strong>{{ $historial->first()->nombre_articulo }}</strong>, con el código <strong>{{ $historial->first()->id }}</strong>, con la observación <strong>{{ $historial->first()->observacion }}</strong>, fue entregado a <strong>{{ $historial->first()->usuario_destino }}</strong>, por <strong>{{ $usuario }}</strong> en la fecha <strong>{{ $historial->first()->updated_at }}</strong>.</p>
    <hr>
    <div class="firma">
        <p>Firma del receptor:</p>
        <br>
        <br>
        <p>Fecha:</p>
    </div>
</body>
</html>
