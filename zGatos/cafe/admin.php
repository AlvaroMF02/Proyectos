<?php
require "src/funcionesConst.php";
session_name("Cafeteria");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .error {
            color: red;
        }

        .msj {
            color: blue;
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
    </style>
    <title>Vista Admin</title>
</head>

<body>
    <h1>Vista Administrador</h1>
    <p>Bienvenido <?php echo $_SESSION["usuario"] ?>
    <form class="enlinea" action="index.php" method="post"><button class="enlace" name="btnSalir">Salir</button></form>
    <h2>Michis del café</h2>
    <?php
    if (isset($_SESSION["mensaje"])) {
        echo "<span class='msj'>" . $_SESSION["mensaje"] . "</span>";
        // session_unset();                                             con session destroy da error ns q poner ???????????????????
    }
    $url = DIR_SERV . "/mostrar";                               // ---------------- MOSTRAR A TODOS LOS GATOS ----------------
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);

    if (!$obj) die("<p>No se ha hecho nada " . $respuesta . "<p>");                                                          // poner session destroy ???????
    if (isset($obj->error)) {
        die("<p>No se ha hecho nada " . $obj->error . "<p>");
    }

    echo "<table>";
    echo "<th>Nombre</th><th>Color</th><th>Edad</th><th><form action='admin.php' method='post'><button name='btnInser' class='enlace'><3 Añadir <3</button></form></th>";
    foreach ($obj->gatos as $michi) {
        echo "<tr>";
        echo "<td><form action='admin.php' method='post'><button name='btnDetall' class='enlace' value='" . $michi->id . "'>" . $michi->nombre . "</button></form></td>";
        echo "<td>" . $michi->color . "</td>";
        echo "<td>" . $michi->edad . "</td>";
        echo "<td><form action='admin.php' method='post'><button name='btnElim' class='enlace' value='" . $michi->id . "'>Borrar</button></form></td>";
        echo "</tr>";
    }
    echo "</table>";

    if (isset($_POST["btnDetall"])) {        // ---------------- MOSTRAR DETALLES DE UN GATO ----------------

        $datos["id"] = $_POST["btnDetall"];
        $datos["api_session"] = $_SESSION["api_session"];

        $url = DIR_SERV . "/detalle";
        $respuesta = consumir_servicios_REST($url, "POST", $datos);
        $obj = json_decode($respuesta);

        if (!$obj) die("<p>No se ha hecho nada chique:" . $respuesta . "</p></body></html>");                                                         // poner session destroy ???????
        if (isset($obj->error)) die("<p>Error de lo que sea lit: " . $obj->error . "</p></body></html>");

        echo "<h2>Detalles de " . $obj->gatos->nombre . " :3</h2>";
        echo "<strong>ID: </strong>" . $obj->gatos->id . "<br>";
        echo "<strong>COLOR: </strong>" . $obj->gatos->color . "<br>";
        echo "<strong>EDAD: </strong>" . $obj->gatos->edad . "<br>";
        echo "<strong>ADOPCIÓN: </strong>" . $obj->gatos->adopcion . "<br>";
        echo "<strong>SALUD: </strong>" . $obj->gatos->salud . "<br>";

        echo "<form action='admin.php' method='post'><p><button>Volver</button></p></form>";
    }

    if (isset($_POST["btnElim"]) || isset($_POST["btnContElim"])) {                // ---------------- ELIMINAR UN GATO ----------------

        echo "<p>¿Seguro que quiere eliminar a el gato ".$_POST["btnElim"]."?</p>";
        echo "<form action='admin.php' method='post'><button name='btnContElim'>Si</button> <button>No</button></form>";

        if(isset($_POST["btnContElim"])) {
            $datos["api_session"] = $_SESSION["api_session"];
            $datos["id"] = $_POST["btnElim"];

            $url = DIR_SERV . "/eliminar";
            $respuesta = consumir_servicios_REST($url,"DELETE",$datos);
            $obj = json_decode($respuesta);

            if(!$obj) die("<p>No hay objeto: ".$respuesta."</p></body></html>");                                                         // poner session destroy ???????
            if(isset($obj->error)) die("<p>Error ns donde: ".$obj->error."</p></body></html>");

            $_SESSION["mensaje"] = $obj->mensaje;

            header("Location:admin.php");
            exit;
        }
    }

    if (isset($_POST["btnInser"]) || isset($_POST["btnContInser"])) {        // ---------------- INSERTAR UN GATO ----------------

        if (isset($_POST["btnContInser"])) {
            $errroNom = $_POST["nombre"] == "";
            $errroCol = $_POST["color"] == "";
            $errroEda = $_POST["edad"] == "";
            $errroSal = $_POST["salud"] == "";

            if (!$errroNom) { // ---------------- COMPROBAR NOMBRE REPETIDO ----------------
                $url = DIR_SERV . "/repe";
                $datos["tabla"] = "gatos";
                $datos["columna"] = "nombre";
                $datos["valor"] = $_POST["nombre"];
                $datos["api_session"] = $_SESSION["api_session"];
                $respuesta = consumir_servicios_REST($url, "POST", $datos);
                $obj = json_decode($respuesta);

                if (!$obj) die("<p>No se ha hecho nada chique:" . $respuesta . "</p></body></html>");                                                         // poner session destroy ???????
                if (isset($obj->error)) die("<p>No se ha hecho nada chique:" . $obj->error . "</p></body></html>");

                $errroNom = $obj->repetido;
            }

            $errorform = $errroNom ||  $errroCol || $errroEda || $errroSal;

            if (!$errorform) {

                $datos["nombre"] = $_POST["nombre"];
                $datos["color"] = $_POST["color"];
                $datos["edad"] = $_POST["edad"];
                $datos["salud"] = $_POST["salud"];
                $datos["adopcion"] = $_POST["adopcion"];
                $datos["api_session"] = $_SESSION["api_session"];

                $url = DIR_SERV . "/insertar";
                $resultado = consumir_servicios_REST($url, "POST", $datos);
                $obj = json_decode($resultado);

                if (!$obj) die("<p>No se ha hecho nada chique:" . $respuesta . "</p></body></html>");                                                         // poner session destroy ???????
                if (isset($obj->error)) die("<p>No se ha hecho nada chique:" . $obj->error . "</p></body></html>");

                $_SESSION["mensaje"] = $obj->mensaje;

                header("Location:admin.php");
                exit;
            }
        }
    ?>

        <h2>Rellene los datos para insertar</h2> <!-- FORMULARIO INSERCION -->
        <form action="admin.php" method='post'>
            <p>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
                <?php
                if (isset($_POST["btnContInser"]) && $errroNom) {
                    if ($_POST["nombre"] == "") {
                        echo "<span class='error'>Campo vacío</span>";
                    } else {
                        echo "<span class='error'>Nombre repetido</span>";
                    }
                }
                ?>
            </p>
            <p>
                <label for="color">Color</label>
                <input type="text" id="color" name="color" value="<?php if (isset($_POST["color"])) echo $_POST["color"] ?>">
                <?php
                if (isset($_POST["btnContInser"]) && $errroCol) {
                    echo "<span class='error'>Campo vacío</span>";
                }
                ?>
            </p>
            <p>
                <label for="edad">Edad</label>
                <input type="text" id="edad" name="edad" value="<?php if (isset($_POST["edad"])) echo $_POST["edad"] ?>">
                <?php
                if (isset($_POST["btnContInser"]) && $errroEda) {
                    echo "<span class='error'>Campo vacío</span>";
                }
                ?>
            </p>
            <p>
                <label for="salud">Salud</label>
                <input type="text" id="salud" name="salud" value="<?php if (isset($_POST["salud"])) echo $_POST["salud"] ?>">
                <?php
                if (isset($_POST["btnContInser"]) && $errroSal) {
                    echo "<span class='error'>Campo vacío</span>";
                }
                ?>
            </p>
            <p>
                <label for="adopcion">Adopcion</label>
                <select name="adopcion" id="adopcion">
                    <option>adoptado</option>
                    <option>en proceso</option>
                    <option>en espera</option>
                </select>
            </p>
            <button name="btnContInser">Insertar</button>
        </form>
    <?php
    }

    ?>
    </p>
</body>

</html>