<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 12</title>
</head>
<body>

    <?php

    $n = array("5"=>1,"12"=>2,"13"=>56,"x"=>123);

    foreach($n as $ind => $valor){
        echo "Indice: ".$ind. " Valor: ".$valor."</br>";
    }
    echo "Numero de elementos: ".count($n)."</br>";

    // ELIMINAR POSICION 5
    // ELIMINAR ARRAY

    ?>
    
</body>
</html>