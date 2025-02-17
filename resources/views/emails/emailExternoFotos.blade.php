<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Rotuleon Fotos Agente Externo</title>
</head>
<body>
    <p>Bienvenido {{ $datos->email }}.</p>
    <p>Pulsando en boton "NUEVO PROYECTO" podrá subir las fotos de :</p>
    <ul>
        <li>Coódigo: {{ $datos->obraC }}</li>
        <li>Descripción: {{ $datos->obraD}}</li>
<!--         <li>url: {{ $datos->url}}</li>
 -->        
    </ul>
    <ul>
       
        <li>
            <a href="{{$datos->url}}">
                NUEVO PROYECTO
            </a>
        </li>
    </ul>
    <p>Gracias por su colaboración</p>
    <p>Grupo Rotuleon</p>

</body>
</html>