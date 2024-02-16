<?php

session_name("loginApi");
session_start();

define("MINUTOS", 5);

// Conexion con la API
define("DIR_SERV", "http://localhost/Proyectos/Unidad6/loginApi/servicios_rest");

function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}

if (isset($_POST["btnSalir"])) {
    session_destroy();
    header("Location:index.php");
    exit;
}

function error_page($title, $body)
{
    $respuesta = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport'>
        <title>" . $title . "</title>
    </head>
    <body>
            " . $body . "
    </body>
    </html>";
    return $respuesta;
}


if (isset($_SESSION["usuario"])) {
    // logeado

    // seguridad
    $datos['usuario'] = $_SESSION['usuario'];
    $datos['clave'] = $_SESSION['clave'];

    $url = DIR_SERV . '/login';
    $respuesta = consumir_servicios_REST($url, "POST", $datos);

    $obj = json_decode($respuesta);

    if (!$obj) {
        session_destroy();
        die(error_page('Api LOgin', '<h1>Api Login</h1>' . $respuesta));
    }

    if (isset($obj->mensaje_error)) {
        session_destroy();
        die(error_page('Api LOgin', '<h1>Api Login</h1> <p>' . $obj->mensaje_error . '</p>'));
    }

    // te han baneado   1º parte seguridad
    if (isset($obj->mensaje)) {
        session_unset();
        $_SESSION["seguridad"] = "Ya no está en la bd";
        header("Location:index.php");
        exit;
    }

    $datos_usuario_log = $obj->usuario;

    // 2º parte tiempo  ( si se ha pasado de tiempo te manda al index de nuevo )
    if (time() - $_SESSION["ultimaAccion"] > MINUTOS * 60) {
        session_unset();
        $_SESSION["seguridad"] = "Se ha acabado su tiempo";
        header("Location:index.php");
        exit;
    }

    $_SESSION["ultimaAccion"] = time();

    if ($datos_usuario_log->tipo == "normal") {
        require "vistas/vistaNormal.php";
    } else {
        require "vistas/vistaAdmin.php";
    }
} else {
    // no logeado

    // errores
    if (isset($_POST["btnLogin"])) {
        $errorUsu = $_POST["usuario"] == "";
        $errorClav = $_POST["clave"] == "";


        $errorForm = $errorClav || $errorUsu;

        // recojo datos
        if (!$errorForm) {
            $datos['usuario'] = $_POST['usuario'];
            $datos['clave'] = md5($_POST['clave']);


            $url = DIR_SERV . '/login';
            $respuesta = consumir_servicios_REST($url, "POST", $datos);

            $obj = json_decode($respuesta);

            if (!$obj) {
                session_destroy();
                die(error_page('Api LOgin', '<h1>Api Login</h1>' . $respuesta));
            }

            if (isset($obj->mensaje_error)) {
                session_destroy();
                die(error_page('Api LOgin', '<h1>Api Login</h1> <p>' . $obj->mensaje_error . '</p>'));
            }



            if (isset($obj->mensaje)) {
                $errorUsu = true;
                $_SESSION["seguridad"] = $obj->mensaje;
            } else {
                $_SESSION["usuario"] = $obj->usuario->usuario;
                $_SESSION["clave"] = $obj->usuario->clave;
                $_SESSION["ultimaAccion"] = time();


                header('Location:index.php');
                exit;
            }
        }
    }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login con API</title>
        <style>
            .seguridad {
                color: blue;
            }

            .error {
                color: red;
            }
        </style>
    </head>

    <body>
        <h1>Login API</h1>
        <form action="index.php" method="post">
            <p>
                <label for="usuario">Usuario</label> <br>
                <input type="text" id="usuario" name="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario'] ?>">
                <?php
                if (isset($_POST['btnLogin']) && $errorForm) {
                    if ($_POST["usuario"] == "") {
                        echo "<span class='error'>Campo vacio</span>";
                    }
                    echo "<span class='error'>Usuario o clave no validos</span>";
                }
                ?>
            </p>

            <p>
                <label for="clave">Contraseña</label> <br>
                <input type="password" id="clave" name="clave">
                <?php
                if (isset($_POST['btnLogin']) && $errorForm) {
                    echo "<span class='error'>Campo vacio</span>";
                }
                ?>
            </p>
            <button type="submit" name="btnLogin">Login</button>

        </form>
        <?php
        if (isset($_SESSION["seguridad"])) {
            echo "<span class='seguridad'>" . $_SESSION["seguridad"] . "</span>";
            session_destroy();
        }
        ?>
    </body>

    </html>

<?php
}

?>