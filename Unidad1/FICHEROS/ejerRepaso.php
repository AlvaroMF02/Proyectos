<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="pruebExamen.php" method="post">

        <p>
            <label for="palab">Escribe una palabra</label>
            <input type="text" name="palabra" id="palab">
        </p>
        <button type="submit" name="enviar">Contar</button>

    </form>

    <?php
    if (isset($_POST["enviar"])) {
        $repe = false;

        for ($i = 0; $i < strlen($_POST["palabra"]); $i++) {
            for ($j = $i + 1; $j < strlen($_POST["palabra"]); $j++) {

                if ($_POST["palabra"][$i] == $_POST["palabra"][$j]) {
                    $repe = true;
                }
            }
        }
        if ($repe) {
            echo "<p>Se repite</p>";
        } else {
            echo "<p>No se repite</p>";
        }
    }

    ?>
</body>

</html>