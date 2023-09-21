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
                <option value="malaga" <?php if (!isset($_POST["nacimi"]) || isset($_POST["nacimi"]) && $_POST["nacimi"] == "malaga") echo "selected" ?>>Málaga</option>
                <option value="jaen" <?php if (!isset($_POST["nacimi"]) || isset($_POST["nacimi"]) && $_POST["nacimi"] == "jaen") echo "selected" ?>>Jaén</option>
                <option value="sevilla" <?php if (!isset($_POST["nacimi"]) || isset($_POST["nacimi"]) && $_POST["nacimi"] == "sevilla") echo "selected" ?>>Sevilla</option>
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