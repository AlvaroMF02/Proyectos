<?php
if (isset($_POST["enviar"])) {
    $errorVacio = $_POST["palabra"] == "";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <form action="Ejercicio1.php" method="post">

        <p>
            <label for="palab">Escribe una palabra</label>
            <input type="text" name="palabra" id="palab" value="<?php if(isset($_POST["palabra"])) echo $_POST["palabra"]?>">
            <?php
            if (isset($_POST["enviar"]) && $errorVacio) {
                echo "Campo vacio";
            }

            ?>
        </p>
        <button type="submit" name="enviar">Contar</button>

    </form>

    <?php
    if (isset($_POST["enviar"]) && !$errorVacio) {
        
        echo count($_POST["palabra"]);
    }

    ?>
</body>

</html>