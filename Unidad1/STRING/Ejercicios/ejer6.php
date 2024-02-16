<?php
$error_form = false;

function quitarAcentos($texto){
	
    // REEMPLAZAR LA A
    $texto = str_replace(array('Á', 'á'),array('A', 'a'),$texto);
    // REEMPLAZAR LA E
    $texto = str_replace(array('É','é'),array('E','e'),$texto );
    // REEMPLAZAR LA I
    $texto = str_replace(array('Í','í'),array('I','i'),$texto );
    // REEMPLAZAR LA O
    $texto = str_replace(array('Ó','ó'),array('O','o'),$texto );
    // REEMPLAZAR LA U
    $texto = str_replace(array('Ú','Ü','ú', 'ü'),array('U','U','u','u'),$texto );
    
    return $texto;
}

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

        

        echo "</br>";
        echo "</br>";
        echo "<div class='verdoso'>";
        echo "<h2>Quita acentos - Formulario</h2>";

        echo "Texto original<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;".$texto1;
        $resultado = quitarAcentos($texto1);
        echo "<br>Texto sin acentos<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;".$resultado;

        echo "</div>";
    }

    ?>

</body>

</html>