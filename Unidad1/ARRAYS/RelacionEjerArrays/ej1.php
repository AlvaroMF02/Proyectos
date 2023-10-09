<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>

    <?php

    for ($i=0; $i < 10*2; $i+=2) { 
        $arr[] = $i;
        
    }
    for ($i=0; $i < count($arr); $i++) { 
        echo $arr[$i]. "</br>";
    }

    ?>
    
</body>
</html>