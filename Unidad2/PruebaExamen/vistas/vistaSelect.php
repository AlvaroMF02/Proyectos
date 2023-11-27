<?php
    try{
        $conexion=mysqli_connect("localhost","jose","josefa","bd_exam_colegio");
        mysqli_set_charset($conexion,"utf8");
    }
    catch(Exception $e)
    {
        die("<p>No ha podido conectarse a la base de batos: ".$e->getMessage()."</p></body></html>");
    }

    try{
        $consulta="select * from alumnos";
        $resultado=mysqli_query($conexion, $consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die("<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p></body></html>");
    }
    
    
    if (mysqli_num_rows($resultado)>0) {

        echo "<form action='index.php' method='post'>"; 
        echo "Seleccione un Aumno:";
        echo "<select name='alumnos'>";

        while ($datosAlumnos = mysqli_fetch_assoc($resultado)){

            if (isset($_POST["alumnos"]) && $datosAlumnos["cod_alu"] == $_POST["alumnos"]) {
                echo "<option selected value='".$datosAlumnos["cod_alu"]."'>".$datosAlumnos["nombre"]."</option>";
                $nombreAlumno = $datosAlumnos["nombre"];
            }else{
                echo "<option value='".$datosAlumnos["cod_alu"]."'>".$datosAlumnos["nombre"]."</option>";
            }
            
        }
        echo "</select>";
        echo "<button type='submit' name ='btnNotas' >Ver notas</button>";
        echo "</form>";

    }else{
        echo "En estos momentos no tenemos nungún alumno registrado en la BD";
    }
    
    ?>