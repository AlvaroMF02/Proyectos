<?php
$url = DIR_SERV . "/notasAlumno/" . $datos_usuario_log->cod_usu;
$datos["api_session"] = $_SESSION["api_session"];
$respuesta = consumir_servicios_REST($url, "GET", $datos);
$obj = json_decode($respuesta);

if (!$obj) {
    session_destroy();
    die(error_page("Examen4 DWESE Curso 23-24", "<h1>Notas de los alumnos</h1><p>Error consumiendo el servicio: " . $url . "</p>"));
}
if (isset($obj->error)) {
    session_destroy();
    die(error_page("Examen4 DWESE Curso 23-24", "<h1>Notas de los alumnos</h1><p>" . $obj->error . "</p>"));
}
if (isset($obj->no_auth)) {
    session_unset();
    $_SESSION["seguridad"] = "El tiempo de sesión de la API ha caducado";
    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .enLinea {
            display: inline;
        }

        .enlace {
            background: none;
            color: blue;
            border: none;
            text-decoration: underline;
            cursor: pointer;
        }

        table,
        tr,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
            width: 15rem;
        }

        th {
            background-color: lightgrey;
        }
    </style>
</head>

<body>
    <h1>Notas de los alumnos</h1>
    <?php
    echo "Bienvenido " . $datos_usuario_log->usuario . " - <form class='enLinea' method='post' action='index.php'><button name='btnSalir' class='enlace'>Salir</button></form>";

    echo "<h2>Notas del Alumno <strong>".$datos_usuario_log->nombre."</strong></h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Asignaturas</th><th>Nota</th>";
    foreach ($obj->notas as $tupla) {
        echo "<tr>";
        echo "<td>" . $tupla->denominacion . "</td>";
        echo "<td>" . $tupla->nota . "</td>";
        echo "</tr>";
    }
    echo "</tr>";
    echo "</table>";
    ?>

</body>

</html>