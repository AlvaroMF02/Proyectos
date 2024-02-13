<?php
// Se pone arriba por los errores al hacer el header ( se tiene que hacer fuera de html ) 
$datos["api_session"] = $_SESSION["api_session"];
$url = DIR_SERV . "/obtener_profesores";
$respuesta = consumir_servicios_REST($url, "POST", $datos);
$obj = json_decode($respuesta);

if (!$obj) {
    session_unset();
    $_SESSION["seguridad"] = "lo que sea: " . $obj->error;
    header("Location:index.php");
    exit;
}

if (isset($obj->error)) {
    session_unset();
    $_SESSION["seguridad"] = "lo que sea: " . $obj->error;
    header("Location:index.php");
    exit;
}
if (isset($obj->no_auth)) {
    session_unset();
    $_SESSION["seguridad"] = "lo que sea: " . $obj->no_auth;
    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .enlace {
            background: none;
            border: none;
            text-decoration: underline;
            color: blue;
            cursor: pointer;
        }

        .fila {
            display: inline;
        }

        table,
        tr,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
            width: 50rem;
        }

        th {
            background-color: lightskyblue;
        }

        table {
            margin: 2rem;
        }
    </style>
    <title>Admin</title>
</head>

<body>
    <h1>Vista Admin</h1>
    <?php
    echo "Bienvenido a la página: " . $datos_usuario_log->usuario . "<form action='index.php' method='post' class='fila'><button class='enlace' name='btnSalir'>Salir</button></form>";

    ?>
    <form action="index.php" method="post">
        <p>
            <select name="profesores" id="profesores">
                <?php
                foreach ($obj->profesores as $profe) {
                    echo "<option value='" . $profe->id_usuario . "'>" . $profe->nombre . "</option>";
                }
                ?>
            </select>
            <button>Buscar</button>
        </p>
    </form>
    <?php


    $horas = array("8:15 - 9:15", "9:15 - 10:15", "10:15 - 11:15", "11:15 - 11:45", "11:45 - 12:45", "12:45 - 13:45", "13:45 - 14:45");
    $dias = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes");

    echo "<table>";
    echo "<tr>";
    echo "<th></th>";
    for ($i = 0; $i < count($dias); $i++) {
        echo "<th>" . $dias[$i] . "</th>";
    }
    echo "</tr>";

    for ($i = 0; $i < count($horas); $i++) {
        echo "<tr>";
        echo "<th>" . $horas[$i] . "</th>";
        for ($j = 0; $j < count($dias); $j++) {

            if ($i == 3) {
                echo "<th>RECREO</th>";                 // poner el colspan
            } else {
                $datos["api_session"] = $_SESSION["api_session"];
                $datos["usuario"] = $_POST["profesores"];
                $datos["dia"] = $j + 1;
                $datos["hora"] = $i + 1;
                $url = DIR_SERV . "/obtener_horario";
                $respuesta = consumir_servicios_REST($url, "POST", $datos);
                $obj = json_decode($respuesta);

                if (!$obj || isset($obj->error)) {    // por si hay error
                    echo "<td>Error Servicio</td>";
                } else if (isset($obj->mensaje)) {
                    echo "<td></td>";
                } else {
                    echo "<td>" . $obj->horario[0]->nombre . "</td>";
                }
            }
        }
        echo "</tr>";
    }

    echo "</table>";
    ?>
</body>

</html>