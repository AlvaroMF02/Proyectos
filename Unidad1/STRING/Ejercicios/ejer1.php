<?php
$error_form = false;

if (isset($_POST["enviar"])) {

    $texto1 = trim($_POST["texto1"]);
    $texto2 = trim($_POST["texto2"]);

    $longText1 = strlen($texto1);
    $longText2 = strlen($texto2);

    $errorText1 = $texto1 == "" || $longText1 < 3;
    $errorText2 = $texto2 == "" || $longText2 < 3;

    $errroForm = $errorText1 || $errorText2;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
        form{
            background-color: lightblue;
            margin-left: 20%;
            margin-right: 20%;
            padding: 1%;
            border-color: black;
            border: 3px solid black;
        }
        .verdoso{
            background-color: lightgreen;
            margin-left: 20%;
            margin-right: 20%;
            padding: 1%;
            border-color: black;
            border: 3px solid black;
        }

        h2 {
            text-align: center
        }
    </style>
</head>

<body>
<div id = "principal">
    <form action="ejer1.php" method="post">
        <h2>Ripios - Formulario</h2>

        <p>Dime dos palabras y te diré si riman o no.</p>

        <p><label for="c1">Primera palabra:</label>
            <input type="text" id="c1" name="texto1" value="<?php if (isset($_POST["texto1"])) echo $texto1 ?>">
            <?php
            if (isset($_POST["enviar"]) && $errorText1) {

                if ($texto1 == "") {
                    echo "* Campo obligatorio *";
                }
            }
            ?>
        </p>


        <p><label for="c2">Segunda palabra:</label>
            <input type="text" id="c2" name="texto2" value="<?php if (isset($_POST["texto2"])) echo $texto2 ?>">
            <?php
            if (isset($_POST["enviar"]) && $errorText2) {
                if ($texto2 == "") {
                    echo "* Campo obligatorio *";
                }
            }
            ?>
        </p>

        <button type="submit" name="enviar">Comparar</button>
    </form>
</div>

    <?php
    if (isset($_POST["enviar"]) && !$errroForm) {

        $texto1Mayus = strtoupper($texto1);
        $texto2Mayus = strtoupper($texto2);

        $respuesta = "no riman";
        if ($texto1Mayus[$longText1 - 1] == $texto2Mayus[$longText2 - 1] && $texto1Mayus[$longText1 - 2] == $texto2Mayus[$longText2 - 2]) {
            $respuesta = "riman un poco";

            if ($texto1Mayus[$longText1 - 3] == $texto2Mayus[$longText2 - 3]) {
                $respuesta = "riman";
            }
        }

        echo "</br>";
        echo "</br>";

        echo "<div class='verdoso'>";
        echo "<h2>Ripios - Respuesta</h2>";
        echo "La palabra ".$texto1." y ".$texto2. " " . $respuesta;
        echo "</div>";



    }

    ?>

</body>

</html>