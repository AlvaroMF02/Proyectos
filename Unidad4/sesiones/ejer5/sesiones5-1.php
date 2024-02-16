<?php
session_name("ejer5");
session_start();

// si no esta definida se pone como 0
if (!isset($_SESSION["bola"])) {
    $_SESSION["bola"] = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones 5</title>
    <style>
        .textCentrado {
            text-align: center;
        }

        svg {
            border: 3px solid black;
        }

        button {
            width: 3rem;
            height: 3rem;
        }

        button#volver {
            width: 5rem;
            height: 3rem;
        }

        div {
            width: 12rem;
            display: flex;
            flex-flow: column nowrap;
            align-items: center;
        }

        button#izquierda {
            align-self: flex-start;
        }

        button#derecha {
            align-self: flex-end;
        }
    </style>
</head>

<body>
    <h1 class="textCentrado">MOVER UN PUNTO EN DOS DIMENSIONES</h1>
    <p>Haga click en los botones para mover el punto:</p>

    <form action="sesiones5-2.php">

        <div>
            <button id="arriba" type="submit" name="boton" value="arriba"> &#x1F446;</button>
            <button id="derecha" type="submit" name="boton" value="derecha"> &#x1F449;</button>
            <button id="volver" type="submit" name="boton" value="volver">Volver al centro</button>
            <button id="izquierda" type="submit" name="boton" value="izquierda"> &#x1F448;</button>
            <button id="abajo" type="submit" name="boton" value="abajo"> &#x1F447;</button>

        </div>
        <svg version="1.1" xmlns=http://www.w3.org/2000/svg width="600px" height="600px" viewbox="-300 0 600 20">
            <circle cx="<?php echo $_SESSION['bola'] ?>" cy="10" r="8" fill="red" />
        </svg>


    </form>

</body>

</html>