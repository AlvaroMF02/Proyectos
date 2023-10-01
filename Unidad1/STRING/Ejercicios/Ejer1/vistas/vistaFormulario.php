<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{background-color: lightblue;margin-left:20%;margin-right:20%;padding: 1%;border-color: black;border:3px solid black;}
        h2{text-align: center}
    </style>
</head>
<body>
    <form action="index.php" metod="post">
        <h2>Ripios - Formulario</h2>

        <p>Dime dos palabras y te diré si riman o no.</p>

        <p><label for="c1">Primera palabra:</label>
        <input type="text" id="c1" name="palabra1" value="<?php if (isset($_POST["palabra1"])) echo $_POST["palabra1"] ?>">
        
        <?php
            if (isset($_POST["enviar"]) && $errorPalab1) {
                echo "* Campo obligatorio *";
            }
        ?></p>


        <p><label for="c2">Segunda palabra:</label>
        <input type="text" id="c2" name="palabra2">
    
        <?php
            if (isset($_POST["enviar"]) && $errorPalab2) {
                echo "* Campo obligatorio *";
            }
        ?></p>

        <button type="submit" name="enviar">Comparar</button>
    </form>
    
</body>
</html>