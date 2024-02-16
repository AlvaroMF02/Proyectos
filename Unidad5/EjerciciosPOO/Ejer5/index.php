<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 POO</title>
</head>

<body>
    <h1>Ejercicio 5 POO</h1>

    <?php
    require "Empleado.php";

    echo "<h2>Mostrar a un empleado</h2>";

    $empleado = new Empleado("Álvaro", 4000);

    $empleado->datos();

    ?>

</body>

</html>