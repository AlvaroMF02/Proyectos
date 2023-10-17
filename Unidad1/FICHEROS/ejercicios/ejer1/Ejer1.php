<?php
if (isset($_POST["enviar"])) {
    // IMPORTA EL ORDEN, NO ESTA VACIO, ES UN NUMERO Y ESTA ENTRE 1 Y 10
    $errorForm = $_POST["numero"] == "" || !is_numeric($_POST["numero"]) || $_POST["numero"] <= 0 || $_POST["numero"] > 10;
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<style>
    .error {
        color: red;
    }
</style>

<body>
    <form action="Ejer1.php" method="post">
        <h1>Ejercicio 1</h1>
        <p>
            <label for="num">Introduzca un numero del 1 al 10</label><br>
            <input type="text" name="numero" id="num" value="<?php if (isset($_POST["numero"])) echo $_POST["numero"] ?>">
            <?php
            if (isset($_POST["enviar"]) && $errorForm) {
                if ($_POST["numero"] == "") {
                    echo "<span>* Campo vacio *</span>";
                } else {
                    echo "<span>* No has introducido un número *</span>";
                }
            }
            ?>
        </p>
        <p>
            <button type="submit" name="enviar">Generar tablas</button>
        </p>


    </form>

    <?php
    if (isset($_POST["enviar"]) && !$errorForm) {
        $nombreFic = "tabla_".$_POST["numero"].".txt";

        if (!file_exists("Tablas/".$nombreFic)) {
            $fd=fopen("Tablas/".$nombreFic,"w");
        if(!$fd){
            die ("<p>No se ha podido crear el fichero Tablas/".$nombreFic."</p>");
        }
        for ($i=0; $i <=10; $i++) { 
            fputs($fd,$i." x ".$_POST["numero"]. " = " . $i*$_POST["numero"].PHP_EOL);
        }
        fclose($fd);
        echo "<p>Fichero generado con exito </p>";
        }else{
            echo "<p>El fichero ya existe </p>";
        }

        
    }
    ?>
</body>

</html>