<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <style>
        table {
            text-align: center;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th {
            background-color: #CCC;
        }

        img {
            height: 100px;
        }

        .enlace {
            background: none;
            color: blue;
            text-decoration: underline;
            border: none;
            cursor: pointer;
        }

        .negrita {
            font-weight: bold;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Notas de los alumnos</h1>
    <?php
    require "vistas/vistaSelect.php";

    if (isset($_POST["btnNotas"])) {
        require "vistas/vistaNotas.php";
    }else if (isset($_POST["btnBorrarNota"])){
        require "vistas/vistaBorrar.php";
    }

    ?>

</body>

</html>