<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <!-- -->
        <h1>DATOS RECOGIDOS</h1>

        <?php
        /* ARRAY ESCALAR Y ASOCIATIVO
    $a[0] = 3;
    $a[1] = 6;
    $a[2] = -1;
    $a[3] = 8;

    // RECORRIDO DEL ARRAY
    for ($i=0; $i < count($a); $i++) { 
        echo("<p>Número " .$a[$i]." </p>");
    }*/


        // MOSTRAR DATOS DEL FORMULARIO $_POST= ARRAY CON LOS DATOS
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

        ?>

    </body>

    </html>
