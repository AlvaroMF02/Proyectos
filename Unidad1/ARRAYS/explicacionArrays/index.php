<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria array</title>
</head>

<body>
    <?php
    $nota2[0] = 5;
    $nota2[1] = 9;
    $nota2[2] = 8;
    $nota2[3] = 5;
    $nota2[4] = 6;
    $nota2[5] = 7;

    // RECORRER ARRAY
    echo "<h2>RECORRIDO DE UN ARRAY CON SUS INDICES CORRELATIVOS</h2>";

    for ($i = 0; $i < count($nota2); $i++) {
        echo "En la posición " . $i . " tiene el valor: " . $nota2[$i] . "</br>";
    }

    // FORMA RAPIDA
    print_r($nota2);
    echo "</br>";

    // LO HACE CON CUALQUIER TIPO DE VARIABLE Y DA MAS INFO
    var_dump($nota2);

    // SE PUEDEN GUARDAR DIFERENTES VARIABLES
    $valor2[0] = 10;
    $valor2[1] = "hola";
    $valor2[2] = true;
    $valor2[3] = 3.4;

    echo "</br>";
    var_dump($valor2);

    // TMB VA SI NO PONES EL INDICE
    // SE PUEDE PONER UN INDICE RANDOM Y EL TRUE ESTARIA EN LA POSICION 4
    // SE SALTA LA 1 Y LA 2
    $valor[] = 10;
    $valor[99] = "hola";
    $valor[] = true;    // TRUE=1, FALSE=NO LO ESCRIBE
    $valor[200] = 3.4;
    echo "</br>";
    var_dump($valor);


    // RECORRER ARRAY NO CORRELATIVO, SE PUEDE PONER SIN $indice =>
    echo "<h2>RECORRIDO DE UN ARRAY CON SUS INDICES NO CORRELATIVOS</h2>";
    foreach ($valor as $indice => $contenido) {
        //echo "Contenido: " . $contenido . "</br>";
        echo "En la posición " . $indice . " tiene el valor: " . $contenido . "</br>";
    }

    // OTRA FORMA DE DECLARAR ARRAYS
    // TMB SE PUEDE PONER $nota = array(0=>5,9,100=>8,5,6,7); SE PUEDEN CAMBIAR LOS VALORES POR STRING BOOL O LO Q SEA
    $nota = array(0,5,9,8,5,6,7);

    // ASOCIATIVOS
    echo "<h2>ARRAY ASOCIATIVO</h2>";
    $persona ["Antonio"] = 5;
    $persona ["Luis"] = 9;
    $persona ["Ana"] = 8;
    $persona ["Eloy"] = 5;
    $persona ["Gabriela"] = 6;
    $persona ["Berta"] = 7;

    echo "<h3>Notas de la asignatura:</h3>";
    foreach($persona as $nombre => $notas){
        echo $nombre." ha sacado un: " .$notas. "</br>";
    }

    // BIDIMENSIONAL
    $personaComp ["Antonio"] ["DWESE"]= 5;
    $personaComp ["Antonio"] ["DWCE"]= 6;
    $personaComp ["Luis"] ["DWESE"]= 9;
    $personaComp ["Luis"] ["DWCE"]= 5;
    $personaComp ["Ana"] ["DWESE"]= 8;
    $personaComp ["Ana"] ["DWCE"]= 2;
    $personaComp ["Eloy"] ["DWESE"]= 5;
    $personaComp ["Eloy"] ["DWCE"]= 8;
    $personaComp ["Gabriela"] ["DWESE"]= 6;
    $personaComp ["Gabriela"] ["DWCE"]= 5;
    $personaComp ["Berta"] ["DWESE"]= 7;
    $personaComp ["Berta"] ["DWCE"]= 7;

    echo "<h3>Nota de los alumnos:</h3>";

    // RECORRER ARRAY BIDIMENSIONAL ASOCIATIVO
    foreach ($personaComp as $nombre => $nota) {
        echo "<p>".$nombre;
        echo "<ul>";
        foreach($personaComp[$nombre] as $asignatura => $notaAsig){
            echo "<li><b>".$asignatura ."</b>->".$notaAsig."</li>";
        }
        
        echo "</ul>";
        echo "</p>";
    }

    // LEER ELEMENTOS || MOVERSE POR ARRAY
    echo "<h3>LEER ELEMENTOS:</h3>";
    $capital=array("Castilla y León"=>"Valladolid","Asturias"=>"Oviedo","Aragón"=>"Zaragoza");
    echo "<p>Primero: ".current($capital)."</p>"; // MUESTRA EL PUNTERO, AL ESTAR 1º MUESTRA VALLADOLID
    echo "<p>Primero Key: ".key($capital)."</p>"; // EL INDICE
    echo "<p>Ultimo valor de un array:".end($capital)."</p>"; // VA AL ULTIMO
    echo "<p>Ultimo: ".current($capital)."</p>"; // MUESTRA EL PUNTERO, AL ESTAR EL ULTIMO ENSEÑA ZARAGOZA
    echo "<p>Ultimo Indice: ".key($capital)."</p>"; // EL INDICE
    reset($capital); // HACE UN RESET
    echo "<p>Reset: ".current($capital)."</p>"; // MUESTRA EL PUNTERO, AL ESTAR 1º MUESTRA VALLADOLID
    echo "<p>Reset: Indice".key($capital)."</p>"; // EL INDICE
    next($capital); // PARA ALANTE
    echo "<p>Next: ".current($capital)."</p>"; // MUESTRA EL PUNTERO, AL ESTAR 1º MUESTRA VALLADOLID
    echo "<p>Next Indice: ".key($capital)."</p>"; // EL INDICE
    prev($capital); // PARA ATRAS SI ESTAS AL PRINCIPIO SE QUEDA VACIO


    ?>
</body>

</html>