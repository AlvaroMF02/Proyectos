<?php
if (isset($_POST["enviar"])) {
    $textVacio = $_POST["texto"] == "";
    $despVacio = $_POST["desplazamientos"] == "";
    $despNum = !is_numeric($_POST["desplazamientos"]);

    $errorFichVacio = $_FILES["archivo"]["name"] == "";
    $errorFich = $_FILES["archivo"]["error"];
    $errortipo = $_FILES["archivo"]["type"] != "text/plain";
    $errorTaman = $_FILES["archivo"]["size"] > 1250 * 1024;

    $errorFormulario = $textVacio || $despVacio || $errorFichVacio || $errorFich || $errortipo || $errorTaman;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 3. Codifica una frase</h1>

    <form action="Ejercicio3.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="texto">Introduzca un Texto</label>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["enviar"]) && $_POST["texto"] != "") echo $_POST["texto"] ?>">
            <?php
            if (isset($_POST["enviar"]) && $textVacio) {
                echo "<span class= error>* Campo requerido *</span>";
            }
            ?>
        </p>
        <p>
            <label for="desp">Desplazamiento</label>
            <input type="text" name="desplazamientos" id="desp" value="<?php if (isset($_POST["enviar"]) && $_POST["desplazamientos"] != "") echo $_POST["desplazamientos"] ?>">
            <?php
            if (isset($_POST["enviar"])) {
                if ($despVacio) {
                    echo "<span class= error>* Campo requerido *</span>";
                } elseif ($despNum) {
                    echo "<span class= error>* Escriba un número *</span>";
                }
            }
            ?>
        </p>
        <p>
            <label for="fich">Seleccione el archivo de claves (.txt y menor 1,25MB)</label>
            <input type="file" name="archivo" id="fich">
            <?php
            if (isset($_POST["enviar"])) {
                if ($errorFichVacio) {
                    echo "<span class= error>* No ha subido nada *</span>";
                } elseif ($errorFich) {
                    echo "<span class= error>* Error al subir dichero *</span>";
                } elseif ($errortipo) {
                    echo "<span class= error>* Debe ser txt *</span>";
                } elseif ($errorTaman) {
                    echo "<span class= error>* Supera los 1,25MB *</span>";
                }
            }
            ?>
        </p>
        <button type="submit" name="enviar">Codificar</button>

    </form>

    <?php
    if (isset($_POST["enviar"]) && !$errorFormulario) {
        $texto = $_POST["texto"];
        $mayus = "";

        // COGER SOLO LAS MAYUSCULAS
        for ($i = 0; $i < strlen($texto); $i++) {
            if (ord($texto[$i]) >= 65 && ord($texto[$i]) <= 90) {
                $mayus .= $texto[$i];
            }
        }

        @$fd = fopen("claves_cesar.txt", "r");
        if (!$fd) {
            die("No se ha podido generar el archivo");
        } else {

            $despla = $_POST["desplazamientos"];
            for ($i = 1; $i < $despla; $i++) {
                $linea = fgets($fd);
                $letras = explode(";", $linea);
            }
            //print_r($letras);





            fclose($fd);
        }
    }
    ?>
</body>

</html>