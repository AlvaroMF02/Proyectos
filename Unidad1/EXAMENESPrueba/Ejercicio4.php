<?php
if (isset($_POST["enviar"])) {

    // NO SE HA SELECCIONADO ARCHIVO
    $errorVacio = $_FILES["fichero"]["name"] == "";

    // SI TIENE UN ERROR DE ARCHIVO
    $errorArchivo = $_FILES["fichero"]["error"];

    // SI NO ES TXT
    $errorFormato = $_FILES["fichero"]["type"] != "text/plain";

    // SI SUPERA EL TAMAÑO
    $errorTaman = $_FILES["fichero"]["size"] > 1000 * 1024;

    $errorForm = $errorVacio || $errorArchivo ||  $errorFormato || $errorTaman;
}

function mi_strlen($texto){
    $cont=0;
    while (isset($texto[$cont])){
        $cont++;
    }
    return $cont;
}

function mi_explode($sep,$texto){
    $aux = [];

    $l_texto = mi_strlen($texto);

    $i = 0;

    // QUITAR SEPARADORES DEL PRINCIPIO ,,,,
    while ($i<$l_texto && $texto[$i]==$sep) {
        $i++;
    }
    // YA QUITADOS LOS DE ALANTE:
    if($i<$l_texto){
        $j = 0;
        // METE LA PRIMERA LETRA
        $aux[$j] = $texto[$i];
        // HASTA EL FINAL
        for ($i=$i+1; $i<$l_texto ; $i++) { 
            // SI NO ES SEPARADOR LO METE EN AUX
            if($texto[$i]!=$sep){
                $aux[$j] .=$texto[$i];
            }else{
                // HE ENCONTRADO UN SEPARADPOR
                // LOS QUITO OTRA VEZ
                while ($i<$l_texto && $texto[$i]==$sep) {
                    $i++;
                }
                // PARA LOS QUE SE REPITEN AL FINAL
                if($i<$l_texto){
                    $j++;
                    $aux[$j]=$texto[$i];
                }
            }
        }
    }
    return $aux;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <style>
        .error{
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 4</h1>
    <?php

    if(isset($_POST["enviar"]) && !$errorForm){
        @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Horario/horarios.txt");
        if(!$var){
            echo "<h3>No se ha podido mover a la carpeta destino</h3>";
        }
    }

    @$fd =fopen("Horario/horarios.txt","r");

    if($fd){
        echo "<h2>Horario de los profesores</h2>";

        $options ="";
        while($linea = fgets($fd)){
            // GUARDO LOS DE LA PRIMERA COLUMNA
            $datos_linea = mi_explode("\t",$linea);

            $profesores[]=$datos_linea[0];

            if(isset($_POST["enviar"]) && $_POST["profesores"] == $datos_linea[0]){
                $options.= "<option selected value='".$datos_linea[0]."'>".$datos_linea[0]."</option>";
                $datos_prof_selec=$datos_linea;
            }else{
                $options.= "<option value='".$datos_linea[0]."'>".$datos_linea[0]."</option>";
            }
            
        }
        fclose($fd);
        ?>
        <form action="Ejercicio4.php" method="post">

        <p>
            <label for="profesor">Horario del profesor</label>
            <select name="profesor" id="profesor">
                <?php
                echo $options;
                ?>
            </select>
            <button name="enviarHorario" type="submit">Ver horario</button>
        </p>
        </form>


        <?php
        if (isset($_POST["enviarHorario"])) {
            echo "<h3>Horario del profesor:".$datos_prof_selec[0]."</h3>";
        }
        
    }else{
        ?>
        <h2>No se encuentra el archivo <em>Horario/horarios.txt</em></h2>
        <form action="Ejercicio4.php" method="POST" enctype="multipart/form-data">
        <p>
            <label for="fich">Seleccione un archivo de texto (MAX. 1MB)</label>
            <input type="file" name="fichero" id="fich">
            <?php
            if (isset($_POST["enviar"]) && $errorForm) {
                if ($errorVacio) {
                    echo "<span class=error>**</span>";
                } else if ($errorArchivo) {
                    echo "<span class=error>* No se ha podido subir el archivo *</span>";
                } else if ($errorFormato) {
                    echo "<span class=error>* El formato debe ser .txt *</span>";
                } else {
                    echo "<span class=error>* El tamaño es superior *</span>";
                }
            }
            ?>
        </p>
        <button type="submit" name="enviar">Enviar</button>

    </form>
        <?php
    }
    ?>
</body>

</html>