<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria Ficheros</title>
</head>
<body>
    <?php 
        // r,w,a read, write, append W y A CREAN
        //fopen("ruta","r")
    // fd1 es un puntero
    @$fd1 =fopen("prueba.txt","r+");    // r+ es para escribir tmb
    if (!$fd1) {
        die("No se ha podido abrir el fichero");
    }else{
        echo "Ha entrado";
        // AL ENTRAR ESTA APUNTANDO A LA PRIMERA LINEA DEL FICHERO

        echo "<h3>Manual</h3>";
        // RECOGE LA PRIMERA LINEA AL LEER
        $linea = fgets($fd1);
        echo "<p>" .$linea. "</p>";
        // CON OTRO FGET SIEGUE A LA SIGUIENTE LINEA
        $linea = fgets($fd1);
        echo "<p>" .$linea. "</p>";
        $linea = fgets($fd1);
        echo "<p>" .$linea. "</p>";
        $linea = fgets($fd1);
        echo "<p>" .$linea. "</p>";
        $linea = fgets($fd1);
        echo "<p>" .$linea. "</p>";

        // FINAL FICHERO DA FALSE(NO TIENE ASIGNACION)
        $linea = fgets($fd1);
        echo "<p>" .$linea. "</p>";

        // TE MANDA A LA POSIC 0
        fseek($fd1,0);
        echo "<h3>Con bucle</h3>";
        // MIENTRAS TENGA UNA ASIGNACION
        while ($linea = fgets($fd1)) {
            echo "<p>" .$linea. "</p>";
        }

        // ESCRIBIR PHP_EOL(salto de linea)
        fputs($fd1,PHP_EOL."Texto Escrito");
        

        // SIEMPRE CERRAR EL FICHERO
        fclose($fd1);

        echo "<h3>Texto leido directamente</h3>";
        // MOSTRAR TODO EL FICHERO EL ENTER ES COMO UN ESPACIO
        $todoFichero = file_get_contents("prueba.txt");
        echo $todoFichero;
        echo "<h3>Poner br en enter</h3>";
        echo nl2br($todoFichero);
        echo "<h3>Mostrarlo de otra forma</h3>";
        echo "<pre>".$todoFichero."</pre>";



        // LEER UNA WEB (TE TRAE EL HTML)
        file_get_contents("https://www.google.es");
        
    }
    ?>
</body>
</html>