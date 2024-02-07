<?php

define("URLTOCHA", "http://localhost/Proyectos/Unidad6/Examenes/examLibreria/Examen_SW_22_23/servicios_rest");

function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}

function error_page($title, $cabecera, $mensaje)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body><h1>' . $cabecera . '</h1>' . $mensaje . '</body></html>';
    return $html;
}


if (isset($_SESSION["usuario"])) {
    
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Libreria</title>
        <style>
            .biblio{
                display: flex;
                flex-flow: row wrap;
            }
            .libros {
                display: flex;
                flex-flow: column;
                align-items: center;
                flex:33% 0;
                margin: 1rem;
            }

            img {
                width: 200px;
            }
        </style>
    </head>

    <body>
        <h1>Librería</h1>
        <form action="index.php" method="post">
            <table>
                <tr>
                    <td><label for="usuario">Nombre de usuario</label></td>
                    <td><input type="text" id="usuario" name="usuario"></td>
                </tr>
                <tr>
                    <td><label for="clave">Contraseña</label></td>
                    <td><input type="text" id="clave" name="clave"></td>
                </tr>
            </table>
            <button>Entrar</button>
        </form>

        <h2>Listado de los Libros</h2>

        <?php

        $url = URLTOCHA . "/obtenerLibros";
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta);

        if (!$obj) die("Error en la API:" . $respuesta . "</body></html>");
        if (isset($obj->error)) die("Error en la consulta:" . $obj->error . "</body></html>");
        echo "<div class='biblio'>";
        foreach ($obj->libros as $opciones) {
            echo "<div class='libros'>";
            echo "<img src='images/$opciones->portada' alt='imagen del libro'>";
            echo $opciones->titulo . " - " . $opciones->precio;
            echo "</div>";
        }
        echo "</div>";
        ?>

    </body>

    </html>
<?php
}
?>