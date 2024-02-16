<?php
session_name("ejer_3_23_24");
session_start();
// si no existe la sesion numero, sesion numero = 0
if (!isset($_SESSION["numero"])) {
    $_SESSION["numero"] = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones 3</title>
    <style>
        .textCentrado {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="textCentrado">SUBIR Y BAJAR NÚMEROS</h1>
    <p>Haga click en los botones hará modificar el valor:</p>

    <form action="sesiones3-2.php" method="post">

        <p>
            <button type="submit" name="boton" value="menos">-</button>
            <!-- El numero que se ve es la sesion -->
            <?php echo $_SESSION["numero"]; ?>
            <button type="submit" name="boton" value="mas">+</button>
        </p>

        <button type="submit" name="boton" value="aCero">Poner a cero</button>

    </form>
</body>

</html>