<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>

    <?php

    $datos["Nombre"] = "Pedro Torres";
    $datos["Direccion"] = "C/Mayor,37";
    $datos["Telefono"] = 123456789;

    foreach($datos as $indic => $info){
        echo $indic. ": " .$info."</br>";
    }
    ?>
    
</body>
</html>