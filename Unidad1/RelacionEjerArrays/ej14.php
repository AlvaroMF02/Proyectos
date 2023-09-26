<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 12</title>
</head>
<body>

    <?php

    
    $estadios_futbol = array("Barcelona"=>"Camp Nou","Real Madrid"=>"Santiago Bernabeu","Valencia"=>"Mestalla","Real Sociedad"=>"Anoeta");

    // MOSTRAR EN UNA TABLA CON INDICE Y VALOR
    echo "<table>";
    foreach($estadios_futbol as $indice => $valor){
        echo "<tr>";
        echo "<td>".$indice."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>".$valor."</td>";
        echo "</tr>";
    }
    echo "</table>";
    // ELIMINA REAL MADRID
    // MOSTRAR OTRA VEZ

    ?>
    
</body>
</html>