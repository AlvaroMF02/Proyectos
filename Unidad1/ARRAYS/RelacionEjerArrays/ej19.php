<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 19</title>
</head>

<body>

    <?php
    $array["Madrid"]["Pedro"]["Edad"] = "32";
    $array["Madrid"]["Pedro"]["TLF"] = "91-9999999";
    $array["Madrid"]["Antonio"]["Edad"] = "32";
    $array["Madrid"]["Antonio"]["TLF"] = "00-9900999";
    $array["Madrid"]["Alguien"]["Edad"] = "32";
    $array["Madrid"]["Alguien"]["TLF"] = "00-9900999";
    $array["Barcelona"]["Susana"]["Edad"] = "34";
    $array["Barcelona"]["Susana"]["TLF"] = "93-0000000";
    $array["Toledo"]["Nombre"]["Edad"] = "42";
    $array["Toledo"]["Nombre"]["TLF"] = "9525954548";
    $array["Toledo"]["Nombre2"]["Edad"] = "43";
    $array["Toledo"]["Nombre2"]["TLF"] = "9521235548";
    $array["Toledo"]["Nombre3"]["Edad"] = "41";
    $array["Toledo"]["Nombre3"]["TLF"] = "9525004548";

    foreach ($array as $ciudad => $personas) {
        echo "<p>Amigos en " . $ciudad . ":</p>";
        echo "<ol>";
        foreach ($personas as $nombre => $datos) {
            echo "<li>Nombre: " . $nombre . ". Edad: " . $datos["Edad"] . ". Telefono: " . $datos["TLF"] . ":</li>";
        }
        echo "</ol>";
    }

    ?>

</body>

</html>