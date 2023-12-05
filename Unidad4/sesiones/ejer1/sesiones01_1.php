<?php
session_name("ejer_01_23_24");
session_start();
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
    <h1 class="textCentrado">FORMULARIO NOMBRE 1 (FORMULARIO)</h1>
    <?php
    if (isset($_SESSION["nombre"])) {
        echo "<p>Su nombre es:<strong>" . $_SESSION["nombre"] . "</strong></p>";
    }
    ?>
    <p>Escriba su nombre:</p>

    <form action="sesiones01_2.php" method="post">

    <p>
        <label for="nombre"><strong>Nombre</strong></label>
        <input type="text" id="nombre" name="nombre"><br>
    </p>

    <button type="submit" name="btnSig">Siguiente</button>
    <button type="submit" name="btnBorrar">Borrar</button>

    </form>
</body>

</html>