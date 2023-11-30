<?php

function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body>' . $body . '</body></html>';
    return $html;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 PHP</title>
    <style>
        h3 {
            text-align: center;
        }

        th {
            background-color: grey;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        td {
            text-align: center;
        }

        table button {
            color: blue;
        }

        .centro {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Examen2 PHP</h1>
    <h2>Horario de los Profesores</h2>
    <?php

    // conexion con la bd
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_horarios_exam");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Sin conexion", ""));
    }

    // consulta para sacar los nombres de los profesores
    try {
        $consulta = "select * from usuarios";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Sin conexion", ""));
    }

    echo "<form action='index.php' method='post'>";

    echo "Horarios del Profesor: ";
    echo "<select name='usuarios'>";
    while ($usuarios = mysqli_fetch_assoc($resultado)) {
        if (isset($_POST["BtnVerHorario"]) && $_POST["usuarios"] == $usuarios['id_usuario']) {
            echo "<option selected value='" . $usuarios['id_usuario'] . "'>" . $usuarios["nombre"] . "</option>";
            $nombre = $usuarios["nombre"];
        } else {
            echo "<option value='" . $usuarios['id_usuario'] . "'>" . $usuarios["nombre"] . "</option>";
        }
    }
    // id del usuario elegido
    $idUsuario = $_POST["usuarios"];

    echo "</select>";

    echo "<button type='submit' name='BtnVerHorario'>Ver Horario</button>";
    echo "</form>";

    $nombreProf = $nombre;
    if (isset($_POST["BtnVerHorario"]) || isset($_POST["btnEditar"])) {



        // consulta para los horarios
        try {
            $consulta = "select * from horario_lectivo";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            echo "No se ha podido realizar la consulta";
        }



        echo "<h3>Horario del Profesor: " . $nombreProf . "</h3>";

        // -------------- Tabla --------------
        echo "<table>";
        echo "<tr> <th></th> <th>Lunes</th> <th>Martes</th> <th>Miercoles</th> <th>Jueves</th> <th>Viernes</th></tr>";

        echo "<tr> <td>8:15 - 9:15</td>";
        for ($i = 1; $i < 6; $i++) {
            echo "<td>";
            while ($horario = mysqli_fetch_assoc($resultado)) {
                if ($horario["usuario"] == $idUsuario && $horario["dia"] == $i && $horario["hora"] == 1) {
                    echo $horario["grupo"];
                }
            }
            echo "<form action='index.php' method='post'><button type='submit' name='btnEditar'>Editar</button></form>";
            echo "</td>";
        }
        echo "</tr>";

        echo "<tr><td>9:15 - 10:15</td>";
        for ($i = 1; $i < 6; $i++) {
            echo "<td><form action='index.php' method='post'><button type='submit' name='btnEditar'>Editar</button></form>";

            echo "</td>";
        }
        echo "</tr>";


        echo "<tr><td>10:15 - 11:15</td>";
        for ($i = 1; $i < 6; $i++) {
            echo "<td><form action='index.php' method='post'><button type='submit' name='btnEditar'>Editar</button></form>";
            echo "</td>";
        }
        echo "</tr>";

        echo "<tr><td>11:15 - 11:45</td><td class='centro' colspan='5'>RECREO</td></tr>";

        echo "<tr><td>11:45 - 12:45</td>";
        for ($i = 1; $i < 6; $i++) {
            echo "<td><form action='index.php' method='post'><button type='submit' name='btnEditar'>Editar</button></form>";
            echo "</td>";
        }
        echo "</tr>";


        echo "<tr><td>12:45 - 13:45</td>";
        for ($i = 1; $i < 6; $i++) {
            echo "<td><form action='index.php' method='post'><button type='submit' name='btnEditar'>Editar</button></form>";
            echo "</td>";
        }
        echo "</tr>";

        echo "<tr><td>13:45 - 14:45</td>";
        for ($i = 1; $i < 6; $i++) {
            echo "<td><form action='index.php' method='post'><button type='submit' name='btnEditar'>Editar</button></form>";
            echo "</td>";
        }
        echo "</tr>";

        echo "</table>";
    }



    ?>
</body>

</html>