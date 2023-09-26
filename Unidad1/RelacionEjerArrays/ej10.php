<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10</title>
</head>
<body>

    <?php

    
    for ($i=0; $i < 10; $i++) { 
        $numeros[$i] = $i+1;
    }

    // CALCULAR MEDIA IMPARES
    $cantPares = 0;
    $suma = 0;
    for ($i=0; $i < count($numeros); $i++) { 
        if ($numeros[$i]%2==0) {
            $cantPares ++;
            $suma += $numeros[$i];
        }
    }
    $media = $suma/$cantPares;
    echo $media ."</br>";

    // MOSTRAR IMPARES
    for ($i=0; $i < count($numeros); $i++) { 
        if ($numeros[$i]%2!=0) {
            echo $numeros[$i];
        }
    }

    ?>
    
</body>
</html>