<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria Servicios web</title>
</head>

<body>
    <h1>Ejer 04</h1>
    <?php
    // paso la direccion en la que esta la API sin /saludo
    define("DIR_SERV", "http://localhost/Proyectos/Unidad6/Actividades/ejer04/servicios_rest");

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

    $datos["nombre"]="prueba";
    $datos["nombre_corto"]="pruebaActu";
    $datos["descripcion"]="prueba";
    $datos["PVP"]=50;
    $datos["familia"]="MP3";

    // ERROR

    $url = DIR_SERV . "/producto/actualizar/".urlencode("LJPROP1102W");
    $respuesta = consumir_servicios_REST($url, "PUT", $datos);
    $obj = json_decode($respuesta);

    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }

    if(isset($obj->mensaje_error)){
        die("<p>Error en el servicio: " . $obj->mensaje_error . "</p>");
    }

    echo "<p>".$obj->mensaje."</p>";
    ?>

</body>

</html>