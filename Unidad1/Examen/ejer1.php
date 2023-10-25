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
    if(isset($_POST["enviar"])){

        @$fd = fopen("polibios.txt","w");
        if (!$fd) {
            die ("No se ha podido crear el fichero");
        }else{

            //fputs($fd,PHP_EOL."Texto Escrito");

            $matri [0] [0] = 0;
            $matri [1] [0] = 0;

            for ($i=0; $i < 6; $i++) { 
                fputs($fd,PHP_EOL."#");
                for ($j=0; $j < 6; $j++) { 
                    fputs($fd,"#");
                }
            }

            echo "<textarea name='sol'></textarea>";
            echo "<p>fichero generado con éxito</p>";
        }


        
    }
    ?>
    

</body>
</html>