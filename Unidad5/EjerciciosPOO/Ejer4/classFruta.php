<?php
// creacion de una clase

class Fruta{
    // propiedades
    private $color, $tamanyo;
    
    // definir instancias
    private static $n_frutas = 0;

    // Constructor
    public function __construct($colorNuevo,$tamanyoNuevo){
        $this->color = $colorNuevo;
        $this->tamanyo = $tamanyoNuevo;

        // cada vez que cree una fruta subirá el contador
        self::$n_frutas++;
    }

    // Destructor
    public function __destruct(){
        // cada vez que se borre se resta
        self::$n_frutas--;
    }

    // setters
    public function setColor($colorNuevo){
        $this->color = $colorNuevo;
    }

    public function setTamanyo($tamanyoNuevo){
        $this->tamanyo = $tamanyoNuevo;
    }

    // getters
    public function getColor(){
        return $this->color;
    }
    public function getTamanyo(){
        return $this->tamanyo;
    }

    // metodo para ver cuanta fruta hay
    public static function cuantaFruta(){
        return self::$n_frutas;
    }


    // metodo para imprimir
    private function imprimir(){
        echo "<p><strong>Color: </strong>".$this->color."<br><strong>Tamaño: </strong>".$this->tamanyo."</p>";
    }


}


?>