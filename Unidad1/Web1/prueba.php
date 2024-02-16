<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>COSAS BASICAS IF SWITCH Y BUCLES A DIA <?php echo date("d-m-y") ?></h1>

    <!-- miau -->

    <?php
    // PHP DENTRO DEL BODY O DONDE TE SALGA

    echo "<p>VARIABLES</p>";
    //  VARIABLES CREADAS CON $ DELANTE
    $a = 8;
    $b = 9;

    // OPERADORES
    $c = $a + $b;

    // SACAR POR PANTALLA CONCATENANDO VARIABLES
    echo "<p>El resultado es " . $c . " al sumar " . $a . " + " . $b . "</p>";

    // CONSTANTE
    define("PI", 3.1415); // DESPUES SE USA PI SIN COMILLAS AL OPERAR

    // ESTRUCTURA IF        &&=si ||=sino !=negacion
    if (3 > $c) {
        echo "<p> 3 es mayor que " . $c . "</p>";
    } else if (3 == $c) {     // == PQ SI NO ESTARÍA ASIGNANDO
        echo "<p> 3 es igual a " . $c . "</p>";
    } else {
        echo "<p> 3 es menor que " . $c . "</p>";
    }
    // ESTRUCTURA IF

    // ESTRUCTURA SWITCH
    $d = 2;
    switch ($d) {
        case 1:
            $c = $a - $b;
            break;

        case 2:
            $c = $a / $b;
            break;

        case 3:
            $c = $a * $b;
            break;

        default:
            $c = $a + $b;
            break;
    }
    echo "<p>El resultado del switch es " . $c . "</p>";
    // ESTRUCTURA SWITCH


    // BUCLE FOR
    for ($i = 0; $i <= 8; $i++) {

        echo "<p>hola " . ($i + 1) . "</p>";
    }
    // BUCLE FOR

    // BUCLE WHILE
    $i = 0;
    while ($i <= 8) {

        echo "<p>hola " . ($i + 1) . "</p>";
        $i++;
    }
    // BUCLE WHILE

    ?>

    <h2> FORMULARIOS (Esto es html)</h2>

    <?php

    ?>
</body>

</html>