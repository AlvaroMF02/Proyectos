<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>

    <?php

    $ciudades["MD"] = "Madrid";
    $ciudades["BC"] = "Barcelona";
    $ciudades["LD"] = "Londres";
    $ciudades["NY"] = "New York";
    $ciudades["LA"] = "Los Angeles";
    $ciudades["CC"] = "Chicago";

    foreach($ciudades as $indic => $info){
        echo "El indice del array que contiene como valor ".$info. " es " .$indic."</br>";
    }
    ?>
    
</body>
</html>