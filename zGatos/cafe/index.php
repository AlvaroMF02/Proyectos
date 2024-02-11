<?php

use Slim\Http\Response;

session_name("Cafeteria");
session_start();
require "src/funcionesConst.php";

if (isset($_POST["btnSalir"])) {      // ---------------- SALIR AL LOGIN ---------------- ###
    $datos["api_session"] = $_SESSION["api_session"];
    consumir_servicios_REST(DIR_SERV . "/salir", "POST", $datos);
    session_destroy();
    header("Location:index.php");
}

if (isset($_SESSION["usuario"])) {  // ---------------- LOGUEADO NORMAL ---------------- ###

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vista normal</title>
        <style>
            .enlace {
                background: none;
                color: blue;
                border: none;
                cursor: pointer;
                text-decoration: underline;
            }

            .enlinea {
                display: inline;
            }

            table,
            tr,
            td,
            th {
                border: 1px solid black;
                border-collapse: collapse;
                text-align: center;
                width: 40rem;
            }

            th {
                background-color: lightsalmon;
            }
        </style>
    </head>

    <body>
        <h1>Vista normal de la cafeteria</h1>
        <p>Bienvenido <?php echo $_SESSION["usuario"] ?>
        <form class="enlinea" action="index.php" method="post"><button class="enlace" name="btnSalir">Salir</button></form>
        <h2>Michis del café</h2>
        <?php                                              // ---------------- MOSTRAR A TODOS LOS GATOS ( VISTA NORMAL )----------------
        $url = DIR_SERV . "/mostrar";
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta);

        if (!$obj) die("<p>No se ha hecho nada " . $respuesta . "</p></body></html>");                                                          // poner session destroy ???????
        if (isset($obj->error)) {
            die("<p>No se ha hecho nada " . $obj->error . "</p></body></html>");
        }

        echo "<table>";
        echo "<th>Nombre</th><th>Color</th><th>Edad</th>";
        foreach ($obj->gatos as $michi) {
            echo "<tr>";
            echo "<td>" . $michi->nombre . "</td>";
            echo "<td>" . $michi->color . "</td>";
            echo "<td>" . $michi->edad . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </body>

    </html>

<?php

} else {                              // ---------------- LOGIN ---------------- ###
    if (isset($_POST["btnLogin"])) {
        $errorUsu = $_POST["usuario"] == "";
        $errorCla = $_POST["clave"] == "";

        $errorForm = $errorUsu || $errorCla;

        if (!$errorForm) {
            $datos["usuario"] = $_POST["usuario"];
            $datos["clave"] = md5($_POST["clave"]);

            $url = DIR_SERV . "/login";
            $respuesta = consumir_servicios_REST($url, "POST", $datos);
            $obj = json_decode($respuesta);

            if (!$obj) {         // session destroy pq hay un die
                // session_destroy();
                die(error_page("Error login", "<h1>Error Login</h1>", " <p>Error al hacer el login</p>"));
            }

            if (isset($obj->error)) {
                // session_destroy();                                                               ----------------------------------  PROBAR SIN COMENTAR -----------------------------------
                die(error_page("Error login", "<h1>Error Login</h1> <p>" . $obj->error . "</p>"));
            }

            if (isset($obj->mensaje)) {
                $errorUsu = true;
            } else {
                // si no hay errores crea las sesiones y redirecciona dependiendo del tipo
                $_SESSION["usuario"] = $obj->usuario->usuario;
                $_SESSION["clave"] = $obj->usuario->clave;
                $_SESSION["api_session"] = $obj->api_session;
                $_SESSION["ult_accion"] = time();

                if ($obj->usuario->tipo == "admin") {
                    header("Location:admin.php");
                } else {
                    header("Location:index.php");
                }
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
        <style>
            .error {
                color: red;
            }
        </style>
        <title>Login Cafeteria</title>
    </head>

    <body>
        <h1>Login cafeteria</h1>
        <form action="index.php" method="post">
            <p>
                <label for="usuario">Usuario</label> <br>
                <input type="text" name="usuario" id="usuario">
                <?php
                if (isset($_POST["btnLogin"]) && $errorUsu) {
                    if ($_POST["usuario"] == "") {
                        echo "<span class='error'>Campo vacío</span>";
                    } else {
                        echo "<span class='error'>Usuario inexistente</span>";
                    }
                }
                ?>
            </p>
            <p>
                <label for="clave">Contraseña</label> <br>
                <input type="password" name="clave" id="clave">
                <?php
                if (isset($_POST["btnLogin"]) && $errorCla) {
                    echo "<span class='error'>Campo vacío</span>";
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