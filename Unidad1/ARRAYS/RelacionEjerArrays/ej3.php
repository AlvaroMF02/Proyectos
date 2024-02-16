<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>

    <?php

    $meses["enero"] = 9;
    $meses["fecbrero"] = 12;
    $meses["marzo"] = 0;
    $meses["abril"] = 17;

    foreach($meses as $mes => $numPelis){
        echo "En el mes ".$mes. " se han visto " .$numPelis."</br>";
    }

    ?>
    
</body>
</html>