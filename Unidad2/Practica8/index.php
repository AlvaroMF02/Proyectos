<?php

require "src/ctes_funciones.php";


// Errores al insertar
if (isset($_POST["btnContinUsuaNuevo"])) {
    $errorUsuar = $_POST["usuario"] == "";
}

// Borrar a un usuario
if (isset($_POST["btnContBorrar"])) {
    try {
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die(error_page("Práctica 1º CRUD", "<h1>Listado de los usuarios</h1><p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
    }

    try {
        $consulta = "delete from usuarios where id_usuario='" . $_POST["btnContBorrar"] . "'";
        mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Práctica 1º CRUD", "<h1>Listado de los usuarios</h1><p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
    }

    mysqli_close($conexion);
    header("Location:index.php");
    exit();

    // Borrar la imagen del server


} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        table img {
            height: 60px;
            width: 65px;
            margin-left: 3rem;
            margin-right: 3rem;
        }

        img {
            height: 60px;
            width: 65px;
        }

        .enlace {
            border: none;
            background: none;
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }

        .error {
            color: red;
        }
    </style>
    <title>Practica 8</title>
</head>

<body>
    <h1>Práctica 8</h1>

    <?php

    // Conexion a la BD
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die("<p>No se ha podido conectar a la base de datos:" . $e->getMessage() . "</p></body></html>");
    }


    try {
        $consulta = "select * from usuarios";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("<p>Imposible realizar la consulta:" . $e->getMessage() . "</p></body></html>");
    }

    // Al pulsar en el usuario muestra los detalles de este
    if (isset($_POST["btnDetalle"])) {
        require("vistas/vistaDetalle.php");

    } elseif (isset($_POST["btnUsuarioNuevo"]) || isset($_POST["btnContinUsuaNuevo"])) {
        require("vistas/vistaUsuNuevo.php");

    } elseif (isset($_POST["btnBorrar"])) {
        require "vistas/vistaBorrar.php";
    }


    mysqli_data_seek($resultado, 0);
    echo "<table>";
    echo "<tr><th>#</th><th>Foto</th><th>Nombre</th><th><form action='index.php' method='post'><button class ='enlace' title='Añadir usuario' type='submit' name='btnUsuarioNuevo'>Usuario+</button></form></th></tr>";
    // MIENTRAS HAYA TUPLAS     tmb se puede hacer escalar con un for
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $tupla["id_usuario"] . "</td>";
        echo "<td><img src='Img/" . $tupla['foto'] . "' alt='Imagen de usuario'></td>";
        echo "<td><form action='index.php' method='post'><button class ='enlace' title='Detalles del usuario' value='" . $tupla["id_usuario"] . "' type='submit' name='btnDetalle'>" . $tupla["nombre"] . "</button></form></td>";
        echo "<td><form action='index.php' method='post'><input type='hidden' name='nombre_usuario' value='" . $tupla["foto"] . "'><button class ='enlace' title='Borrar a un usuaro' value='" . $tupla["id_usuario"] . "' type='submit' name='btnBorrar'>Borrar</button> - ";
        echo "<button class ='enlace' title='Editar a un usuaro' value='" . $tupla["id_usuario"] . "' type='submit' name='btnEditar'>Editar</button></form></td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_free_result($resultado);
    ?>
</body>

</html>