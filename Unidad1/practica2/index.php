<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Esta es mi supre página</h1>

    <form action="recogida.php" action="post">

        <p><label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        </p>

        <p>Nacido en:
            <select name="nacimiento" id="nacimiento">
                <option value="nacimiento">Málaga</option>
                <option value="nacimiento">Almería</option>
                <option value="nacimiento">Jaén</option>
            </select>
        </p>

        Sexo: <label for="sexo">Hombre</label>
        <input type="radio" name="sexo" id="hombre" value="hombre">
        <label for="sexo">Mujer</label>
        <input type="radio" name="sexo" id="mujer" value="mujer"> </br>

        <p>Aficiones:
            <label for="deportes">Deportes</label>
            <input type="checkbox" name="deportes" id="deportes">
            <label for="lectura">Lectura</label>
            <input type="checkbox" name="lectura" id="lectura">
            <label for="otros">Otros</label>
            <input type="checkbox" name="otros" id="otros">
        </p>



        <p>Comentarios: <textarea id="comentario" name="comentario"></textarea></p>

        <button type="submit" name="enviar">Enviar</button>
    </form>
</body>

</html>