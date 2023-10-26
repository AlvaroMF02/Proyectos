<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEORIA</title>
</head>
<body>
    <?php
    $str1 ="Hola";
    $str2 ="Juan";

    // CONCATENAR Y COSITAS
    echo "<h1>".$str1." ".$str2."</h1>";

    // FUNCIONES STRING
    // CALCULAR LA LONGITUD
    $longitud = strlen($str2);
    echo "<p>La longitud de ".$str2." es ".$longitud."</p>";

    // ACCEDER A LA POSICION DEL STRING COMO UN ARRAY
    $a = $str1[3];
    echo "<p>La posicion 3 de  ".$str1." es ".$a."</p>";

    $str1[1] = "a";
    echo "<p>Sobreescribir posicion 3 ".$str1."</p>";

    // PONER A MAYUSCULAS O MINUSCULAS
    echo "<p>".strtoupper($str1)."</p>";
    echo "<p>".strtolower($str1)."</p>";

    // LIMPIAR ESPACIOS EN BLANCO DELANTE Y DETRAS
    $pruebaEspacios= "    MIAU    ";
    echo "<p>Con espacios".$pruebaEspacios."</p>";
    echo "<p>Sin espacios".trim($pruebaEspacios)."</p>";

    // DIVIDIR STRING COMO EL SPLIT, DIVIDE POR LO QUE DIGAS
    $prueba = "Hola mi nombre es alvaro";
    $separa = explode(" ",$prueba);
    print_r($separa);

    $archivo = "miau.jpg";
    $extension = explode(".",$archivo);
    echo "<p>Extension leida ".end($extension)."</p>";
    
    // CONVERTIR ARRAY EN STRING, SE DIVIDE POR LO Q PONGAS
    $array = array("hola","soy","gil");
    print_r($array);
    $string = implode(":",$array);
    echo "<p>".$string."</p>";

    // SUBSTRING LEER DE X A Y TMB SE PUEDE HACER CON UNA VARIABLE
    // CON SOLO UN PARAMETRO LLEGA HASTA EL FINAL DESDE EL DADO
    // EN NEGATIVO LO MANDA PARA ATRAS
    echo "<p>".substr("hola que tal",0,5)."</p>";


    ?>
</body>
</html>