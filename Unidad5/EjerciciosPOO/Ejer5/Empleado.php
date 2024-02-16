<?php
// creacion de una clase

class Empleado{
    // propiedades
    private $nombre, $sueldo;

    // Constructor
    public function __construct($nombreNuevo,$sueldoNuevo){
        $this->nombre = $nombreNuevo;
        $this->sueldo = $sueldoNuevo;
    }

    // setters
    public function setSueldo($sueldoNuevo){
        $this->sueldo = $sueldoNuevo;
    }

    public function setNombre($nombreNuevo){
        $this->nombre = $nombreNuevo;
    }

    // getters
    public function getSueldo(){
        return $this->sueldo;
    }
    public function getNombre(){
        return $this->nombre;
    }

    // metodo para imprimir los datos
    public function datos(){
                
        if ($this->sueldo>3000) {
            echo "<p>El empleado ".$this->nombre." debe pagar impuesto</p>";
        }else{
            echo "<p>El empleado ".$this->nombre." no debe pagar impuesto</p>";
        }
    }


}


?>