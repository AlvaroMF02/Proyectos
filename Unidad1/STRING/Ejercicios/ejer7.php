<?php
$error_form = false;

if (isset($_POST["enviar"])) {

    $texto1 = trim($_POST["texto1"]);

    $errorNum = !is_numeric($texto1);

    $errorText1 = $texto1 == "";

    $errroForm = $errorText1 || $errorNum;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
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
        <form action="ejer7.php" method="post">
            <h2>Unifica separador decimal - Formulario</h2>

            <p>Escribe varios números separados por espacios y unificaré el separador decimal a puntos.</p>

            <p><label for="c1">Números:</label>
                <input type="text" id="c1" name="texto1" value="<?php if (isset($_POST["texto1"])) echo $texto1 ?>">
                <?php
                if (isset($_POST["enviar"])) {

                    if ($errorText1) {
                        echo "* Campo obligatorio *";
                    } elseif ($errorNum) {
                        echo "* Solo se admiten números *";
                    }
                }
                ?>
            </p>

            <button type="submit" name="enviar">Convertir</button>
        </form>
    </div>

    <?php
    if (isset($_POST["enviar"]) && !$errroForm) {





        $resultado = str_replace(",", ".", $texto1);



        echo "</br>";
        echo "</br>";
        echo "<div class='verdoso'>";
        echo "<h2>Unifica separador decimal - Formulario</h2>";

        echo "Números originales<br>";
        echo " &nbsp;&nbsp;&nbsp;&nbsp;" . $texto1;
        $resultado;
        echo "<br>Números corregidos<br>";
        echo " &nbsp;&nbsp;&nbsp;&nbsp;" . $resultado;



        echo "</div>";
    }

    ?>

</body>

</html>