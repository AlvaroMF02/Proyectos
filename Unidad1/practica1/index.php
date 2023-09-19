<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Rellena tu CV</h2>

    <!-- FORMULARIO                     GET PARA VER Q FUNCIONA SE USA   POST PARA CONTRASEÑAS ENCTYPE PARA LA SUBIDA DE ARCHIVOS-->
    <form action="recogida.php" method="get" enctype="multipart/form-data">

        <!-- CASILLAS CON TEXTO -->
        <label for="nombre">Nombre</label></br>
        <input type="text" name="nombre" id="nombre"></br>

        <label for="apellidos">Apellidos</label></br>
        <input type="text" name="apellidos" id="apellidos"></br>

        <!-- CASILLA PARA CONTRASEÑAS -->
        <label for="contr">Contraseña</label></br>
        <input type="password" name="contraseña" id="contr"></br>

        <label for="dni">DNI</label></br>
        <input type="text" name="dni" id="dni"></br>

        <!-- PARA ESCOGER UNO -->
        Sexo</br>

        <input type="radio" name="sexo" id="hombre" value="hombre">
        <label for="hombre">Hombre</label>
        </br>
        <input type="radio" name="sexo" id="mujer" value="mujer">
        <label for="mujer">Mujer</label>

        <!-- SUBIR ARCHIVOS FILTRANDO LOS ARCHIVOS QUE SE PUEDEN SUBIR-->
        <p>Incluir mi foto <input accept="image/*" type="file" name="foto" id="foto"></p>

        <!-- LISTA DESPLEGABLE -->
        Nacido en:
        <select name="nacimi" id="nacimi">
            <option value="malaga">Málaga</option>
            <option value="jaen">Jaén</option>
            <option value="sevilla">Sevilla</option>
        </select>

        <!-- AREA DE TEXTO -->
        <p>Comentarios:
            <textarea></textarea>
        </p>

        <!-- BOTONES -->
        <p><input type="checkbox" name="boletin" id="boletin">
            <label for="boletin">Suscribirse al boletín de novedades</label>
        </p>

        <button type="submit">Guardar cambios</button>
        <button type="reset">Borrar los datos introducidos</button>
    </form>
</body>

</html>