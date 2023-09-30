<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{background-color: lightgreen;margin-left:20%;margin-right:20%;padding: 1%;border-color: black;border:3px solid black;}
        h2{text-align: center}
    </style>
</head>
<body>
    <form action="index.php" metod="post">
        <h2>Ripios - Resultado</h2>
        <?php
            // meter un if con cada salida diferente
            echo $_POST["palabra1"]." y " .$_POST["palabra2"]." riman un poco";


        ?>
    </form>
    
</body>
</html>
