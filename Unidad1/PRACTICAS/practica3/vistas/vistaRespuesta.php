<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>DATOS ENVIADOS</h1>

    <?php
    // MOSTRAR DATOS DEL FORMULARIO $_POST= ARRAY CON LOS DATOS
    echo "<p><b>Nombre: </b>" . $_POST["nombre"] . "</p>";
    echo "<p><b>Usuario: </b>" . $_POST["usuario"] . "</p>";
    echo "<p><b>Contraseña: </b>" . $_POST["contraseña"] . "</p>";
    echo "<p><b>DNI: </b>" . $_POST["dni"] . "</p>";
    // ISSET PARA VER SI HAY O NO DEFINIDAS
    if (isset($_POST["sexo"])) {
        echo "<p><b>Sexo: </b>" . $_POST["sexo"] . "</p>";
    } else {
        echo "<p><b>Sexo: </b>Vacio</p>";
    }


    // SUBSCRIPCION SI O NO
    if (isset($_POST["subscripcion"])) {
        echo "<p><b>Subscripcion: </b>Si</p>";
    } else {
        echo "<p><b>Subscripcion: </b>No aceptada</p>";
    }

    // IF POR SI NO HA SUBIDO LA FOTO
    $nombreNuevo = md5(uniqid(uniqid() . true));
    $arrayNombre = explode(".", $_FILES["archivo"]["name"]);
    $ext = "";
    if (count($arrayNombre) > 1) {
        $ext = "." . end($arrayNombre);
    }

    $nombreNuevo .= $ext;
    @$var = move_uploaded_file($_FILES["archivo"]["tmp_name"], "images/" . $nombreNuevo);

    if ($var) {
        echo "<h3><b>Informacion de la imagen seleccionada</b></h3>";
        echo "<b>Error: </b>" . $_FILES["archivo"]["error"] . "</br>";
        echo "<b>Nombre: </b>" . $_FILES["archivo"]["name"] . "</br>";
        echo "<b>Ruta en servidor: </b>" . $_FILES["archivo"]["tmp_name"] . "</br>";
        echo "<b>Tipo archivo: </b>" . $_FILES["archivo"]["type"] . "</br>";
        echo "<b>Tamaño archivo: </b>" . $_FILES["archivo"]["size"] . "</br>";
        
        echo "<p>La imagen ha sido subida con exito</p>";
        echo "<p><img class='tanImagen' src='images/" . $nombreNuevo . "' alt='Foto' title='Foto'/></p>";
    } else {
        echo "<p><b>Foto:</b> Foto no seleccionada</p>";
    }


    ?>

</body>

</html>