<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
    <style>
        table,tr,td{border:1px solid black;border-collapse: collapse;}
    </style>
</head>
<body>

    <?php

    $lenguajes_cliente["LC1"] = "PHP";
    $lenguajes_cliente["LC2"] = "MYSQL";
    $lenguajes_servidor["LS1"] = "JavaScript";
    $lenguajes_servidor["LS2"] = "Java";

    // METER ARRAY EN OTRO
    $lenguajes = $lenguajes_cliente;

    // AL TENER INDICE ASOCIATIVO SE PUEDE METER TAL CUAL
    foreach($lenguajes_servidor as $leng => $de){
        $lenguajes[$leng]=$de;
    }

    // TABLA
    echo "Lenguajes";
    echo "<table>";
    foreach($lenguajes as $valor){
        echo "<tr><td>".$valor."</td></tr>";
    }
    echo "</table>";


    ?>
    
</body>
</html>