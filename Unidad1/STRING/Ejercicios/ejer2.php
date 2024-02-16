<?php
$error_form = false;

if (isset($_POST["enviar"])) {

    $texto1 = trim($_POST["texto1"]);

    $longText1 = strlen($texto1);

    $errorText1 = $texto1 == "" || $longText1 < 3;

    $errroForm = $errorText1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        form {
            background-color: lightblue;
            margin-left: 20%;
            margin-right: 20%;
            padding: 1%;
            border-color: black;
            border: 3px solid black;
        }

        .verdoso {
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
    <div id="principal">
        <form action="ejer2.php" method="post">
            <h2>Palíndromos / capicuas - Formulario</h2>

            <p>Dime una palabra o un número y te diré si es un palíndromo o un número capicúa.</p>

            <p><label for="c1">Palabra o número:</label>
                <input type="text" id="c1" name="texto1" value="<?php if (isset($_POST["texto1"])) echo $texto1 ?>">
                <?php
                if (isset($_POST["enviar"]) && $errorText1) {

                    if ($texto1 == "") {
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

        $textoMayus = strtoupper($texto1);

        $i=0;
        $j = $longText1-1;
        $bien = true;

        while ($i<$j && $bien) {
            if ($textoMayus[$i]==$textoMayus[$j]) {
                $i++;
                $j--;
            }else{
                $bien = false;
            }
        }

        if ($bien) {
            if (is_numeric($texto1)) {
                $respuesta = $texto1."es Capicua";
            }else{
                $respuesta = $texto1." es Palindromo";
            }
        }else{
            if (is_numeric($texto1)) {
                $respuesta = $texto1." no es Capicua";
            }else{
                $respuesta = $texto1." no es Palindromo";
            }
        }

        echo "</br>";
        echo "</br>";

        echo "<div class='verdoso'>";
        echo "<h2>Palíndromos / capicuas - Respuesta</h2>";
        echo "La palabra " . $respuesta;
        echo "</div>";
    }

    ?>

</body>

</html>