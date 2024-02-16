<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
</head>
<body>

    <?php

    $nombres[] = "Pedro";
    $nombres[] = "Ismael";
    $nombres[] = "Sonia";
    $nombres[] = "Clara";
    $nombres[] = "Susana";
    $nombres[] = "Alfonso";
    $nombres[] = "Teresa";

    echo "Contiene ".count($nombres). " elementos </br>";

    foreach($nombres as $info){
        echo $info."</br>";
    }
    ?>
    
</body>
</html>