<?php

// Muestra una página nueva si hay un error en la conexion
function error_page($title, $body)
{
    $page = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . $title . '</title>
            </head>
            <body>' . $body . '</body>
            </html>';
    return $page;
}

// Algo está mal pq no me dice los repetidos
function repetido($conexion, $tabla, $columna, $valor)
{
    // comprobar que la consulta está bien
    try {
        $consulta = "select * from " . $tabla . " where " . $columna . "='" . $valor . "'";
        $resultado = mysqli_query($conexion, $consulta);
        $respuesta = mysqli_num_rows($resultado) > 0;
        mysqli_free_result($resultado);
    } catch (Exception $e) {
        mysqli_close($conexion);
        $respuesta(error_page("Practica 1 CRUD", "<h1>Primer CRUD</h1><p>No se ha podido hacer la consulta:" . $e->getMessage() . "</p>"));
    }

    return $respuesta;
}

if (isset($_POST["botonUsuNuev"]) || isset($_POST["continuar"])) {

    if (isset($_POST["continuar"])) {
        $errorNombre = $_POST["nombre"] == "" || strlen($_POST["nombre"]) > 30;
        $errorUsuar = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 20;

        // NO DEBE HABER USUARIO REPE
        if (!$errorUsuar) {
            // abro conexion para ver que no esta repe
            try {
                $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
                mysqli_set_charset($conexion, "utf8");
            } catch (Exception $e) {
                // creo una página mostrando el error
                die(error_page("Practica 1 CRUD", "<h1>Primer CRUD</h1><p>No se ha podido conectar a la base de datos:" . $e->getMessage() . "</p>"));
            }

            // devuelve true false o un strings
            $errorUsuar = repetido($conexion, "usuarios", "usuario", $_POST["usuario"]);
            if (is_string($errorUsuar)) {
                die($errorUsuar);
            }
        }

        $errorContr = $_POST["ctrs"] == "" || strlen($_POST["ctrs"]) > 15;
        $errorEmail = $_POST["email"] == "" || strlen($_POST["email"]) > 50 || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

        // NO DEBE HABER EMAIL REPE
        if (!$errorEmail) {

            // mirar que esté la conexion abierta
            if (!isset($conexion)) {
                // abro conexion para ver que no esta repe
                try {
                    $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
                    mysqli_set_charset($conexion, "utf8");
                } catch (Exception $e) {
                    // creo una página mostrando el error
                    die(error_page("Practica 1 CRUD", "<h1>Primer CRUD</h1><p>No se ha podido conectar a la base de datos:" . $e->getMessage() . "</p>"));
                }
            }

            // devuelve true false o un strings
            $errorEmail = repetido($conexion, "usuarios", "email", $_POST["email"]);
            if (is_string($errorEmail)) {
                die($errorEmail);
            }
        }

        $errorForm = $errorEmail || $errorUsuar || $errorNombre || $errorContr;


        if (!$errorForm) {
            // Inserto en la bd y salto a index.html
            $consulta = "insert into usuarios(nombre, usuario, clave, email) values ('" . $_POST["nombre"] . "','" . $_POST["usuario"] . "','" . md5($_POST["ctrs"]) . "','" . $_POST["email"] . "')";
            try {
                // no hace falta recorrerlo por lo que no se mete en una variable
                mysqli_query($conexion, $consulta);
            } catch (Exception $e) {
                mysqli_close($conexion);
                die(error_page("Practica 1 CRUD", "<h1>Primer CRUD</h1><p>No se ha podido hacer la consulta:" . $e->getMessage() . "</p>"));
            }

            mysqli_close($conexion);

            header("Location:index.php");
            exit;
        }

        if (isset($conexion)) {
            mysqli_close($conexion);
        }
    }
?>


    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .error {
                color: red;
            }
        </style>
        <title>Practica 1º CRUD</title>
    </head>

    <body>
        <h1>Nuevo Usuario</h1>
        <form action="usuario_nuevo.php" method="post">
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" maxlength="30" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
                <?php
                if (isset($_POST["continuar"]) && $errorNombre) {
                    if ($_POST["nombre"] == "") {
                        echo "<span class='error'>* Campo vacío * </span>";
                    } else{
                        echo "<span class='error'>* El tamaño debe ser menor a 30 caracteres *</span>";
                    }
                }
                ?>
            </p>
            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" maxlength="20" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
                <?php
                if (isset($_POST["continuar"]) && $errorUsuar) {
                    if ($_POST["usuario"] == "") {
                        echo "<span class='error'>* Campo vacío *</span>";
                    } elseif (strlen($_POST["email"]) > 20) {
                        echo "<span class='error'>* El tamaño debe ser menor a 20 caracteres *</span>";
                    } else {
                        echo "<span class='error'>* El usuario ya está en uso *</span>";
                    }
                }
                ?>
            </p>
            <p>
                <label for="ctrs">Contraseña:</label>
                <input type="password" name="ctrs" id="ctrs" maxlength="15">
                <?php
                if (isset($_POST["continuar"]) && $errorContr) {
                    if ($_POST["ctrs"] == "") {
                        echo "<span class='error'>* Campo vacío *</span>";
                    } else {
                        echo "<span class='error'>* El tamaño debe ser menor a 20 caracteres *</span>";
                    }
                }
                ?>
            </p>
            <p>
                <label for="email">Email:</label>
                <input type="text" name="email" maxlength="50" id="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>">
                <?php
                if (isset($_POST["continuar"]) && $errorEmail) {
                    if ($_POST["email"] == "") {
                        echo "<span class='error'>* Campo vacío *</span>";
                    } elseif (strlen($_POST["email"]) > 50) {
                        echo "<span class='error'>* El tamaño debe ser menor a 50 caracteres *</span>";
                    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                        echo "<span class='error'>* El email no está bien escrito *</span>";
                    } else {
                        echo "<span class='error'>* El email ya está en uso *</span>";
                    }
                }
                ?>
            </p>
            <p>
                <button type="submit" name="continuar">Continuar</button>
                <button type="submit" name="volver">Volver</button>
            </p>
        </form>

    </body>

    </html>

<?php
} else {
    header("Location:index.php");
    exit;
}
?>