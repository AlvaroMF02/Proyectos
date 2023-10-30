<?php
if (isset($_POST["enviar"])) {
    $errorTexto = $_POST["texto"] == "";
}
function mi_explode($sep,$texto){
    $respuesta = [];
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
        $respuesta[$j] = $texto[$i];
        // HASTA EL FINAL
        for ($i=$i+1; $i<$l_texto ; $i++) { 
            // SI NO ES SEPARADOR LO METE EN AUX
            if($texto[$i]!=$sep){
                $respuesta[$j] .=$texto[$i];
            }else{
                // HE ENCONTRADO UN SEPARADPOR
                // LOS QUITO OTRA VEZ
                while ($i<$l_texto && $texto[$i]==$sep) {
                    $i++;
                }
                // PARA LOS QUE SE REPITEN AL FINAL
                if($i<$l_texto){
                    $j++;
                    $respuesta[$j]=$texto[$i];
                }
            }
        }
    }
    return $respuesta;
}
function tiene_vocales($texto){
    $vocales["a"]=1;
    $vocales["e"]=1;
    $vocales["i"]=1;
    $vocales["o"]=1;
    $vocales["u"]=1;
    $vocales["A"]=1;
    $vocales["E"]=1;
    $vocales["I"]=1;
    $vocales["O"]=1;
    $vocales["U"]=1;

    for ($i=0; $i < strlen($texto); $i++) { 
        if(isset($vocales[$texto[$i]])){
            $tiene =true;
        }
    }

    return $tiene;
}
function filtrar_sin_vocales($arr_palabra) {
    $respuesta=[];
    for ($i=0; $i < count($arr_palabra) ; $i++) { 
        // FALTA TODO :)
        if(!tiene_vocales($arr_palabra[$i])){
            $respuesta[]=$arr_palabra[$i];
        }
    }
    return $respuesta;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio2. Contar Palabras sin vocales (a,e,i,o,u, A,E,I,O,U)</h1>
    <form action="Ejercicio2.php" method="post">
        <p>
            <label for="texto">Introduzca un Texto</label>
            <input type="text" name="texto" id="texto">
            <?php
            if (isset($_POST["enviar"]) && $errorTexto) {
                echo "<span class= error>* Campo requerido *</span>";
            }
            ?>
        </p>

        <p>
            <label for="sep">Elije el Separador</label>
            <select name="separador" id="sep">
                <option value="," <?php if (isset($_POST["enviar"]) && $_POST["separador"] == ",") echo "selected" ?>>Coma</option>
                <option value="." <?php if (isset($_POST["enviar"]) && $_POST["separador"] == ".") echo "selected" ?>>Punto</option>
                <option value=";" <?php if (isset($_POST["enviar"]) && $_POST["separador"] == ";") echo "selected" ?>>Punto y coma</option>
                <option value=":" <?php if (isset($_POST["enviar"]) && $_POST["separador"] == ":") echo "selected" ?>>Dos puntos</option>
                <option value=" " <?php if (isset($_POST["enviar"]) && $_POST["separador"] == " ") echo "selected" ?>>Espacio</option>
            </select>
        </p>

        <button name="enviar" type="submit">Contar</button>
    </form>

    <?php
    if (isset($_POST["enviar"]) && !$errorTexto) {
        echo "<h1>Respuesta</h1>";
        echo "El texto " . $_POST["texto"] . " con el separador '" . $_POST["separador"] . "' contiene palabras sin las vocales.";
    }
    ?>

</body>
</html>