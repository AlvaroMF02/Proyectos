<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2</title>
    <style>
        form {
            background-color: lightblue;
            margin-left: 20%;
            margin-right: 20%;
            padding: 1%;
            border-color: black;
            border: 3px solid black;
        }

        .verdoso {
            background-color: lightgreen;
            margin-left: 20%;
            margin-right: 20%;
            padding: 1%;
            border-color: black;
            border: 3px solid black;
        }

        h2 {
            text-align: center
        }

        .titulo {
            text-align: center;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div id="principal">

        <form action="fecha2.php" method="post">
            <h1 class="titulo">Fechas-Formulario</h1>
            <p>
            <p>Introduzca una fecha:</p>
            Día:
            <select name="dia1" id="dia1">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    echo "<option>" . $i . "</option>";
                }
                ?>
            </select>
            Mes:
            <select name="mes1" id="mes1">
                <?php
                $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

                foreach ($meses as  $mes) {
                    echo "<option>" . $mes . "</option>";
                }
                ?>
            </select>
            Año:
            <select name="anyo1" id="anyo1">
                <?php
                for ($i = 1970; $i <= 2023; $i++) {
                    echo "<option>" . $i . "</option>";
                }
                ?>
            </select>


            <p>Introduzca una fecha:</p>
            Día:
            <select name="dia2" id="dia2">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    echo "<option>" . $i . "</option>";
                }
                ?>
            </select>
            Mes:
            <select name="mes2" id="mes2">
                <?php
                $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

                foreach ($meses as  $mes) {
                    echo "<option>" . $mes . "</option>";
                }
                ?>
            </select>
            Año:
            <select name="anyo2" id="anyo2">
                <?php
                for ($i = 1970; $i <= 2023; $i++) {
                    echo "<option>" . $i . "</option>";
                }
                ?>
            </select>
            </p>
            <button type="submit" name="enviar">Calcular</button>

        </form>
    </div>


    <?php
    if (isset($_POST["enviar"])) {


        echo "</br>";
        echo "</br>";
        echo "<div class='verdoso'>";
        echo "<h2>Fechas - Respuesta</h2>";
        echo "La diferencia en días entre las dos fechas introducidas es de ".$_POST["dia1"].$_POST["mes1"].$_POST["anyo1"] ;
        echo "</div>";
    }

    ?>
</body>

</html>