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
            margin: 0 auto;
        }

        .centrado {
            text-align: center;
        }
    </style>
    <title>Admin</title>
</head>

<body>
    <h1>Vista Admin</h1>
    <?php
    echo "Bienvenido a la página: " . $datos_usuario_log->usuario . "<form action='index.php' method='post' class='fila'><button class='enlace' name='btnSalir'>Salir</button></form>";

    echo "<form action='index.php' method='post'>";
    echo "<p>";
    echo "<select name='profesores' id='profesores'>";
    foreach ($obj->profesores as $profe) {
        if ($profe->tipo != "admin") {
            if (isset($_POST["profesores"]) && $_POST["profesores"] == $profe->id_usuario) {
                echo "<option selected value='" . $profe->id_usuario . "'>" . $profe->nombre . "</option>";
                $nombreProfe = $profe->nombre;
            } else {
                echo "<option value='" . $profe->id_usuario . "'>" . $profe->nombre . "</option>";
            }
        }
    }
    echo "</select>";
    echo "<button name='btnHorario'>Ver horario</button>";
    echo "</p>";
    echo "</form>";

    if (isset($_POST['profesores'])) {
        echo "<h2 class='centrado'>Horario de " . $nombreProfe . "</h2>";
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
                        echo "<td>";
                        echo "<form action='index.php' method='post'><button class=enlace name='btnEditar'>Editar</button></form>";
                        echo "</td>";
                    } else {
                        echo "<td>";
                        echo $obj->horario[0]->nombre;
                        echo "<form action='index.php' method='post'><button class=enlace name='btnEditar'>Editar</button></form>";
                        echo "</td>";
                    }
                }
            }
            echo "</tr>";
        }

        echo "</table>";

    }

    if (isset($_POST["btnEditar"])) {
        echo "holaa";
    }



    ?>
</body>

</html>