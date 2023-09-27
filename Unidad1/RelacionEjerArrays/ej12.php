<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 12</title>
</head>
<body>

    <?php

    echo "Meter arrays en un array con array_push(): <br>";
    $animales = array("Lagartija","Araña","Perro","Gato","Ratón");
    $numeros = array("12","34","52","12");
    $arboles = array("Sauce","Pino","Naranjo","Chopo","Perro","34");

    $array = array();

    for ($i=0; $i < count($animales); $i++) { 
        array_push($array,$animales[$i]);
    }
    
    for ($i=0; $i < count($numeros); $i++) { 
        array_push($array,$numeros[$i]);
    }

    for ($i=0; $i < count($arboles); $i++) { 
        array_push($array,$arboles[$i]);
    }

    print_r($array);

    ?>
    
</body>
</html>