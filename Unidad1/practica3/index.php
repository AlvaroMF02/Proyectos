<?php

$error_form = false;

if (isset($_POST["botonSub"])) {    // SE COMPRUEBA ERRORES COMO DEJAR EL NOMBRE VACIO

    $error_nombre = $_POST["nombre"] == "";
    $error_apellido = $_POST["apellidos"] == "";
    $error_clave = $_POST["contraseña"] == "";
    $error_sexo = !isset($_POST["sexo"]);           // SI NO EXISTE
    $error_coment = $_POST["comentarios"] == "";

    // ERROR SI HAY UNO ERROR DE LOS ANTERIORES
    $error_form = $error_nombre || $error_apellido || $error_clave || $error_sexo || $error_coment;
}

if (isset($_POST["botonSub"]) && !$error_form) {    // SI NO HAY ERRORES Y SE PULSA EL BOTON SUBMIT SE VUELVE A PORNER LA PAGINA
    // AQUI VA RECOGIDAS CUANDO NO DA ERROR
    echo "<p><b>Nombre: </b>" . $_POST["nombre"] . "</p>";
    echo "<p><b>Apellidos: </b>" . $_POST["apellidos"] . "</p>";
    echo "<p><b>Contraseña: </b>" . $_POST["contraseña"] . "</p>";

    // ISSET PARA VER SI HAY O NO DEFINIDAS
    if (isset($_POST["sexo"])) {
        echo "<p><b>Sexo: </b>" . $_POST["sexo"] . "</p>";
    } else {
        echo "<p><b>Sexo: </b>Vacio</p>";
    }

    echo "<p><b>Nacido en : </b>" . $_POST["nacimi"] . "</p>";
    echo "<p><b>Comentarios : </b>" . $_POST["comentarios"] . "</p>";


    // SUBSCRIPCION SI O NO
    if (isset($_POST["subscripcion"])) {
        echo "<p><b>Subscripcion: </b>Si</p>";
    } else {
        echo "<p><b>Subscripcion: </b>No</p>";
    }
} else { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            .error {
                color: red
            }
        </style>
    </head>

    <body>
        <h2>Rellena tu CV</h2>

        <!-- VALIDAR FORMULARIO -->
        <form action="index.php" method="post" enctype="multipart/form-data">

            <!-- CASILLAS CON TEXTO -->
            <label for="nombre">Nombre</label></br>
            <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
            <?php
            if (isset($_POST["botonSub"]) && $error_nombre) {
                echo "<span class='error'>Campo vacío </span>";
            }
            ?>
            </br>



            <label for="apellidos">Apellidos</label></br>
            <input type="text" name="apellidos" id="apellidos" value="<?php if (isset($_POST["apellidos"])) echo $_POST["apellidos"] ?>">
            <?php
            if (isset($_POST["botonSub"]) && $error_apellido) {
                echo "<span class='error'>Campo vacío </span>";
            }
            ?>
            </br>

            <!-- CASILLA PARA CONTRASEÑAS -->
            <label for="contr">Contraseña</label></br>
            <input type="password" name="contraseña" id="contr">
            <?php
            if (isset($_POST["botonSub"]) && $error_clave) {
                echo "<span class='error'>Campo vacío </span>";
            }
            ?>
            </br>

            <!-- PARA ESCOGER UNO -->
            Sexo
            <?php
            if (isset($_POST["botonSub"]) && $error_sexo) {
                echo "<span class='error'>Debes seleccionar un sexo </span>";
            }
            ?>
            </br>

            <input <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") echo "checked" ?> type="radio" name="sexo" id="hombre" value="hombre">
            <label for="hombre">Hombre</label>
            </br>
            <input <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "mujer") echo "checked" ?> type="radio" name="sexo" id="mujer" value="mujer">
            <label for="mujer">Mujer</label>



            <!-- SUBIR ARCHIVOS FILTRANDO LOS ARCHIVOS QUE SE PUEDEN SUBIR-->
            <p>Incluir mi foto <input accept="image/*" type="file" name="foto" id="foto"></p>

            <!-- LISTA DESPLEGABLE -->
            Nacido en:
            <select name="nacimi" id="nacimi">
                <option value="malaga">Málaga</option>
                <option value="jaen" selected>Jaén</option>
                <option value="sevilla">Sevilla</option>
            </select>

            <!-- AREA DE TEXTO -->
            <p>Comentarios:
                <textarea id="coment" name="comentarios"><?php if (isset($_POST["comentarios"])) echo $_POST["comentarios"] ?></textarea>
                <?php
                if (isset($_POST["botonSub"]) && $error_coment) {
                    echo "<span class='error'>Campo vacio </span>";
                }
                ?>
            </p>

            <!-- BOTONES -->
            <p><input type="checkbox" checked name="subscripcion" id="subscripcion">
                <label for="subscripcion">Suscribirse al boletín de novedades</label>
            </p>

            <button type="submit" name="botonSub">Guardar cambios</button>
            <button type="reset">Borrar los datos introducidos</button>

        </form>
    </body>

    </html>
<?php } ?>