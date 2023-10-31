<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría BADAT</title>
    <style>
        table,
        th,
        td {
            border: solid 1px black;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }

        th {
            background-color: #CCC;
        }
    </style>
</head>

<body>
    <h2>Teoría BD</h2>
    <?php

    try {
        // PRIMERO HAY QUE CONECTARSE A LA BD
        //                          donde esta  usuar   contr   nombre BD
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_teoria");
        // PARA QUE SI HAY ACENTOS O Ñ NO TRAIGA CARÁCTERES RAROS
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        mysqli_close($conexion);
        //                                                              LOS DIE ACABAN CON TODO
        die("<p>No se ha podido conectar a la base de datos:" . $e->getMessage() . "</p></body></html>");
    }


    $consulta = "select * from t_alumnos";

    // POR SI LA CONSULTA ESTA MAL HECHA
    try {
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("<p>Imposible realizar la consulta:" . $e->getMessage() . "</p></body></html>");
    }

    // CANTIDA DE TUPLAS
    $numTuplas = mysqli_num_rows($resultado);
    echo "<p>El número de tuplas ha sido: " . $numTuplas . "</p>";

    echo "<h4>mysqli_fetch_assoc</h4>";
    // COMO IR POR LAS TUPLAS DEL RESULTADO
    // METE UN ARRAY ASOCIATIVO EN $tupla
    $tupla = mysqli_fetch_assoc($resultado);
    print_r($tupla);
    echo "<p>El primer alumno obtenido tiene el nombre: " . $tupla['nombre'] . "</p>";

    echo "<h4>mysqli_fetch_row</h4>";
    // METE UN ARRAY INDICE ESCALAR EN $tupla
    $tupla = mysqli_fetch_row($resultado);
    print_r($tupla);
    echo "<p>El primer alumno obtenido tiene el nombre: " . $tupla[1] . "</p>";

    echo "<h4>mysqli_fetch_array</h4>";
    // METE UN ARRAY INDICE DE FORMA ESCALAR Y ASOCIATIVA EN $tupla 
    $tupla = mysqli_fetch_array($resultado);
    print_r($tupla);
    echo "<p>El primer alumno obtenido tiene el nombre: " . $tupla[1] . "</p>";
    echo "<p>El primer alumno obtenido tiene el nombre: " . $tupla['nombre'] . "</p>";


    // VOLVER A LA POSICION QUE QUIERAS
    mysqli_data_seek($resultado, 0);

    echo "<h4>mysqli_fetch_object</h4>";
    // TRAE UN OBJETO
    $tupla = mysqli_fetch_object($resultado);
    print_r($tupla);
    echo "<p>El primer alumno obtenido tiene el nombre: " . $tupla->nombre . "</p>";


    // TABLA CON TODOS LOS ALUMNOS
    mysqli_data_seek($resultado, 0);
    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre</th><th>Teléfono</th><th>Código Postal</th></tr>";

    // MIENTRAS HAYA TUPLAS     tmb se puede hacer escalar con un for
    while($tupla = mysqli_fetch_assoc($resultado)){
        echo "<tr>";
        echo "<td>".$tupla["cod_alu"]."</td>";
        echo "<td>".$tupla["nombre"]."</td>";
        echo "<td>".$tupla["telefono"]."</td>";
        echo "<td>".$tupla["cp"]."</td>";
        echo "</tr>";
    }
    echo "</table>";

    // LIBERAR $resultado   solo en los select
    mysqli_free_result($resultado);

    // CERRAR SIEMPRE LA SESION
    mysqli_close($conexion);
    ?>
</body>

</html>