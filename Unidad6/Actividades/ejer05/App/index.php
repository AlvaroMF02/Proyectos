<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria Servicios web</title>
</head>

<body>
    <h1>Ejer 05</h1>
    <?php
    // paso la direccion en la que esta la API sin /saludo
    define("DIR_SERV", "http://localhost/Proyectos/Unidad6/Actividades/ejer05/servicios_rest");

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

    $url = DIR_SERV . "/producto/borrar/".urlencode("AJFNSBDS98");
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $obj = json_decode($respuesta);

    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }

    // puedes recibir mensaje_error o mensaje
    if(isset($obj->mensaje_error)){
        die("<p>Error en el servicio: " . $obj->mensaje_error . "</p>");
    }

    echo "<p>".$obj->mensaje."</p>";
    ?>

</body>

</html>