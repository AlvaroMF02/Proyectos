<?php
$error_form = false;

if (isset($_POST["enviar"])) {

    $texto1 = trim($_POST["texto1"]);

    $longText1 = strlen($texto1);

    $errorText1 = $texto1 == "";

    $errroForm = $errorText1;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
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
        <form action="ejer6.php" method="post">
            <h2>Quita acentos - Formulario</h2>

            <p>Escribe un texto y le quitaré los acentos.</p>

            <p><label for="c1">Texto:</label>
                <!-- value="<?php if (isset($_POST["texto1"])) echo $texto1 ?>" -->
                
                <textarea name="texto1" id="c1" cols="15" rows="4"></textarea>
                <?php
                if (isset($_POST["enviar"]) && $errorText1) {

                    if ($texto1 == "") {
                        echo "* Campo obligatorio *";
                    }
                }
                ?>
            </p>

            <button type="submit" name="enviar">Quitar acentos</button>
        </form>
    </div>

    <?php
    if (isset($_POST["enviar"]) && !$errroForm) {


        $resultado = 0;

        // CODIGO ASCII DESDE EL 128 HASTA 165 || 224 HASTA 237

        echo "</br>";
        echo "</br>";
        echo "<div class='verdoso'>";
        echo "<h2>Quita acentos - Formulario</h2>";

        // CAMBIAR FORMATO DE LA SALIDA
        echo  $texto1 . " sin acentos: " . $minuscula;


        echo "</div>";
    }

    ?>

</body>

</html>