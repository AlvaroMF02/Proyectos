<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Normal</title>
    <style>
        .enlace{background: none;border: none; text-decoration: underline; color: blue;cursor: pointer;}
        .enLinea{display: inline;}
    </style>
</head>

<body>
    <h1>Login normal</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log->usuario ?></strong>
        <form class="enLinea" action="index.php" method="post"><button type="submit" class="enlace" name="btnSalir">Salir</button></form>
    </div>
</body>

</html>