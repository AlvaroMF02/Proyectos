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

    <?php                                                           // MAL HECHO
    if (isset($_POST["enviar"])) {

        @$fd = fopen("claves_cesar.txt", "w");

        if (!$fd) {
            die("No se ha podido generar el archivo");
        } else {
            // PRIMERA LINEA
            $primera_linea = "Letra/Desplazamiento";
            for ($i = 1; $i <= 26; $i++) {
                $primera_linea .= ";".$i;
            }
            fwrite($fd, $primera_linea.PHP_EOL);


            // LETRAS
            for($i=ord("A");$i<=ord("Z");$i++){
                $linea = chr($i);
                for ($j = 1; $j <= ord("Z")-ord("A")+1; $j++) {
                    if($i+$j<=ord("Z")){
                        $linea .=";".chr($i+$j);
                    }else{
                        $me_paso = ($i+$j)-ord("Z");
                        $linea .=";".chr(ord("A")+($i+$j)-ord("Z")-1);
                    }
                    fwrite($fd, $linea.PHP_EOL);
                }
            }
            

            fclose($fd);

            echo "<h1>Respuesta</h1>";
            echo "<textarea>".file_get_contents('claves_cesar.txt')."</textarea>";
            echo "<p>Fichero generado con éxito</p>";

            
        }
    }
    ?>
</body>
</html>