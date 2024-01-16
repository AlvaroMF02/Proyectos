<?php

class Pelicula{
    
    private $titulo;
    private $anio;
    private $director;
    private $alquilado;
    private $precio;
    private $fechaDevol;

    // constructor
    public function __construct($titulo,$anio,$director,$alquilado,$precio,$fechaDevol){
        $this->titulo = $titulo;
        $this->anio = $anio;
        $this->director = $director;
        $this->alquilado = $alquilado;
        $this->precio = $precio;
        $this->fechaDevol = $fechaDevol;
    }


    // Getters
    public function getTitulo(){
        return $this->titulo;
    }
    public function getAnio(){
        return $this->anio;
    }
    public function getDirector(){
        return $this->director;
    }
    public function getAlquilado(){
        return $this->alquilado;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getFechaDevol(){
        return $this->fechaDevol;
    }

    // Setters
    public function setTitulo($tituloNuevo){
        $this->titulo = $tituloNuevo;
    }
    public function setAnio($anioNuevo){
        $this->anio = $anioNuevo;
    }
    public function setDirector($directorNuevo){
        $this->director = $directorNuevo;
    }
    public function setAlquilado($alquiladoNuevo){
        $this->alquilado = $alquiladoNuevo;
    }
    public function setPrecio($precioNuevo){
        $this->precio = $precioNuevo;
    }
    public function setFechaDevol($fechaDevolNuevo){
        $this->fechaDevol = $fechaDevolNuevo;
    }


    // Metodo para ver el nombre de la película
    public function nombrePelicula(){
        echo "El nombre de la película es: ".$this->titulo;
    }

    // Metodo para ver el año y el director
    public function AnioYDirector(){
        echo "La fecha de salida fue: ".$this->anio." y el director fue ".$this->director;
    }

    // Metodo para el precio
    public function precio(){
        echo "El precio es de: ".$this->precio . "€";
    }

    // Metodo ver si esta alquilada
    public function estadoAlquiler(){
        if ($this->alquilado) {
            echo "Esta película está alquilada";
        }else{
            echo "Esta película no está alquilada";
        }
    }
    
    // Metodo para ver la fecha prevista de devolucion
    public function fechaParaLaDevolucion(){
        echo "La fecha en la que se debe devolver la película es: ".$this->fechaDevol;
    }

    // Metodo para calcular el recargo por retraso en la devolucion 1,2 por dia
    public function multa(){
        if(time()>$this->fechaDevol){
            echo "Lleva multa";
        }else{
            echo "No lleva multa";
        }
    }


}

?>