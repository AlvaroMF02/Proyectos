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
    echo "<p>Total: ".count($deportes)."</p>"

    ?>
    
</body>
</html>