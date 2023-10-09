<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 11</title>
</head>
<body>

    <?php

    echo "Meter arrays en un array con array_merge(): <br>";
    $animales = array("Lagartija","Araña","Perro","Gato","Ratón");
    $numeros = array("12","34","52","12");
    $arboles = array("Sauce","Pino","Naranjo","Chopo","Perro","34");

    $array = array_merge($animales,$numeros,$arboles);

    print_r($array);

    ?>
    
</body>
</html>