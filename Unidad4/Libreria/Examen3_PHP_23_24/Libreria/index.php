<?php
session_name("examen3_22_23");
session_start();


function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body>' . $body . '</body></html>';
    return $html;
}

// si se ha pulsado el boton de salir borra la sesion para volver al login
if (isset($_POST["btnSalir"])) {
    session_destroy();
}


// errores del formulario login
if (isset($_POST["btnLogin"])) {
    $errorUsu = $_POST["usuario"] == "";
    $errorClave = $_POST["clave"] == "";

    $errorForm = $errorUsu || $errorClave;

    // Si no hay error se logea
    if (!$errorForm) {
        // Conexion
        try {
            $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_libreria_exam");
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            error_page("Error Conexion", "Ha habido un error en la conexion");
        }

        // consulta para ver el tipo del usuario y guardar sus datos
        try {
            $consulta = "select * from usuarios where lector = " . $_POST['usuario'] . " and clave =" . md5($_POST['clave']) . "";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            echo $e->getMessage();
            error_page("Error Consulta", "Ha habido un error en la consulta");
        }

        // guardar los datos del cliente
        $datosCliente = mysqli_fetch_assoc($resultado);


        // si han llegado datos
        if (mysqli_num_rows($resultado) > 0) {
            $_SESSION["usuario"] = $_POST["usuario"];
            $_SESSION["clave"] = $_POST["clave"];
            //$_SESSION["tipo"] = $datosCliente["tipo"]
            mysqli_close($conexion);
            mysqli_free_result($resultado);
            //echo "entroooo";
        }
        mysqli_free_result($resultado);
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de inicio</title>
    <style>
        img {
            width: 150px;
            height: 150px;
            border: 1px solid black;
        }
    </style>
</head>

<body>


    <?php
    // si se ha iniciado sesion se salta el login
    if (isset($_SESSION["usuario"])) {
        echo "Bienvenido <strong>" . $_SESSION["usuario"] . "</strong> - ";
        echo "<form action='index.php' method='post'>";
        echo "<button type='submit' name='btnSalir'>Salir</button>";
        echo "</form>";
    } else if ($datosCliente["tipo"] == "admin") {
        header("Location:admin/gest_libros.php");
        exit;
    } else {

    ?>
        <h1>Librería</h1>
        <form action="index.php" method="post">
            <label for="usuario">Usuario:</label> <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>" maxlength="15">
            <?php
            if (isset($_POST["btnLogin"]) && $errorUsu) {
                echo "Campo vacio";
            }
            ?>
            <br>
            <label for="clave">Contraseña:</label><input type="password" name="clave" id="clave" maxlength="50">
            <?php
            if (isset($_POST["btnLogin"]) && $errorClave) {
                echo "Campo vacio";
            }
            ?>
            <br>
            <button type="submit" name="btnLogin">Entrar</button>
        </form>
    <?php
    }
    ?>

    <h2>Listado de los Libros</h2>

    <?php
    // mostrar la tabla

    // Conexion
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_libreria_exam");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die("<p>No se ha podido hacer la conexion</p></body></html>");
    }

    // consulta para ver los libros
    try {
        $consulta = "select * from libros";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        die("<p>No se ha podido hacer la consulta</p></body></html>");
    }


    while ($tupla = mysqli_fetch_assoc($resultado)) {

        echo "<img src='Images/" . $tupla["portada"] . "' alt='imagen del libro'> <br>";
        echo $tupla["titulo"];
        echo " - ";
        echo $tupla["precio"] . "€<br>";
    }

    // cerrar conexiones y liberar datos
    mysqli_close($conexion);
    mysqli_free_result($resultado);
    ?>
</body>

</html>