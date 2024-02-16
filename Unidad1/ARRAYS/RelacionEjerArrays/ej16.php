<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 16</title>
</head>
<body>

    <?php

    echo "Mostrar array:<br>";
    $n = array("5"=>1,"12"=>2,"13"=>56,"x"=>123);

    foreach($n as $ind => $valor){
        echo "Indice: ".$ind. " Valor: ".$valor."</br>";
    }
    echo "Numero de elementos: ".count($n)."</br>";

    echo "<br>Eliminar posicion 5:<br>";
    // ELIMINAR POSICION 5
    unset($n["5"]);
    foreach($n as $ind => $valor){
        echo "Indice: ".$ind. " Valor: ".$valor."</br>";
    }

    // ELIMINAR ARRAY
    echo "<br>Array eliminado:<br>";
    unset($n);
    ?>
    
</body>
</html>