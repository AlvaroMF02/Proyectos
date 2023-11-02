<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1º CRUD</title>
</head>
<body>
    <h1>Listado de los usuarios</h1>

    <?php
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die("<p>No se ha podido conectar a la base de datos:" . $e->getMessage() . "</p></body></html>");
    }

    mysqli_close($conexion);
    ?>
</body>
</html>