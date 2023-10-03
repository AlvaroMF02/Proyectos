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

        

        $texto1 = strtoupper($texto1);
        $resultado = 0;

        for ($i = 0; $i < strlen($texto1); $i++) {

            switch ($texto1[$i]) {
                case 'M':
                    $resultado += 1000;
                    break;

                case 'D':
                    $resultado += 500;
                    break;

                case 'C':
                    $resultado += 100;
                    break;

                case 'L':
                    $resultado += 50;
                    break;

                case 'X':
                    $resultado += 10;
                    break;

                case 'V':
                    $resultado += 5;
                    break;

                case 'I':
                    $resultado += 1;
                    break;
            }
        }

        

        echo "</br>";
        echo "</br>";
        echo "<div class='verdoso'>";
        echo "<h2>Romanos a árabes - Formulario</h2>";
        if($resultado>5000){
            echo "El número supera los 5000 ";
        }else{
            echo "El número " . $texto1 . " se escribe en cifras árabes " . $resultado;
        }
        
        echo "</div>";
    }

    ?>

</body>

</html>