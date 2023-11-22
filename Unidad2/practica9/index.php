<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table,td,th{border:1px solid black;}
        table{border-collapse:collapse;text-align:center;width:90%;margin:0 auto}
        th{background-color:#CCC}
        table img{width:50px;}
        .enlace{border:none;background:none;cursor:pointer;color:blue;text-decoration:underline}
        .error{color:red}
        .foto_detalle{height:250px}
        .paralelo{display:flex}
        .centrado{text-align:center}
    </style>
    <title>Practica 9</title>
</head>
<body>
    <h1>Video club</h1>
    <h2>Peliculas</h2>

    <?php
    require "vistas/mostrarTabla.php";

    if (isset($_POST["btnmostrarDetalles"])) {
        require "vistas/mostrarDetalles.php";
        // me he quedado creando los detalles
    }

    ?>

</body>
</html>