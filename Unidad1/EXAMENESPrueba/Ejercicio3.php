<?php
if (isset($_POST["enviar"])) {
    $errorVacio = $_POST["texto"] == "";
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
    <title>Ejercicio 3</title>
</head>

<body>
    <h1>Ejercicio 3</h1>
    <form action="Ejercicio3.php" method="post">
        <p>
            <label for="tex">Escriba texto</label>
            <input type="text" name="texto" id="tex">
            <?php
            if (isset($_POST["enviar"]) && $errorVacio) {
                echo "* Campo vacio *";
            }
            ?>
        </p>
        <p>
            <select name="separadores" id="sep">
                <option <?php if(isset($_POST["enviar"]) && $_POST["separadores"] == ",") echo "selected" ?> value=",">,</option>
                <option <?php if(isset($_POST["enviar"]) && $_POST["separadores"] == ".") echo "selected" ?> value=".">.</option>
                <option <?php if(isset($_POST["enviar"]) && $_POST["separadores"] == ";") echo "selected" ?> value=";">;</option>
                <option <?php if(isset($_POST["enviar"]) && $_POST["separadores"] == ":") echo "selected" ?> value=":">:</option>
                <option <?php if(isset($_POST["enviar"]) && $_POST["separadores"] == " ") echo "selected" ?> value=" ">(espacio)</option>
            </select>
        </p>
        <button type="submit" name="enviar">Calcular</button>
    </form>

    <?php
    if (isset($_POST["enviar"]) && !$errorVacio) {

        echo "<h2>Respuesta</h2>";

        // METODO CREADO MANUAL

        echo "El número de palábras separadas es de: ".count(mi_explode($_POST["separadores"],$_POST["texto"]));
    }
    ?>
</body>

</html>