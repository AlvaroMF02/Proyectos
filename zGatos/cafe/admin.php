<?php
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
    </style>
    <title>Vista Admin</title>
</head>

<body>
    <h1>Vista Administrador</h1>
    <p>Bienvenido <?php echo $_SESSION["usuario"] ?>
    <form class="enlinea" action="index.php" method="post"><button class="enlace" name="btnSalir">Salir</button></form>
    </p>
</body>

</html>