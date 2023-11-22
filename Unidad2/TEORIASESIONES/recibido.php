<?php
session_start();

if (isset($_POST["btnBorrarSesion"])) {
    // Los borra pero los muestra una vez
    // session_destroy();
    session_unset();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recibido</title>
</head>

<body>
    <h1>Teoría sesiones recbido</h1>
    <?php
    if (isset($_SESSION["nombre"])) {
        echo "Se han recibido los siguientes datos: <br>";
        echo "<strong>Nombre: </strong>" . $_SESSION["nombre"];
        echo "<br>";
        echo "<strong>Clave: </strong>" . $_SESSION["clave"];
    }else{
        echo "<p>Se han borrado los valores de sesion</p>";
    }
    ?>
    <p><a href="index.php">Volver</a></p>

</body>

</html>