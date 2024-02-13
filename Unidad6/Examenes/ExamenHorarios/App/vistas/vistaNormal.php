<?php
// Se pone arriba por los errores al hacer el header ( se tiene que hacer fuera de html ) 

// $datos["usuario"] = $datos_usuario_log->id_usuario;
// $url = DIR_SERV . "/horario_usuario";
// $respuesta = consumir_servicios_REST($url, "POST", $datos);
// $obj = json_decode($respuesta);

// if (!$obj) {
//     session_unset();
//     $_SESSION["seguridad"] = "lo que sea: " . $obj->error;
//     header("Location:index.php");
//     exit;
// }

// if (isset($obj->error)) {
//     session_unset();
//     $_SESSION["seguridad"] = "lo que sea: " . $obj->error;
//     header("Location:index.php");
//     exit;
// }

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
        .centrado{
            text-align: center;
        }
    </style>
    <title>Normal</title>
</head>

<body>
    <h1>Vista normal</h1>
    <?php
    echo "Bienvenido a la página: " . $datos_usuario_log->usuario . "<form action='index.php' method='post' class='fila'><button class='enlace' name='btnSalir'>Salir</button></form>";

    echo "<h2 class='centrado'>Su horario</h2>";
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
                $datos["usuario"] = $datos_usuario_log->id_usuario;
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