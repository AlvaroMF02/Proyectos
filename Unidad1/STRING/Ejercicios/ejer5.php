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
    <title>Ejercicio 5</title>
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
        <form action="ejer5.php" method="post">
            <h2>Árabes a romanos - Formulario</h2>

            <p>Dime un número y lo convertiré a números romanos.</p>

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


        $resultado = 0;


        // SIN HACER
        for ($i=0; $i < strlen($texto); $i++) { 
            if ($texto[$i]==1000) {
                
            }
        }
        



        echo "</br>";
        echo "</br>";
        echo "<div class='verdoso'>";
        echo "<h2>Árabes a romanos - Formulario</h2>";

        echo "El número " . $texto1 . " se escribe en números romanos " . $resultado;


        echo "</div>";
    }

    ?>

</body>

</html>