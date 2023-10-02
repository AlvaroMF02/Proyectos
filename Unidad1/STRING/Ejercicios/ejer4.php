<?php
$error_form = false;

if (isset($_POST["enviar"])) {

    $texto1 = trim($_POST["texto1"]);

    $longText1 = strlen($texto1);

    $errorText1 = $texto1 == "" || $longText1 < 3;

    $errroForm = $errorText1;
}

function quitar_espacio($palabra){
 $res = "";
 for ($i = 0; $i < strlen($palabra); $i++) {
    if ($palabra[$i] != " ") {
    $res .= $palabra[$i];
    }
 }
 return $res;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
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
        <form action="ejer4.php" method="post">
            <h2>Romanos a árabes - Formulario</h2>

            <p>Dime un número en números romanos y lo convertiré a cifras árabes.</p>

            <p><label for="c1">Número:</label>
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

        $textoMayus = quitar_espacio($textoMayus);

        

        $i = 0;
        $j = strlen($textoMayus)-1;
        $bien = true;

        while ($i < $j && $bien) {
            if ($textoMayus[$i] == $textoMayus[$j]) {
                $i++;
                $j--;
            } else {
                $bien = false;
            }
        }

        if ($bien) {
            $respuesta = $texto1 . " es Palindromo";

        } else {

            $respuesta = $texto1 . " no es Palindromo";
        }

        echo "</br>";
        echo "</br>";
        

        echo "<div class='verdoso'>";
        echo "<h2>Romanos a árabes - Formulario</h2>";
        echo "La palabra " . $respuesta;
        echo "</div>";
    }

    ?>

</body>

</html>