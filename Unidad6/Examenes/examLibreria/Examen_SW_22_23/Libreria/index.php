<?php

define("URLTOCHA", "http://localhost/Proyectos/Unidad6/Examenes/examLibreria/Examen_SW_22_23/servicios_rest");

function consumir_servicios_REST($url, $metodo, $datos = null)
{
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

function error_page($title, $cabecera, $mensaje)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body><h1>' . $cabecera . '</h1>' . $mensaje . '</body></html>';
    return $html;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreria</title>
</head>

<body>
    <h1>Librería</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Nombre de usuario</label>
            <input type="text" id="usuario" name="usuario">
        </p>
        <p>
            <label for="clave">Contraseña</label>
            <input type="text" id="clave" name="clave">
        </p>

        <button>Entrar</button>
    </form>

    <h2>Listado de los Libros</h2>

    <?php

    $url = URLTOCHA . "/obtenerLibros";
    $respuesta = consumir_servicios_REST($url,"GET");
    $obj = json_decode($respuesta);

    if(!$obj) die("Error en la API:" .$respuesta . "</body></html>");
    if(isset($obj->error)) die ("Error en la consulta:" . $obj->error. "</body></html>");
    
    echo $obj->libros->descripcion;

    ?>

</body>
</html>