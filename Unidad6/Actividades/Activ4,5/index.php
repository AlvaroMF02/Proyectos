<?php
require "src/ctes_funciones.php";

// Funcion para la conexion a la API
define("DIR_SERV", "http://localhost/Proyectos/Unidad6/Actividades/Activ3(CambiarErrores)/login_restful");

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


if(isset($_POST["btnContEditar"]))
{
    //Errores cuándo edito
    $error_nombre=$_POST["nombre"]=="" || strlen($_POST["nombre"])>30;
    $error_usuario=$_POST["usuario"]==""|| strlen($_POST["usuario"])>20;
    if(!$error_usuario)
    {
        try{
            $conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
            mysqli_set_charset($conexion,"utf8");
        }
        catch(Exception $e)
        {
            die(error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p>"));
        }
        $error_usuario=repetido_editando($conexion,"usuarios","usuario",$_POST["usuario"],"id_usuario",$_POST["btnContEditar"]);
            
         if(is_string($error_usuario))
            die($error_usuario);
    }
    $error_clave=strlen($_POST["clave"])>15;
    $error_email=$_POST["email"]=="" || strlen($_POST["email"])>50 || !filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);
    if(!$error_email)
    {
        if(!isset($conexion))
        {
            try{
                $conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
                mysqli_set_charset($conexion,"utf8");
            }
            catch(Exception $e)
            {
                die(error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p>"));
            }
        }
        $error_email=repetido_editando($conexion,"usuarios","email",$_POST["email"],"id_usuario",$_POST["btnContEditar"]);
        
        if(is_string($error_email))
            die($error_email);
    }

    $error_form=$error_nombre||$error_usuario||$error_clave||$error_email;

    if(!$error_form)
    {
        try{

            if($_POST["clave"]=="")
                $consulta="update usuarios set nombre='".$_POST["nombre"]."', usuario='".$_POST["usuario"]."', email='".$_POST["email"]."' where id_usuario='".$_POST["btnContEditar"]."'";
            else
                $consulta="update usuarios set nombre='".$_POST["nombre"]."', usuario='".$_POST["usuario"]."', clave='".md5($_POST["clave"])."', email='".$_POST["email"]."' where id_usuario='".$_POST["btnContEditar"]."'";
            
            mysqli_query($conexion,$consulta);
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No se ha podido hacer la consulta: ".$e->getMessage()."</p>"));
        }
        
        mysqli_close($conexion);

        header("Location:index.php");
        exit;
        
    }

}

if(isset($_POST["btnContBorrar"]))          // ME SALE METHOD NOT ALLOWED WTF
{
    $url = DIR_SERV . "/borrarUsuario/" . urlencode($_POST["btnContBorrar"]);
    $respuesta = consumir_servicios_REST($url,"DELETE");
    $obj = json_decode($respuesta);

    if(!$obj) echo "Error en la API:" .$respuesta;
    if(isset($obj->error)) echo "Error en la consulta:" . $obj->error;
    
    // header("Location:index.php");
    // exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1º CRUD</title>
    <style>
        table,td,th{border:1px solid black}
        table{border-collapse:collapse;text-align:center}
        th{background-color:#CCC}
        table img{width:50px;}
        .enlace{border:none;background:none;cursor:pointer;color:blue;text-decoration:underline}
        .error{color:red}  
    </style>
</head>
<body>
    <h1>Listado de los usuarios</h1>
    <?php
    require "vistas/vista_tabla.php";

    if(isset($_POST["btnDetalle"]))
    {
        require "vistas/vista_detalle.php";
    }
    elseif(isset($_POST["btnBorrar"]))
    {
        echo "<p>Se dispone usted a borrar a usuario <strong>".$_POST["nombre_usuario"]."</strong></p>";
        echo "<form action='index.php' method='post'>";
        echo "<p><button type='submit' name='btnContBorrar' value='".$_POST["btnBorrar"]."'>Continuar</button> ";
        echo "<button type='submit'>Atrás</button></p>";
        echo "</form>";
    }
    elseif(isset($_POST["btnEditar"]) || isset($_POST["btnContEditar"]) )
    {
       require "vistas/vista_editar.php";
    }
    else
    {
        echo "<form action='usuario_nuevo.php' method='post'>";
        echo "<p><button type='submit' name='btnNuevoUsuario'>Insertar nuevo Usuario</button></p>";
        echo "</form>";
    }
    
    mysqli_close($conexion);

    ?>
</body>
</html>