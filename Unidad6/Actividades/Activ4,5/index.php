<?php
session_name("ejer4");
session_start();
require "src/ctes_funciones.php";

if(isset($_POST["btnSalir"])){
    session_destroy();
    header("Location:index.php");
    exit;
}

if (isset($_POST["btnContEditar"])) {
    //Errores cuándo edito
    $error_nombre = $_POST["nombre"] == "" || strlen($_POST["nombre"]) > 30;
    $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 20;
    if (!$error_usuario) {
        // ---------------------- COMPROBAR USUARIO REPE EDITADO ----------------------
        $url = DIR_SERV . "/comprobarRepetidoEdit/usuarios/usuario/" . $_POST["usuario"] . "/id_usuario/" . $_POST["btnContEditar"];
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta);

        if (!$obj) echo "Error en la API:" . $respuesta;
        if (isset($obj->error)) echo "Error en la consulta:" . $obj->error;

        // lo pone true si esta repe
        $error_usuario = $obj->repetido;
    }
    $error_clave = strlen($_POST["clave"]) > 15;
    $error_email = $_POST["email"] == "" || strlen($_POST["email"]) > 50 || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    if (!$error_email) {
        // ---------------------- COMPROBAR EMAIL REPE EDITADO ----------------------
        $url = DIR_SERV . "/comprobarRepetidoEdit/usuarios/email/" . $_POST["email"] . "/id_usuario/" . $_POST["btnContEditar"];
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta);

        if (!$obj) echo "Error en la API:" . $respuesta;
        if (isset($obj->error)) echo "Error en la consulta:" . $obj->error;

        // lo pone true si esta repe
        $error_email = $obj->repetido;
    }

    $error_form = $error_nombre || $error_usuario || $error_clave || $error_email;

    if (!$error_form) {
        // ---------------------- EDITAR USUARIO ----------------------
        $datos["nombre"] = $_POST["nombre"];
        $datos["usuario"] = $_POST["usuario"];
        $datos["clave"] = $_POST["clave"];
        $datos["email"] = $_POST["email"];

        $url = DIR_SERV . "/actualizarUsuario/" . urlencode($_POST["btnContEditar"]);
        $respuesta = consumir_servicios_REST($url, "PUT", $datos);
        $obj = json_decode($respuesta);

        if (!$obj) echo "Error en la API:" . $respuesta;
        if (isset($obj->error)) echo "Error en la consulta:" . $obj->error;

        $_SESSION["mensajes"] = $obj->mensaje;

        header("Location:index.php");
        exit;
    }
}

// ------------------------ BORRAR USUARIO ------------------------
if (isset($_POST["btnContBorrar"])) {
    $url = DIR_SERV . "/borrarUsuario/" . urlencode($_POST["btnContBorrar"]);
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $obj = json_decode($respuesta);

    if (!$obj) echo "Error en la API:" . $respuesta;
    if (isset($obj->error)) echo "Error en la consulta:" . $obj->error;

    $_SESSION["mensajes"] = $obj->mensaje;

    header("Location:index.php");
    exit();
}

if (isset($_SESSION["usuario"])) {

    if ($_SESSION["tipo"] == "admin") {
?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Práctica 1º CRUD</title>
            <style>
                table,
                td,
                th {
                    border: 1px solid black
                }

                table {
                    border-collapse: collapse;
                    text-align: center
                }

                th {
                    background-color: #CCC
                }

                table img {
                    width: 50px;
                }

                .enlace {
                    border: none;
                    background: none;
                    cursor: pointer;
                    color: blue;
                    text-decoration: underline
                }

                .error {
                    color: red
                }

                .msj {
                    color: blue;
                }
            </style>
        </head>

        <body>
            <h1>Listado de los usuarios</h1>
            <p>Bienvenidx <?php echo $_SESSION["usuario"]; echo "<form action='index.php' method='post'><button class='enlace' name='btnSalir'>Salir</button></form>";?> </p>
            <?php
            require "vistas/vista_tabla.php";

            if (isset($_POST["btnDetalle"])) {
                require "vistas/vista_detalle.php";
            } elseif (isset($_POST["btnBorrar"])) {
                echo "<p>Se dispone usted a borrar a usuario <strong>" . $_POST["nombre_usuario"] . "</strong></p>";
                echo "<form action='index.php' method='post'>";
                echo "<p><button type='submit' name='btnContBorrar' value='" . $_POST["btnBorrar"] . "'>Continuar</button> ";
                echo "<button type='submit'>Atrás</button></p>";
                echo "</form>";
            } elseif (isset($_POST["btnEditar"]) || isset($_POST["btnContEditar"])) {
                require "vistas/vista_editar.php";
            } else {
                echo "<form action='usuario_nuevo.php' method='post'>";
                echo "<p><button type='submit' name='btnNuevoUsuario'>Insertar nuevo Usuario</button></p>";
                echo "</form>";
            }

            ?>
        </body>

        </html>
    <?php
    } else {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Vista normal</title>
        </head>

        <body>
            <h1>Vista normal</h1>
            <p>Bienvenidx <?php echo $_SESSION["usuario"]; echo "<form action='index.php' method='post'><button name='btnSalir'>Salir</button></form>";?> </p>
        </body>

        </html>
    <?php
    }
} else {

    // control de errores en el login
    if (isset($_POST["btnLogin"])) {
        $errorUsu = $_POST["usuario"] == "";
        $errorClav = $_POST["clave"] == "";

        $errorForm = $errorUsu || $errorClav;

        // Compruebo puede hacer login
        if (!$errorForm) {

            $datos["usuario"] = $_POST["usuario"];
            $datos["clave"] = md5($_POST["clave"]);

            $url = DIR_SERV . "/login";
            $respuesta = consumir_servicios_REST($url, "POST", $datos);
            $obj = json_decode($respuesta);

            if (!$obj) die(error_page("Error login", "<h1>error al logearse</h1>"));
            if (isset($obj->error)) die(error_page("Error login", "<h1>error al logearse " . $obj->mensaje . "</h1>"));
            if (isset($obj->mensaje)) $errorForm = true;

            $_SESSION["usuario"] = $obj->usuario->nombre;
            $_SESSION["clave"] = $obj->usuario->clave;
            $_SESSION["tipo"] = $obj->usuario->tipo;
            $_SESSION["api_session"] = $obj->usuario->api_session;
            $_SESSION["tiempo"] = time();

            header("Location:index.php");
            exit;
        }
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <style>
            .error {
                color: red;
            }
        </style>
    </head>

    <body>
        <h1>Login</h1>
        <form action="index.php" method="post">
            <p>
                <label for="usuario">Usuario</label> <br>
                <input type="text" name="usuario" id="usuario">
                <?php
                if (isset($_POST["btnLogin"]) && $errorForm) {
                    if ($_POST["usuario"] == "") {
                        echo "<span class='error'> Campo vacío </span>";
                    } else {
                        echo "<span class='error'> Usuario incorrecto </span>";
                    }
                }
                ?>
            </p>
            <p>
                <label for="clave">Contraseña</label> <br>
                <input type="password" name="clave" id="clave">
                <?php
                if (isset($_POST["btnLogin"]) && $errorForm) {
                    if ($_POST["clave"] == "")
                        echo "<span class='error'> Campo vacío </span>";
                }
                ?>
            </p>
            <button name="btnLogin">Entrar</button>

        </form>
    </body>

    </html>

<?php

}

?>