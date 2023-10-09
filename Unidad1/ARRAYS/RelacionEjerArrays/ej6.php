<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>

    <?php

    $ciudades[] = "Madrid";
    $ciudades[] = "Barcelona";
    $ciudades[] = "Londres";
    $ciudades[] = "New York";
    $ciudades[] = "Los Angeles";
    $ciudades[] = "Chicago";

    foreach($ciudades as $indic => $info){
        echo "La ciudad con el indice ".$indic. " tienen el nombre " .$info."</br>";
    }
    ?>
    
</body>
</html>