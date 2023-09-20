<?php
// LLEVAR AL FORMULARIO PQ AL RECARGAR DA ERROR
// AL DARLE AL BOTON DE SUBMIT
if (isset($_POST["enviar"])) { ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Practica 2</title>
    </head>
    <body>
        <h1>Datos recogidos</h1>

        <?php
        
            // TEXTO NORMAL
            echo "<p><b>Nombre:</b> " .$_POST["nombre"]." </p>";
            echo "<p><b>Nacido en:</b> " .$_POST["nacimiento"]." </p>";

            // SEXO ELECCION POSIBLE VACIO
            if (isset($_POST["sexo"])) {
                echo "<p><b>Sexo:</b> " .$_POST["sexo"]." </p>";
            }else{
                echo "<p><b>Sexo:</b> Vacio </p>";
            }

            // AFICIONES SI NO
            echo "<b>Aficiones:</b></br>";
            if (isset($_POST["deportes"])) {
                echo "- Deportes -> Si</br>";
            }else{
                echo "- Deportes -> No</br>";
            }
            if (isset($_POST["lectura"])) {
                echo "- Lectura -> Si</br>";
            }else{
                echo "- Lectura -> No</br>";
            }
            if (isset($_POST["otros"])) {
                echo "- Otros -> Si</br>";
            }else{
                echo "- Otros -> No</br>";
            }

            echo "<p><b>Comentarios: </b>" .$_POST["comentario"]."</p>"

        ?>

    </body>
    </html>

    <?php   // SE VUELVE A ABRIR EL ELSE DEL PHP 
} else {
    // LLEVA A LA PAGINA ANTERIOR
    header("Location:index.php");
}

?>