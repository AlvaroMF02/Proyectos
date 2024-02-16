<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 14</title>
</head>
<body>

    <?php

    $estadios_futbol = array("Barcelona"=>"Camp Nou","Real Madrid"=>"Santiago Bernabeu","Valencia"=>"Mestalla","Real Sociedad"=>"Anoeta");

    // MOSTRAR EN UNA TABLA CON INDICE Y VALOR
    echo "<table>";
    foreach($estadios_futbol as $indice => $valor){
        echo "<tr>";
        echo "<td>".$indice."</td>";
        echo "<td>".$valor."</td>";
        echo "</tr>";
    }
    echo "</table>";

    // ELIMINA REAL MADRID  UNSET
    unset($estadios_futbol["Real Madrid"]);

    // MOSTRAR OTRA VEZ
    echo "<h3>Lista sin madrid</h3>";
    echo "<ol>";
    foreach($estadios_futbol as $indice => $valor){
        echo "<li>".$indice.": ".$valor."</li>";
    }
    echo "</ol>";

    ?>
    
</body>
</html>