<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria PDO</title>
</head>

<body>
    <h1>Teoria PDO</h1>
    <?php
    define("SERVIDOR_BD", "localhost");
    define("USUARIO_BD", "jose");
    define("CLAVE_BD", "josefa");
    define("NOMBRE_BD", "bd_foro");

    // CONEXION CON PDO
    try {
        // toda esta sentencia es como la primera parte de la conexion de antes
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        die("<p>Error de conexion: " . $e->getMessage() . "</p></body></html>");
    }


    echo "Conexion realizada con exito";

    // datos de input
    $usuario='varo';
    $clave=md5('1234');

    // HACER LA CONSULTA CON PDO PARA EL LOGIN
    try {
        // consulta con ? como los valores
        $consulta = "select * from usuarios where usuario =? and clave=?" ;
        // conexion es un objeto que tiene este metodo
        $sentencia = $conexion->prepare($consulta);
        // ejecutar la sentencia (pasandole un array)
        $sentencia->execute([$usuario,$clave]);
    } catch (PDOException $e) {
        // liberar los objetos
        $sentencia = null;
        $conexion = null;
        die("<p>No se ha podido hacer la consulta: " . $e->getMessage() . "</p></body></html>");
    }

    if($sentencia->rowCount()<=0){
        echo "<p>No hay usuario con esas credenciales en la bd</p>";
    }else{
        //recoger los datos (con una constante decimos si es assoc, num, object)
        $tupla = $sentencia->fetch(PDO::FETCH_ASSOC);
        echo "<p>El nombre del usuario es ".$tupla['nombre']."</p>";
    }

    // HACER CONSULTA CON PDO PERO CON TODOS LOS DE LA BD
    try {
        $consulta = "select * from usuarios" ;
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();      // no se le pasa nada pq no pasamos ? en la consulta
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        die("<p>No se ha podido hacer la consulta: " . $e->getMessage() . "</p></body></html>");
    }

    if($sentencia->rowCount()<=0){
        echo "<p>No hay usuarios en la bd</p>";
    }else{
        $respuesta = $sentencia->fetch(PDO::FETCH_ASSOC);
        // ahora tengo todos los resultados y los recorro
        foreach($respuesta as $tupla){
            echo "<p>El nombre del usuario es ".$tupla['nombre']."</p>";
        }
    }

    // HACER UN INSERT CON MYSQLI
    $nombre='Pepe Castro';
    $usuario='pepe';
    $clave=md5('1234');
    $email='miau@mail.com';

    try {
        $consulta = "inser into usuarios (nombre,usuario,clave,email) values (?,?,?,?)" ;
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$nombre,$usuario,$clave,$email]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        die("<p>No se ha podido hacer la consulta: " . $e->getMessage() . "</p></body></html>");
    }

    echo "<p>El usuario se ha insertado correctamente con el id".$conexion->lastInsertId()." </p>";

    // liberar los objetos
    $sentencia = null;
    $conexion = null;
    
    ?>
</body>

</html>