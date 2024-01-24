<?php

// Conexion con la API
define("DIR_SERV", "http://localhost/Proyectos/Unidad6/Actividades/Activ2/servicios_rest/");

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


if (isset($_POST["btnMostrar"])) {
    // Mostrar los datos que se han pasado por le value del boton
    $urlDetall = DIR_SERV . "/producto/{".$_POST["btnMostrar"]."}";
    $respuDetall = consumir_servicios_REST($urlDetall,"GET");
    $objDetall = json_decode($respuDetall);

    // ver si hay errores
    if(!$objDetall){
        echo "Error consumiendo el servicio: ".$respuDetall;
    }
    if(isset($objDetall->mensaje_error)){
        echo "Error en la consulta: " .$objDetall->mensaje_error ;
    }

    echo "<h3>Detalles del producto: <strong>".$_POST['btnMostrar']."</strong></h3>";
    // echo $objDetall->producto[0];
    // for ($i = 0; $i < count($objDetall->producto); $i++) {
    //     echo $obj->producto[$i];
    // }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación web de prueba de servicios</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            text-align: center
        }

        th {
            background-color: #CCC
        }

        table img {
            width: 50px;
        }

        .enlace {
            border: none;
            background: none;
            cursor: pointer;
            color: blue;
            text-decoration: underline
        }

        .error {
            color: red
        }
    </style>
</head>

<body>
    <?php

    // Recoger todos los productos de la bd con la API
    $url = DIR_SERV . "/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);

    // Si hay errores ...
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }
    if (isset($obj->mensaje_error)) {
        die("<p>" . $obj->mensaje_error . "</p></body></html>");
    }

    // Mostrar los datos que hemos recogido
    echo "<h1>Listado de los productos </h1>";

    echo "<table>";
    echo "<tr><th>COD</th><th>Nombre</th><th>PVP</th><th><form action='index.php'><button class='enlace'>Producto+</button></form></th></tr>";
    for ($i = 0; $i < count($obj->productos); $i++) {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnMostrar' value='" . $obj->productos[$i]->cod . "'>" . $obj->productos[$i]->cod . "</button></form></td>";
        echo "<td>" . $obj->productos[$i]->nombre_corto . "</td>";
        echo "<td>" . $obj->productos[$i]->PVP . "</td>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnBorrar' value='" . $obj->productos[$i]->cod . "'>Borrar</button>-<button class='enlace' value='" . $obj->productos[$i]->cod . "' name='btnEditar'>Editar</button></form></td>";
        echo "</tr>";
    }

    echo "</table>";

    ?>
</body>

</html>