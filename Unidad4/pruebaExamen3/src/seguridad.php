<?php
// abro conexion con el servidor
try{
    $conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion,"utf8");
}
catch(Exception $e)
{
    session_destroy();
    die(error_page("Examen3 Curso 17-18","<h1>Video Club</h1><p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p>"));
}

// cojo todos los datos del usuario que coincida con la contraseña (solo va a devolver uno)
try{
   $consulta="select * from usuarios where usuario='".$_SESSION["usuario"]."' and clave='".$_SESSION["clave"]."'";
   $resultado=mysqli_query($conexion, $consulta);
}
catch(Exception $e)
{
    session_destroy();
    mysqli_close($conexion);
    die(error_page("Examen3 Curso 17-18","<h1>Video Club</h1><p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}

// si no se ha conseguido ninguna tupla
// quiere decir que el usuario no esta en la bd
if(mysqli_num_rows($resultado)<=0){

    // suelta resultado y cierra la conexion
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    session_unset();
    $_SESSION["seguridad"]="Usted ya no se encuentra registrado en la BD";
    header("Location:".$salto);
    exit;
}

// aqui se ha encontrado unna tupla y 
// la guardamos en una variable
$datos_usuario_logueado=mysqli_fetch_assoc($resultado);
mysqli_free_result($resultado);


// control de inactividad
if(time()-$_SESSION["ultima_accion"]>MINUTOS_INACT*60){
    
    mysqli_close($conexion);
    session_unset();
    $_SESSION["seguridad"]="Su tiempo de sesión ha caducado";
    header("Location:".$salto);
    exit;
}

$_SESSION["ultima_accion"]=time();

?>