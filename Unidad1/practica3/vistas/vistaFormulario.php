<!DOCTYPE html>
<!-- EN ESTA VISTA SE ENCEUNTRA TODO EL HTML -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: red
        }

        .tanImagen {
            width: 35%;
        }
    </style>
</head>

<body>
    <h2>Rellena tu CV</h2>

    <!-- VALIDAR FORMULARIO -->
    <form action="index.php" method="post" enctype="multipart/form-data">

        <p>
        <!-- CASILLAS CON TEXTO -->
        <label for="nombre">Nombre</label></br>
        <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
        <?php
        if (isset($_POST["botonSub"]) && $error_nombre) {
            echo "<span class='error'>Campo vacío </span>";
        }
        ?>
        </p>



        <p>
        <label for="usuario">Usuario</label></br>
        <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
        <?php
        if (isset($_POST["botonSub"]) && $error_apellido) {
            echo "<span class='error'>Campo vacío </span>";
        }
        ?>
        </p>

        <p>
        <!-- CASILLA PARA CONTRASEÑAS -->
        <label for="contr">Contraseña</label></br>
        <input type="password" name="contraseña" id="contr">
        <?php
        if (isset($_POST["botonSub"]) && $error_clave) {
            echo "<span class='error'>Campo vacío </span>";
        }
        ?>
        </p>

        <p>
        <!-- DNI -->
        <label for="dni">DNI</label></br>
        <input type="text" name="dni" id="dni" placeholder="DNI: 11223344Z" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
        <?php
        if (isset($_POST["botonSub"]) && $error_dni) {

            if ($_POST["dni"] == "") {
                echo "<span class='error'>Campo vacío </span>";
            } else if (!dniBienEscrito(strtoupper($_POST["dni"]))) {
                echo "<span class='error'>* Debes rellenar el DNI con 8 dígitos seguidos de una letra *</span>";
            } else {
                echo "<span class='error'>* DNI no valido *</span>";
            }
        }
        ?>
        </p>

        <!-- PARA ESCOGER UNO -->
        <p>
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
        </p>


        <!-- SUBIR ARCHIVOS FILTRANDO LOS ARCHIVOS QUE SE PUEDEN SUBIR-->
        <p>
            <label for="archivo">Incluir mi foto (Archivo de tipo imagen Máx 500 KB):</label>
            <input accept="image/*" type="file" name="archivo" id="foto">
            <?php
            if (isset($_POST["enviar"]) && $error_archivo) {

                if ($_FILES["archivo"]["name"] != "") {

                    if ($_FILES["archivo"]["error"]) {
                        echo "<span class='error'>No se ha podido subir el archivo</span>";
                    } elseif (!getimagesize($_FILES["archivo"]["tmp_name"])) {
                        echo "<span class='error'>No has seleccionado una imagen</span>";
                    } else {
                        echo "<span class='error'>El archivo supera los 500 KB</span>";
                    }
                }
            }
            ?>
        </p>


        <!-- BOTONES -->
        <p><input type="checkbox" checked name="subscripcion" id="subscripcion">
            <label for="subscripcion">Suscribirme al boletín de Novedades</label>
        </p>

        <button type="submit" name="botonSub">Guardar cambios</button>
        <button type="submit" name="botonBor">Borrar los datos introducidos</button>

    </form>
</body>

</html>