<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones 4</title>
    <style>
        .textCentrado {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="textCentrado">MOVER UN PUNTO A DERECHA E IZQUIERDA</h1>
    <p>haga click en los botones para mover el punto</p>
    <form action="sesiones4-2.php">
        <button type="submit" value="izq">⬅️</button><button type="submit" value="der">➡️</button>

        <svg version="1.1" xmlns=http://www.w3.org/2000/svg width="600px" height="20px" viewbox="-300 0 600 20">
            <line x1="-300" y1="10" x2="300" y2="10" stroke="black" stroke-width="5" />
            <circle cx="0" cy="10" r="8" fill="red" />
        </svg>
        <button value="volver">Volver al centro</button>
    </form>
</body>

</html>