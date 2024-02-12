<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .enlace{
            background:none;
            border:none;
            text-decoration: underline;
            color: blue;
            cursor: pointer;
        }
        .fila{
            display: inline;
        }
    </style>
    <title>Admin</title>
</head>
<body>
    <h1>Vista Admin</h1>
    <?php
    echo "Bienvenido a la página: ".$datos_usuario_log->usuario."<form action='index.php' method='post' class='fila'><button class='enlace' name='btnSalir'>Salir</button></form>";
    ?>
</body>
</html>