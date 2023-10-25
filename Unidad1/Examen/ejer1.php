<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer 1</title>
</head>

<body>

    <h1>Ejercicio 1. Generador de "claves_polybios.txt"</h1>
    <form action="ejer1.php" method="post">
        <p><button type="submit" name="enviar">Generar</button></p>
    </form>

    <?php
    if (isset($_POST["enviar"])) {

        @$fd = fopen("claves_polybios.txt", "w");
        if (!$fd) {
            die("No se ha podido crear el fichero");
        } else {

            //fputs($fd,PHP_EOL."Texto Escrito");



            for ($i = 1; $i < 6; $i++) {
                fputs($fd, PHP_EOL . $i);
                for ($j = 1; $j < 6; $j++) {
                    fputs($fd, "#");
                }
            }

            $matri[0][0] = "i/j";
            for ($i = 1; $i < 6; $i++) {
                $matri[$i] = $i;
                for ($j = 1; $j < 5; $j++) {
                    $matri[$i][$j] = 2;
                }
            }
            print_r($matri);
           echo count($matri);
            

            echo "<textarea name='sol'></textarea>";
            echo "<p>fichero generado con éxito</p>";
        }
    }
    ?>


</body>

</html>