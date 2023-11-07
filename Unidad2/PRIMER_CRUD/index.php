<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1º CRUD</title>
    <style>
        table,
        th,
        td {
            border: solid 1px black;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background-color: #CCC;
        }

        table img {
            height: 60px;
            width: 65px
        }

        .enlace {
            border: none;
            background: none;
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Listado de los usuarios</h1>

    <?php
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die("<p>No se ha podido conectar a la base de datos:" . $e->getMessage() . "</p></body></html>");
    }

    $consulta = "select * from usuarios";
    try {
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("<p>Imposible realizar la consulta:" . $e->getMessage() . "</p></body></html>");
    }

    mysqli_data_seek($resultado, 0);
    echo "<table>";
    echo "<tr><th>Nombre de Usuario</th><th>Borrar</th><th>Editar</th></tr>";

    // MIENTRAS HAYA TUPLAS     tmb se puede hacer escalar con un for
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button class ='enlace' title='Detalles del usuario' value='" . $tupla["id_usuario"] . "' type='submit' name='btnDetalle'>" . $tupla["nombre"] . "</button></form></td>";
        echo "<td><form action='index.php' method='post'><button class ='enlace' title='Borrar a un usuaro' value='" . $tupla["id_usuario"] . "' type='submit' name='btnBorrar'><img src='images/borrar.png' title='Borrar usuario' alt='Borrar'></button></form></td>";
        echo "<td><form action='index.php' method='post'><button class ='enlace' title='Editar a un usuaro' value='" . $tupla["id_usuario"] . "' type='submit' name='btnEditar'><img src='images/editar.png' title='Editar usuario' alt='Borrar'></button></form></td>";
        echo "</tr>";
    }
    echo "</table>";

    if (isset($_POST["btnDetalle"])) {
        echo "<h3>Detalles del usuario con id " . $_POST["btnDetalle"] . "</h3>";

        // Consulta dependiendo del id del usuario
        try {
            $consulta = "select * from usuarios where id_usuario='" . $_POST["btnDetalle"] . "'";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die("<p>Imposible realizar la consulta:" . $e->getMessage() . "</p></body></html>");
        }

        // Por si se borra un usuario, no se recarga la página y pulsas al usuario borrado
        if (mysqli_num_rows($resultado) > 0) {    // Si he obtenido una tupla

            // Datos del usuario
            $datos_usuario = mysqli_fetch_assoc($resultado);
            echo "<p>";
            echo "<strong>Nombre: </strong>" . $datos_usuario["nombre"] . "<br>";
            echo "<strong>Usuario: </strong>" . $datos_usuario["usuario"] . "<br>";
            echo "<strong>Email: </strong>" . $datos_usuario["email"] . "<br>";
            echo "</p>";
        } else {
            echo "<p>El usuario seleccionado ya no se encuentra en la base de datos</p>";
        }



        // Boton volver
        echo "<form action='index.php' method='post'>";
        echo "<button type='submit'>Volver</button>";

    } elseif (isset($_POST["btnBorrar"])) {
        echo "borra";

    } elseif (isset($_POST["btnEditar"])) {
        echo "edita";
        
    } else {
        echo "<br>";
        echo "<form action='usuario_nuevo.php' method='post'>";
        echo "<button type='submit' name='botonUsuNuev'>Nuevo usuario</button>";
        echo "</form>";
    }


    mysqli_free_result($resultado);
    mysqli_close($conexion);




    ?>
</body>

</html>