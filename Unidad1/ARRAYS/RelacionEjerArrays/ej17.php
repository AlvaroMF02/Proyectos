<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 17</title>
</head>
<body>

    <?php

    $familias["Los Simpson"]["Padre"]="Homer";
    $familias["Los Simpson"]["Madre"]="Marge";
    $familias["Los Simpson"]["Hijos"]["Hijo1"]="Bart";
    $familias["Los Simpson"]["Hijos"]["Hijo2"]="Lisa";
    $familias["Los Simpson"]["Hijos"]["Hijo3"]="Maggie";
    $familias["Los Griffin"]["Padre"]="Peter";
    $familias["Los Griffin"]["Madre"]="Lois";
    $familias["Los Griffin"]["Hijos"]["Hijo1"]="Chris";
    $familias["Los Griffin"]["Hijos"]["Hijo2"]="Meg";
    $familias["Los Griffin"]["Hijos"]["Hijo3"]="Stewie";

    foreach($familias as $familia =>$grado){
        echo "<ul>";
        echo "<li>".$familia;
        echo "<ul>";
        foreach($familias[$familia] as $grad => $nombre){
            if ($grad != "Hijos") {
                echo "<li>".$grad.":".$nombre."</li>";
            }else{
                echo "<li>".$grad.":";
                echo "<ul>";
                foreach($familias[$familia][$grad] as $nHijo => $name){
                    echo "<li>".$nHijo.": ".$name."</li>";
                }
                echo "</ul>";
                echo "</li>";
            }
            
        }
        echo "</ul>";
        echo "</li>";//li familia
        echo "</ul>";
    }


    ?>
    
</body>
</html>