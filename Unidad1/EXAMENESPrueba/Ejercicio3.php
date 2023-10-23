<?php
if (isset($_POST["enviar"])) {
    $errorVacio = $_POST["texto"] == "";
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
                if(isset($_POST["enviar"]) && $errorVacio){
                    echo "* Campo vacio *";
                }
            ?>
        </p>
        <p>
            <select name="separadores" id="sep">
                <option value=",">,</option>
                <option value=".">.</option>
                <option value=";">;</option>
                <option value=":">:</option>
            </select>
        </p>
        <button type="submit" name="enviar">Calcular</button>
    </form>

    <?php 
    if(isset($_POST["enviar"]) && !$errorVacio){
        $palabras = [];
        $separadores = [];

        $cont = 0;
        while (isset($_POST["texto"][$cont])){

            if ($_POST["texto"][$cont] == $_POST["separador"]){
                $separadores.array_push($_POST["texto"][$cont]);
            }else{
                $palabras.array_push($_POST["texto"][$cont]);
            }

            $cont++;
        }
    }
    ?>
</body>
</html>