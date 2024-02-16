<?php
// Valo primero del todo (Se crea en el navegador un espacio unico)
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tería sesiones</title>
</head>

<body>
    <h1>Tería sesiones</h1>
    <?php
    // Empezar a escribir cual es
    // Se crea una variable global
    if (!isset($_SESSION["nombre"])) {
        $_SESSION["nombre"] = "Álvaro";
        $_SESSION["clave"] = md5("1234");
    }


    ?>
    <p><a href="recibido.php">Ir a recibido</a></p>

    <form action="recibido.php" method="post">
        <button type="submit" name="btnBorrarSesion">Borrar datos sesion</button>
    </form>
</body>

</html>