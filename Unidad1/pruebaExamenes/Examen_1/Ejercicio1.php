<?php
// GENERAR LAS LETRAS
function arrayLetras($nLetra, $divi)
{
    $letraMayus = $nLetra;
    $letras[0] = chr($nLetra);
    for ($i = 0; $i <= 26; $i++) {
        if ($i == $divi) {
            $nLetra = 65;
            $letraMayus = $nLetra;
            $letras[$divi] = ";" . chr($letraMayus);
        } else {
            $letras[$i] = ";" . chr($letraMayus);
            $letraMayus++;
        }
    }
    return $letras;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Ejercicio 1 PHP</title>
    <meta charset="UTF-8" />
</head>

<body>
    <h1>Ejercicio 1 Generador de "claves_cesar.txt"</h1>
    <form method="post" action="Ejercicio1.php">
        <input type="submit" name="enviar" value="Generar" />
    </form>

    <?php
    if (isset($_POST["enviar"])) {



        @$fd = fopen("claves_cesar.txt", "w");

        if (!$fd) {
            echo "No se ha podido generar el archivo";
        } else {
            // PRIMERA LINEA
            $linea[0] = "Letra/Desplazamiento";
            fputs($fd, "Letra/Desplazamiento");
            for ($i = 1; $i <= 26; $i++) {
                $linea[$i] = ";" . $i;
                fputs($fd, ";" . $i);
            }

            fputs($fd, PHP_EOL);

            // LETRAS
            $divisor = 26;
            for ($i = 65; $i <= 90; $i++) {

                fputs($fd, implode(arrayLetras($i, $divisor)));
                fputs($fd, PHP_EOL);
                $divisor--;
            }

            echo "<h1>Respuesta</h1>";
            echo "<textarea></textarea>";
            echo "<p>Fichero generado con éxito</p>";

            fclose($fd);
        }
    }
    ?>
</body>