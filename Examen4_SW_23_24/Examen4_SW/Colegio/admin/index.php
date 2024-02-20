<?php
session_name("Examen4_SW_23_24");
session_start();
require "../src/funciones_ctes.php";

$url = DIR_SERV . "/alumnos";
$datos["api_session"] = $_SESSION["api_session"];
$respuesta = consumir_servicios_REST($url, "GET", $datos);
$obj = json_decode($respuesta);

if (!$obj) {
    session_destroy();
    die(error_page("Examen4 DWESE Curso 23-24", "<h1>Notas de los alumnos</h1><p>Error consumiendo el servicio: " . $url . "</p>"));
}
if (isset($obj->error)) {
    session_destroy();
    die(error_page("Examen4 DWESE Curso 23-24", "<h1>Notas de los alumnos</h1><p>" . $obj->error . "</p>"));
}
if (isset($obj->no_auth)) {
    session_unset();
    $_SESSION["seguridad"] = "El tiempo de sesión de la API ha caducado";
    header("Location:index.php");
    exit;
}

if (isset($_POST["btnNotas"]) || isset($_POST["btnBorrar"])) {
    if (isset($_POST["btnBorrar"])) {
        $usuario = $_POST["idForm"];
    } else {
        $usuario = $_POST["alumnos"];
    }
    $url = DIR_SERV . "/notasAlumno/" . $usuario;
    $datos["api_session"] = $_SESSION["api_session"];
    $respuesta = consumir_servicios_REST($url, "GET", $datos);
    $obj2 = json_decode($respuesta);

    if (!$obj2) {
        session_destroy();
        die(error_page("Examen4 DWESE Curso 23-24", "<h1>Notas de los alumnos</h1><p>Error consumiendo el servicio: " . $url . "</p>"));
    }
    if (isset($obj2->error)) {
        session_destroy();
        die(error_page("Examen4 DWESE Curso 23-24", "<h1>Notas de los alumnos</h1><p>" . $obj2->error . "</p>"));
    }
    if (isset($obj2->no_auth)) {
        session_unset();
        $_SESSION["seguridad"] = "El tiempo de sesión de la API ha caducado";
        header("Location:index.php");
        exit;
    }
}

if (isset($_POST["btnBorrar"])) {
    $url = DIR_SERV . "/quitarNota/".$_SESSION["id"];
    $datos["api_session"] = $_SESSION["api_session"];
    $datos["cod_asig"] = $_POST["btnBorrar"];
    $respuesta = consumir_servicios_REST($url, "DELETE", $datos);
    $obj3 = json_decode($respuesta);

    if (!$obj3) {
        session_destroy();
        die(error_page("Examen4 DWESE Curso 23-24", "<h1>Notas de los alumnos</h1><p>Error consumiendo el servicio: " . $url . "</p>"));
    }
    if (isset($obj3->error)) {
        session_destroy();
        die(error_page("Examen4 DWESE Curso 23-24", "<h1>Notas de los alumnos</h1><p>" . $obj3->error . "</p>"));
    }
    if (isset($obj3->no_auth)) {
        session_unset();
        $_SESSION["seguridad"] = "El tiempo de sesión de la API ha caducado";
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
    <title>Document</title>
    <style>
        .enLinea {
            display: inline;
        }

        .enlace {
            background: none;
            color: blue;
            border: none;
            text-decoration: underline;
            cursor: pointer;
        }

        table,
        tr,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
            width: 25rem;
        }

        th {
            background-color: lightgrey;
        }
        .msj{
            color: blue;
        }
    </style>
</head>

<body>
    <h1>Notas de los alumnos</h1>
    <?php
    echo "Bienvenido <strong>" . $_SESSION["usuario"] . "</strong> - <form class='enLinea' method='post' action='../index.php'><button name='btnSalir' class='enlace'>Salir</button></form>";
    echo "<form action='index.php' method='post'>";

    if (count($obj->alumnos) > 0) {
        echo '<br><label for="alumnos">Seleccione un Alumno: </label>';
        echo '<select name="alumnos" id="alumnos">';
        foreach ($obj->alumnos as $tupla) {
            if (isset($_POST["alumnos"]) && $_POST["alumnos"] == $tupla->cod_usu) {
                echo "<option selected value='" . $tupla->cod_usu . "'>" . $tupla->nombre . "</option>";
                $nombre = $tupla->nombre;
                $_SESSION["id"] = $tupla->cod_usu;
                $_SESSION["nombre"] = $tupla->nombre;
            } else {
                echo "<option value='" . $tupla->cod_usu . "'>" . $tupla->nombre . "</option>";
            }
        }
        echo "</select>";

        echo "<button type='submit' name='btnNotas'>Ver notas</button>";

        echo "</form>";

        if (isset($_POST["btnNotas"]) || isset($_POST["btnBorrar"])) {

            echo "<h2>Notas del Alumno <strong>" . $_SESSION["nombre"] . "</strong></h2>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Asignaturas</th><th>Nota</th><th>Acción</th>";               // FALTA PONER LAS ASIGNATURAS QUE LE QUEDAN PARA INSERTAR
            foreach ($obj2->notas as $tupla) {
                echo "<tr>";
                echo "<td>" . $tupla->denominacion . "</td>";
                echo "<td>" . $tupla->nota . "</td>";
                echo "<td><form method='post' action='index.php'><button name='btnEditar' class='enlace'>Editar</button> - <button value = '".$tupla->cod_asig."' name='btnBorrar' class='enlace'>Borrar</button>";
                echo "<input hidden name='nombreForm' value='".$_SESSION["nombre"]."'>";
                echo "<input hidden name='idForm' value='".$_SESSION["id"]."'>";
                echo "</form></td>";
                echo "</tr>";
            }
            echo "</tr>";
            echo "</table>";

            if(isset($_SESSION["mensaje"])){
                echo "<span class='msj'>".$_SESSION["mensaje"]."</span>";
                unset($_SESSION["mensaje"]);
            }
        }

        if (isset($_POST["btnBorrar"])) {
            $_SESSION["mensaje"] = $obj3->mensaje;
            header("Location:index.php");
            exit;
        }
    } else {
        echo "<p>En estos momentos no tenemos ningun alumno registrado en la BD</p>";
    }


    ?>

</body>

</html>