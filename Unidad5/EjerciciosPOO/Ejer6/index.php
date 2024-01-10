<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 POO</title>
</head>

<body>
    <h1>Ejercicio 6 POO</h1>

    <?php
    require "Menu.php";

    $menu = new Menu;
    $menu->cargar("Minecraft", "una URL");
    $menu->cargar("Marca", "una URL");
    $menu->cargar("Teclados", "una URL");

    echo "<h2>Menu en vertical</h2>";
    $menu->vertical();

    echo "<h2>Menu en horizontal</h2>";
    $menu->horizontal();

    ?>

</body>

</html>