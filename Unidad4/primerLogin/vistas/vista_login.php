<?php

if (isset($_POST["btnLogin"])) {
    // comprobamos errores
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";

    $error_form = $error_usuario || $error_clave;

    if (!$error_form) {
        // Continuo con el login si no hay errores

        // conexion
        try {
            $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            session_destroy();
            die(error_page("Primer Login", "<h1>Primer Login</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }

        // consulta
        try {
            $consulta = "select usuario from usuarios where usuario ='" . $_POST["usuario"] . "' and clave='" . md5($_POST["clave"]) . "'";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Primer Login", "<h1>Primer Login</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }

        // ver si he obtenido tuplas
        if (mysqli_num_rows($resultado) > 0) {
            // el user esta registrado
            $_SESSION["usuario"] = $_POST["usuario"];
            mysqli_free_result($resultado);
            mysqli_close($conexion);

            header("Location:index.php");
            exit;

        } else {
            $error_usuario = true;
        }

        mysqli_free_result($resultado);
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
        .mensaje {
            color: blue;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <h1>Primer Login</h1>

    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
            <?php
            if (isset($_POST["btnLogin"]) && $error_usuario) {
                if ($_POST["usuario"] == "") {
                    echo "<span class='error'>Campo vacío</span>";
                } else {
                    echo "<span class='error'>No estas registrado crack</span>";
                }
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" name="clave" id="clave">
            <?php
            if (isset($_POST["btnLogin"]) && $error_clave) {
                echo "<span class='error'>Campo vacío</span>";
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnLogin">Login</button>
        </p>
    </form>
    <?php
     if (isset($_SESSION["seguridad"])) {
        echo "<span class='mensaje'>".$_SESSION["seguridad"]."</span>";
        session_destroy();
    }
    ?>
</body>

</html>