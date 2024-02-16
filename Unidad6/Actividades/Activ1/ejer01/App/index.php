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
    define("DIR_SERV", "http://localhost/Proyectos/Unidad6/Actividades/ejer01/servicios_rest");

    // Funcion para hacer la conexion
    function consumir_servicios_REST($url, $metodo, $datos = null){
        $llamada = curl_init();
        curl_setopt($llamada, CURLOPT_URL, $url);
        curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
        if (isset($datos))
            curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
        $respuesta = curl_exec($llamada);
        curl_close($llamada);
        return $respuesta;
    }

    $url = DIR_SERV . "/saludo";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);

    // Comprobacion de que se ha mandado un json
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }

    // Si no entra al if es que todo esta bien
    echo "<p>El saludo recibido ha sido <strong>" . $obj->mensaje . "</strong></p>";


    ?>

</body>

</html>