<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 2</title>
</head>

<body>
    <h1>Esta es mi super página</h1>

    <form action="index.php" method="post">

        <p><label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre'] ?>">
            <?php
                if (isset($_POST["enviar"]) && $errorNombr) {
                    echo "* Campo obligatorio *";
                }
            ?>
        </p>

        <p>Nacido en:
            <select name="nacimiento" id="nacimiento">
                <option value="Malaga" <?php if(!isset($_POST["nacimiento"]) || isset($_POST["nacimiento"]) && $_POST["nacimiento"] == "Malaga") echo"selected" ?>>Málaga</option>
                <option value="Almeria" <?php if(!isset($_POST["nacimiento"]) || isset($_POST["nacimiento"]) && $_POST["nacimiento"] == "Almeria") echo"selected" ?>>Almería</option>
                <option value="Jaen" <?php if(!isset($_POST["nacimiento"]) || isset($_POST["nacimiento"]) && $_POST["nacimiento"] == "Jaen") echo"selected" ?>>Jaén</option>
            </select></p>

        Sexo: <label for="hombre">Hombre</label>
        <input type="radio" name="sexo" id="hombre" value="hombre" <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") echo"checked" ?>>
        <label for="mujer">Mujer</label>
        <input type="radio" name="sexo" id="mujer" value="mujer" <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "mujer") echo"checked" ?>> 
    
        <?php
                if (isset($_POST["enviar"]) && $errorSexo) {
                    echo "* Campo obligatorio *";
                }
            ?>
        </br>

        <p>Aficiones:
            <!-- ARRAY EN NAME -->
            <label for="deportes">Deportes</label>
            <input type="checkbox" name="aficiones[]" id="deportes" value="Deportes">
            <label for="lectura">Lectura</label>
            <input type="checkbox" name="aficiones[]" id="lectura" value="Lectura">
            <label for="otros">Otros</label>
            <input type="checkbox" name="aficiones[]" id="otros" value="Otros"></p>
        


        <p>Comentarios: <textarea id="comentario" name="comentario"></textarea> </p>

        <button type="submit" name="enviar"> Enviar</button>
    </form>
</body>

</html>