
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .enLinea {
            display: inline;
        }

        .enlace {
            background: none;
            color: blue;
            border: none;
            text-decoration: underline;
            cursor: pointer;
        }

        table{
            margin: 0 auto;
        }

        table,
        tr,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
            width: 50rem;
            text-align: center;
        }

        th {
            background-color: lightgrey;
        }
    </style>
</head>

<body>
    <h1>Notas de los alumnos</h1>
    <?php
    echo "Bienvenido " . $datos_usuario_log->usuario . " - <form class='enLinea' method='post' action='index.php'><button name='btnSalir' class='enlace'>Salir</button></form>";
    
    echo "<h2>Equipos de guardia del IES Mar Alborán</h2>";
    $dias[0] = "";
    $dias[1] = "Lunes"; 
    $dias[2] = "Martes"; 
    $dias[3] = "Miercoles"; 
    $dias[4] = "Jueves"; 
    $dias[5] = "Viernes"; 

    echo "<table>";
    // primera fila
        echo "<tr>";
        for ($i=0; $i <6; $i++) { 
            echo "<th>".$dias[$i]."</th>";
        }
        echo"</tr>";

    $contador = 1;
    for ($hora=1; $hora <= 6; $hora++) { 
        if ($hora==4) {
            echo "<tr>";
            echo "<td colspan='6'>RECREO</td>";
            echo "</tr>";
        }

        echo "<tr>";
        echo "<td>".$hora."º hora</td>";
        for ($dia=1; $dia <=5 ; $dia++) { 
            echo "<td>";
            echo"<form action='index.php' method='post'>";
            echo "<input type='hidden' value='".$dia."' name='dia'>";
            echo "<input type='hidden' value='".$hora."' name='hora'>";
            echo "<input type='hidden' value='".$contador."' name='equipo'>";
            echo "<button name='btnGuardia' class='enlace'>Equipo ".$contador."</button>";
            echo"</form>";
            echo"</td>";
            $contador++;
        }
        echo "</tr>";
    }
    echo "</table>";

    
    ?>

    
</body>
</html>