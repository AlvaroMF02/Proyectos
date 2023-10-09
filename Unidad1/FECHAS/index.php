<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FECHAS</title>
</head>
<body>
    <h1>Fechas</h1>
    <?php
    
    // TIME (FECHA DE EL SERVER)
    echo "<p>".time()."</p>";    // DA LOS SEGUNDOS DE UNA FECHA

    // DATE()   CON FORMATO DIA MES AÑO MIN SEG 
    echo(date("d/m/y h:i:s"));
    
    // CHECK DATE   TRUE O FALSE SI ES VALIDA
    if(checkdate(6,14,2002)){
        echo "<p>Fecha buena</p>";
    }else{
        echo "<p>Fecha mala</p>";
    }

    // MKTIME   CUANTO TIEMPO HA PASADO
    //mktime(hora, min, seg, mes, dia, año)
    echo mktime(0,0,0,6,14,2002);

    echo "<p>".date("d,m,y",mktime(0,0,0,6,14,2002))."</p>";

    // STR TO TIME, PASA FECHA Y TE DA LOS SEGUNDOS
    echo strtotime("09/23/1978");

    // REDONDEAR
    echo "<p>";
    echo floor(6.5);
    echo "<br>";
    echo ceil(6.5);
    echo "</p>";

    printf("<p>%.2f</p>",2.45454);      // QUITAR DECIMALES

    $resul=sprintf("%.2f",2.45454);    // GENERA STRING

    for ($i=0; $i <= 20; $i++) { 
        /*
        if ($i <10) {
            echo "<p>0.".$i."</p>";
        }else{
            echo "<p>".$i."</p>";
        }*/
        echo "<p>".sprintf("%03d",$i)."</p>";
    }
    
    ?>
</body>
</html>