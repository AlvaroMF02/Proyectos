<?php
if (isset($_POST["enviar"])) {
    $errorTexto = $_POST["texto"] == "";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio2. Contar Palabras sin vocales (a,e,i,o,u, A,E,I,O,U)</h1>
    <form action="Ejercicio2.php" method="post">
        <p>
            <label for="texto">Introduzca un Texto</label>
            <input type="text" name="texto" id="texto">
            <?php
            if (isset($_POST["enviar"]) && $errorTexto) {
                echo "<span class= error>* Campo requerido *</span>";
            }
            ?>
        </p>

        <p>
            <label for="sep">Elije el Separador</label>
            <select name="separador" id="sep">
                <option value="," <?php if (isset($_POST["enviar"]) && $_POST["separador"] == ",") echo "selected" ?>>Coma</option>
                <option value="." <?php if (isset($_POST["enviar"]) && $_POST["separador"] == ".") echo "selected" ?>>Punto</option>
                <option value=";" <?php if (isset($_POST["enviar"]) && $_POST["separador"] == ";") echo "selected" ?>>Punto y coma</option>
                <option value=":" <?php if (isset($_POST["enviar"]) && $_POST["separador"] == ":") echo "selected" ?>>Dos puntos</option>
                <option value=" " <?php if (isset($_POST["enviar"]) && $_POST["separador"] == " ") echo "selected" ?>>Espacio</option>
            </select>
        </p>

        <button name="enviar" type="submit">Contar</button>
    </form>

    <?php
    if (isset($_POST["enviar"]) && !$errorTexto) {
        echo "<h1>Respuesta</h1>";
        echo "El texto " . $_POST["texto"] . " con el separador '" . $_POST["separador"] . "' contiene palabras sin las vocales.";
    }
    ?>

</body>

</html>