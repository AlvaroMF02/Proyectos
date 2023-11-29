<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eaxmen</title>
</head>

<body>
    <h1>Examen2 PHP</h1>
    <h2>Horario de los profesores</h2>
    <?php

    // conexion
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_horarios_exam");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        echo "no se ha podido hacer la conexion";
    }

    // consulta select
    $consulta = "select * from usuarios";
    $resultado = mysqli_query($conexion, $consulta);

    $usuario = mysqli_fetch_assoc($resultado);
    print_r($usuario);

    echo "Horario del Profesor:";
    echo "<select name='profesor'>";

    echo "<option>";


    echo "</option>";


    echo "</select>";
    ?>
</body>

</html>