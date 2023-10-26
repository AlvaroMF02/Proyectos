<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 15</title>
</head>
<body>

    <?php

    $numeros = array("n1"=>3,"n2"=>2,"n4"=>8,"n5"=>123,"n6"=>5,"n7"=>1);
    array_multisort($numeros);

    foreach($numeros as $ind => $valor){
        echo "Indice: ".$ind. " Valor: ".$valor."</br>";
    }

    ?>
    
</body>
</html>