<?php
session_name("ejer_01_23_24");
session_start();

// Si hay un nombre
if (isset($_POST["nombre"])) {
    // si no hay nada lo unset
    if ($_POST["nombre"] == "") {
        unset($_SESSION["nombre"]);
    }else{
        // si no crea la session del nombre con lo escrito en el formulario
        $_SESSION["nombre"] = $_POST["nombre"];
    }
}

// si le da a borrar hace un destroy de la sesion y te lleva ek header
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
    // Si hay un nombre y eln ombre no esta vacio
    if (isset($_POST["nombre"]) && $_POST["nombre"] != "") {
        // muestra el nombre
        echo "<p>Su nombre es:<strong>" . $_POST["nombre"] . "</strong></p>";
    } else {
        echo "<p>No has tecleado nada</p>";
    }


    ?>
    <p> <a href="sesiones01_1.php">Volver a la primera página</a></p>

</body>

</html>