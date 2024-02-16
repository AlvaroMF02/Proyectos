<?php
session_name("ApiCrud");
session_start();

// Conexion con la API
define("DIR_SERV", "http://localhost/Proyectos/Unidad6/Actividades/Activ2/servicios_rest/");

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

// ------------------------ BORRAR PRODUCTO ------------------------
if (isset($_POST["btnBorrar"])) {
    require "vistas/vistaBorrar.php";
}

// ------------------------ EDITAR PRODUCTO ------------------------
if (isset($_POST["btnContiEdit"])) {


    $error_nombre_corto = $_POST["nombre_corto"] == "";

    // mira que nombre_corto no sea repe
    if (!$error_nombre_corto) {

        $urlEdit = DIR_SERV . "/repetido/producto/nombre_corto/" . urlencode($_POST["nombre_corto"]) . "/cod/" . $_POST["btnContiEdit"];
        $respEdit = consumir_servicios_REST($urlEdit, "GET");
        $objEdit = json_decode($respEdit);

        if (!$objEdit) echo "Error API: " . $respEdit;
        if (isset($objEdit->mensaje_error)) echo "Error consulta: " . $objEdit->mensaje_error;

        // true si esta repe
        if ($objEdit->repetido) {
            $error_nombre_corto = true;
        }
    }
    $errorPvp = $_POST["pvp"] == "" || !is_numeric($_POST["pvp"]) || $_POST["pvp"] <= 0;

    $errorForm = $error_nombre_corto || $errorPvp;

    if (!$errorForm) {

        $datos["nombre"] = $_POST["nombre"];
        $datos["nombre_corto"] = $_POST["nombre_corto"];
        $datos["descripcion"] = $_POST["descripcion"];
        $datos["PVP"] = $_POST["pvp"];
        $datos["familia"] = $_POST["familia"];

        $urlEditar = DIR_SERV . "/producto/actualizar/" . urlencode($_POST["btnContiEdit"]);
        $respueEditar = consumir_servicios_REST($urlEditar, "PUT", $datos);
        $$objEditar = json_decode($respueEditar);

        if (!$$objEditar) echo "Error API: " . $respueEditar;
        if (isset($objEditar->mensaje_error)) echo "Error consulta: " . $objEditar->mensaje_error;

        $_SESSION["mensaje"] = $objEditar->mensaje;
        header("Location:index.php");
        exit;
    }
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
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta . "</body></html>");
    }
    if (isset($obj->mensaje_error)) {
        die("<p>" . $obj->mensaje_error . "</p></body></html>");
    }


    // ------------------------ MOSTRAR DETALLES DEL PRODUCTO ------------------------
    if (isset($_POST["btnMostrar"])) {
        require "vistas/vistaDetalles.php";
    }
    // ------------------------ AÑADIR UN PRODUCTO ------------------------
    if (isset($_POST["btnNuevo"]) || isset($_POST["btnContiNuevo"])) {
        require "vistas/vistaInsertar.php";
    }

    // ------------------------ EDITAR UN PRODUCTO ------------------------
    if (isset($_POST["btnEditar"]) || isset($_POST["btnContiEdit"])) {

        require "vistas/vistaEditar.php";
    }


    // Mensaje 
    if (isset($_SESSION["mensaje"])) {
        echo $_SESSION["mensaje"];
        unset($_SESSION["mensaje"]);
    }



    // Mostrar los datos que hemos recogido
    echo "<h1>Listado de los productos </h1>";

    echo "<table>";
    echo "<tr><th>COD</th><th>Nombre</th><th>PVP</th><th><form action='index.php' method='post'><button name='btnNuevo' class='enlace'>Producto+</button></form></th></tr>";
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