<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 18</title>
</head>
<body>

    <?php

    $deportes[]="fútbol";
    $deportes[]="baloncesto";
    $deportes[]="natación";
    $deportes[]="tenis";

    foreach($deportes as $valor){
        echo "Valores: ".$valor."<br>";
    }
    echo "<p>Total: ".count($deportes)."</p>";

    echo "<p>Puntero en 1º elemento: ".current($deportes)."</p>";
    echo "<p>Puntero en laultima posicion: ".end($deportes)."</p>";
    echo "<p>Retroceder una posicion: ".prev($deportes)."</p>";
    ?>
    
</body>
</html>