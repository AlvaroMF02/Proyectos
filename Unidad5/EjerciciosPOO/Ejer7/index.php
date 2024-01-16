<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7 POO</title>
</head>

<body>
    <h1>Ejercicio 7 POO</h1>

    <?php
    require "Pelicula.php";

    $peli = new Pelicula("Avatar",2019,"Tarantino",true,20,date("d,m,y",mktime(0,0,0,1,10,2024)));

    $peli->nombrePelicula();
    echo "<br>";
    
    $peli->AnioYDirector();
    echo "<br>";

    $peli->precio();
    echo "<br>";

    $peli->estadoAlquiler();
    echo "<br>";

    $peli->fechaParaLaDevolucion();
    echo "<br>";

    $peli->multa();
    ?>

</body>

</html>