<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recibido</title>
</head>

<body>
    <h1>Tería sesiones recbido</h1>
    <?php
    echo "Se han recibido los siguientes datos: <br>";
    echo "<strong>Nombre: </strong>".$_SESSION["nombre"];
    echo "<br>";
    echo "<strong>Clave: </strong>".$_SESSION["clave"];
    
    ?>
</body>

</html>