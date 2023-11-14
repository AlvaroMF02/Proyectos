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


    // *************************** Consulta para ver toda la tabla usuarios *************************************
    try {
        $consulta = "select * from usuarios";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("<p>Imposible realizar la consulta:" . $e->getMessage() . "</p></body></html>");
    }
    // Al pulsar en el usuario muestra los detalles de este
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

            echo "<strong>Usuario: </strong>" . $datos_usuario["usuario"] . "<br>";
            echo "<strong>Clave: </strong>" . $datos_usuario["clave"] . "<br>";
            echo "<strong>Nombre: </strong>" . $datos_usuario["nombre"] . "<br>";
            echo "<strong>Dni: </strong>" . $datos_usuario["dni"] . "<br>";
            echo "<strong>Sexo: </strong>" . $datos_usuario["sexo"] . "<br>";
            echo "<strong>Foto: </strong><img src='Img/" . $datos_usuario["foto"] . "' alt='Imagen de usuario'><br>";
            echo "</p>";

            // Boton volver
            echo "<form action='index.php' method='post'>";
            echo "<button type='submit'>Volver</button></form><br>";

            // Mirar en la función de arriba
        } else {
            echo "<p>El usuario seleccionado ya no se encuentra en la base de datos</p>";
        }
        // *************************** Consulta para ver toda la tabla usuarios *************************************

        // *************************** Añadir a un usuario nuevo *************************************
    } elseif (isset($_POST["btnUsuarioNuevo"])) {
    ?>
        <h1>Nuevo Usuario</h1>
        <form action="index.php" method="post">
            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" maxlength="30" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
                <?php
                // if (isset($_POST["continuar"]) && $errorUsuar) {
                //     if ($_POST["usuario"] == "") {
                //         echo "<span class='error'>* Campo vacío *</span>";
                //     } elseif (strlen($_POST["email"]) > 20) {
                //         echo "<span class='error'>* El tamaño debe ser menor a 20 caracteres *</span>";
                //     } else {
                //         echo "<span class='error'>* El usuario ya está en uso *</span>";
                //     }
                // }
                ?>
            </p>
            <p>
                <label for="clave">Clave:</label>
                <input type="password" name="clave" id="clave" maxlength="50">
                <?php
                // if (isset($_POST["continuar"]) && $errorContr) {
                //     if ($_POST["ctrs"] == "") {
                //         echo "<span class='error'>* Campo vacío *</span>";
                //     } else {
                //         echo "<span class='error'>* El tamaño debe ser menor a 20 caracteres *</span>";
                //     }
                // }
                ?>
            </p>
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" maxlength="50" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
                <?php
                // if (isset($_POST["continuar"]) && $errorNombre) {
                //     if ($_POST["nombre"] == "") {
                //         echo "<span class='error'>* Campo vacío * </span>";
                //     } else {
                //         echo "<span class='error'>* El tamaño debe ser menor a 30 caracteres *</span>";
                //     }
                // }
                ?>
            </p>
            <p>
                <label for="dni">Dni:</label>
                <input type="text" name="dni" id="dni" maxlength="10" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
                <?php
                // if (isset($_POST["continuar"]) && $errorNombre) {
                //     if ($_POST["nombre"] == "") {
                //         echo "<span class='error'>* Campo vacío * </span>";
                //     } else {
                //         echo "<span class='error'>* El tamaño debe ser menor a 30 caracteres *</span>";
                //     }
                // }
                ?>
            </p>
            <p>
                <label for="sexo">Sexo:</label><br>
                <input type="radio" name="sexo" id="hombre" value="hombre"><label for="hombre">Hombre</label><br>
                <input type="radio" name="sexo" id="mujer" value="mujer"><label for="mujer">Mujer</label>
                <?php
                // if (isset($_POST["continuar"]) && $errorNombre) {
                //     if ($_POST["nombre"] == "") {
                //         echo "<span class='error'>* Campo vacío * </span>";
                //     } else {
                //         echo "<span class='error'>* El tamaño debe ser menor a 30 caracteres *</span>";
                //     }
                // }
                ?>
            </p>

            <p>
                <label for="foto">Incluir mi foto (Max. 500KB)</label>
                <input type="file" name="foto" id="foto">
                <?php
                // if (isset($_POST["continuar"]) && $errorNombre) {
                //     if ($_POST["nombre"] == "") {
                //         echo "<span class='error'>* Campo vacío * </span>";
                //     } else {
                //         echo "<span class='error'>* El tamaño debe ser menor a 30 caracteres *</span>";
                //     }
                // }
                ?>
            </p>

            
            <p>
                <button type="submit" name="btnContinUsuaNuevo">Continuar</button>
                <button type="submit">Volver</button>
            </p>
        </form>
    <?php
        // Crear consulta para añadir 


        // *************************** Añadir a un usuario nuevo *************************************
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
        echo "<td><form action='index.php' method='post'><button class ='enlace' title='Borrar a un usuaro' value='" . $tupla["id_usuario"] . "' type='submit' name='btnBorrar'>Borrar</button> - ";
        echo "<button class ='enlace' title='Editar a un usuaro' value='" . $tupla["id_usuario"] . "' type='submit' name='btnEditar'>Editar</button></form></td>";
        echo "</tr>";
    }
    echo "</table>";



    mysqli_free_result($resultado);
    ?>
</body>

</html>