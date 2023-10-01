<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
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
    <h2>Ripios - Resultado</h2>
    <?php


    // SI LAS 3 ULTIMAS LETRAS COINCIDEN RIMAN
    if (substr($_POST["palabra1"], strlen($_POST["palabra1"] - 3), strlen($_POST["palabra1"]))
        == substr($_POST["palabra2"], strlen($_POST["palabra2"] - 3), strlen($_POST["palabra2"]))) {

        echo $_POST["palabra1"] . " y " . $_POST["palabra2"] . " riman";

        // SI LAS 2 ULTIMAS LETRAS COINCIDEN RIMAN UN POCO
    } else if (substr($_POST["palabra1"], strlen($_POST["palabra1"] - 2), strlen($_POST["palabra1"]))
        == substr($_POST["palabra2"], strlen($_POST["palabra2"] - 2), strlen($_POST["palabra2"]))) {

        echo $_POST["palabra1"] . " y " . $_POST["palabra2"] . " riman un poco";

        // NO RIMA
    } else {

        echo $_POST["palabra1"] . " y " . $_POST["palabra2"] . " no riman";
    }




    ?>

</body>

</html>