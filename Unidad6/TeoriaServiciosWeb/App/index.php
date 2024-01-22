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



    // ************************************* GET *************************************
    $url = DIR_SERV . "/saludo";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);

    // Comprobacion de que se ha mandado un json
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }

    // Si no entra al if es que todo esta bien
    echo "<p>El saludo recibido ha sido <strong>" . $obj->mensaje . "</strong></p>";



    // ------------- USAR LA API PASANDOLE UN PARAMETRO -------------

    // se le pasa el param en la url despues del nombre de la funcion
    // $url = DIR_SERV . "/saludo/Mariajo";
    $url = DIR_SERV . "/saludo/" . urlencode("mari pe");    // pasar un parametro con espacios
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);

    // Comprobacion de que se ha mandado un json
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }

    // Si no entra al if es que todo esta bien
    echo "<p>El saludo recibido ha sido <strong>" . $obj->mensaje . "</strong></p>";





    // ************************************* POST *************************************

    $url = DIR_SERV . "/saludo";
    $datos["nombre"] = "Pedro Jose";    // se tiene que llamar "nombre" como se indica en la API
    $respuesta = consumir_servicios_REST($url, "POST", $datos);
    $obj = json_decode($respuesta);

    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }

    echo "<p>El saludo recibido ha sido <strong>" . $obj->mensaje . "</strong></p>";





    // ************************************* DELETE *************************************

    $url = DIR_SERV . "/borrarSaludo/37";
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $obj = json_decode($respuesta);

    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }

    echo "<p>El mennsaje recibido ha sido: <strong>" . $obj->mensaje . "</strong></p>";





    // ************************************* PUT ************************************* (2)

    $url = DIR_SERV . "/actualizarSaludo/98";
    $datos["nombre"] = "Álvaro Flores";
    $respuesta = consumir_servicios_REST($url, "PUT", $datos);
    $obj = json_decode($respuesta);

    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }

    echo "<p>El mennsaje recibido ha sido: <strong>" . $obj->mensaje . "</strong></p>";



    ?>

</body>

</html>