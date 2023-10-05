<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>DATOS RECOGIDOS</h1>

    <?php
    // MOSTRAR DATOS DEL FORMULARIO $_POST= ARRAY CON LOS DATOS
    echo "<p><b>Nombre: </b>" . $_POST["nombre"] . "</p>";
    echo "<p><b>Apellidos: </b>" . $_POST["apellidos"] . "</p>";
    echo "<p><b>Contraseña: </b>" . $_POST["contraseña"] . "</p>";
    echo "<p><b>DNI: </b>" . $_POST["dni"] . "</p>";
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

    $nombreNuevo = md5(uniqid(uniqid() . true));
    $arrayNombre = explode(".", $_FILES["archivo"]["name"]);
    $ext = "";
    if (count($arrayNombre) > 1) {
        $ext = "." . end($arrayNombre);
    }

    $nombreNuevo .= $ext;
    @$var = move_uploaded_file($_FILES["archivo"]["tmp_name"], "images/" . $nombreNuevo);

    if ($var) {
        echo "<p>Se ha podido subir la imagen a la carpeta destino en el server</p>";
        echo "<h3>Foto</h3>";
        echo "<p><b>Nombre: </b>" . $_FILES["archivo"]["name"] . "</p>";
        echo "<p><b>Tipo: </b>" . $_FILES["archivo"]["type"] . "</p>";
        echo "<p><b>Tamaño: </b>" . $_FILES["archivo"]["size"] . "</p>";
        echo "<p><b>Error: </b>" . $_FILES["archivo"]["error"] . "</p>";
        echo "<p><b>Nombre Temporal: </b>" . $_FILES["archivo"]["tmp_name"] . "</p>";
        echo "<p>La imagen ha sido subida con exito</p>";
        echo "<p><img class='tanImagen' src='images/" . $nombreNuevo . "' alt='Foto' title='Foto'/></p>";
    } else {
        echo "<p>No se ha podido subir la imagen a la carpeta destino en el server</p>";
    }


    ?>

</body>

</html>