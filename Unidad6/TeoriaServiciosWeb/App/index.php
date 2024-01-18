<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria Servicios web</title>
</head>

<body>
    <h1>Teoria servicios web</h1>
    <?php
    // paso la direccion en la que esta la API sin /saludo
    define("DIR_SERV", "http://localhost/Proyectos/Unidad6/TeoriaServiciosWeb/primeraAPI");

    // le concateno /saludo a la url
    $url = DIR_SERV . "/saludo";
    // Esto hace la llamada remota solo con get
    $respuesta = file_get_contents($url);

    // como nos devuelve un JSON (por le JSON_ENCODE) ahora hay que quitar el formato
    $obj = json_decode($respuesta);

    // Comprobacion de que se ha mandado un json
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }

    // Si no entra al if es que todo esta bien
    echo "<p>El saludo recibido ha sido <strong>" . $obj->mensaje . "</strong></p>"

    ?>

</body>

</html>