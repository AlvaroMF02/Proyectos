<?php

if (isset($_POST["enviar"])) {

    $error_archivo = $_FILES["archivo"]["name"] == "" || $_FILES["archivo"]["error"]
        || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024;
}

if (isset($_POST["enviar"]) && !$error_archivo) {?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subida</title>
    <style>
        .tanImagen{
            width: 35%;
        }
    </style>
</head>
<body>
    <h1>Teoria subir archivos</h1>
    <h2>datos del archivo subido</h2>
    
    <?php 
    $nombreNuevo = md5(uniqid(uniqid().true));
    $arrayNombre=explode(".",$_FILES["archivo"]["name"]);
    $ext="";
    if(count($arrayNombre) > 1){
        $ext = ".".end($arrayNombre);
    }

    $nombreNuevo.=$ext; 
    @$var=move_uploaded_file($_FILES["archivo"]["tmp_name"],"images/".$nombreNuevo);

    if($var){
        echo "<p>Se ha podido subir la imagen a la carpeta destino en el server</p>";
        echo "<h3>Foto</h3>";
        echo "<p><b>Nombre: </b>".$_FILES["archivo"]["name"]."</p>";
        echo "<p><b>Tipo: </b>".$_FILES["archivo"]["type"]."</p>";
        echo "<p><b>Tamaño: </b>".$_FILES["archivo"]["size"]."</p>";
        echo "<p><b>Error: </b>".$_FILES["archivo"]["error"]."</p>";
        echo "<p><b>Nombre Temporal: </b>".$_FILES["archivo"]["tmp_name"]."</p>";
        echo "<p>La imagen ha sido subida con exito</p>";
        echo "<p><img class='tanImagen' src='images/".$nombreNuevo."' alt='Foto' title='Foto'/></p>";

        
    }else{
        echo "<p>No se ha podido subir la imagen a la carpeta destino en el server</p>";
    }

    ?>
    
</body>
</html>

<?php } else { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TEORIA SUBIR ARCHIVOS AL SERVIDORs</title>
        <style>
            .error {
                color: red
            }
        </style>
    </head>

    <body>
        <h1>Teoría subir fichero al servidor</h1>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="archivo">Seleccione un archivo de imagen (max 500KB):</label>
                <input type="file" name="archivo" id="archivo" accept="image/*">
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
            <p><button type="submit" name="enviar">Enviar</button></p>
        </form>
    </body>

    </html>





<?php
}
?>