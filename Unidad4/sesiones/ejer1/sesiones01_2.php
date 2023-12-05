<?php
session_name("ejer_01_23_24");
session_start();
if (isset($_POST["nombre"])) {
    if ($_POST["nombre"] == "") {
        unset($_SESSION["nombre"]);
    }else{
        $_SESSION["nombre"] = $_POST["nombre"];
    }
}
if (isset($_POST["btnBorrar"])) {

    session_destroy();
    header("Location:sesiones01_1.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones 1</title>
    <style>
        .textCentrado {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class='textCentrado'>FORMULARIO NOMBRE 1 (RESULTADO)</h1>
    <?php
    if (isset($_POST["nombre"]) && $_POST["nombre"] != "") {

        echo "<p>Su nombre es:<strong>" . $_POST["nombre"] . "</strong></p>";
    } else {
        echo "<p>No has tecleado nada</p>";
    }


    ?>
    <p> <a href="sesiones01_1.php">Volver a la primera página</a></p>

</body>

</html>