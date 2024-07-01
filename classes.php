<?php

class Person {
//    public $nom;
    private $nom;
    private $edat;
    private $genere;
    protected $DNI;
    private $direccio;
    protected $pes;


    public function __construct($nom, $edat, $genere, $DNI, $direccio, $pes) {
        $this->nom = $nom;
        $this->edad = $edat;
        $this->genero = $genere;
        $this->DNI = $DNI;
        $this->direccio = $direccio;
        $this->peso = $pes;
    }
    public function __destruct() { // aqui no tiene mucho sentido. En acceso a BD se usa para desconectar
        echo "Se ha destruido la clase Person";
    }
    public function saludar (){
        echo 'Hola '.$this->nom; // con $this accedo a la clase

    }
    public function setEdat($edat){
        $this->edat = $edat; 

    }
    public function getEdat(){
        return $this->edat ; 

    }

};

class Client extends Person {
//    private $limiteCredito;
//    private $numCuenta;
/*    public function getCredito(){
      return $this->limiteCredito;
    }*/ 
    public function asignarAgente(){
        echo "Se ha asignado un agente al cliente ". $this->DNI.'<br>';
//        echo "Se ha asignado un agente al cliente ". parent::$DNI.'<br>'; // hay que ver los STATICS

    }

}
class Empleat extends Person {
    private $oficina;

    public function setOficina ($oficina){
        $this->oficina = $oficina;
    }
    public function getOficina(){
        return $this->oficina;
    }
}
class Coche{
   
        private $modelo;
        private $matricula;
        private $puertas;
        private $color;
    
        public function __construct($modelo, $matricula, $puertas, $color) {
            $this->modelo = $modelo;
            $this->matricula = $matricula;
            $this->puertas = $puertas;
            $this->color = $color;
        }
/* si se quiere poner argumentos por defecto
    public function __construct($modelo='', $matricula='', $puertas='', $color='') {....}
*/


        public function __destruct() { // aqui no tiene mucho sentido. En acceso a BD se usa para desconectar
            echo "Se ha destruido la clase Coche <br>";
        }
        public function saludar (){
            echo 'Hola soy '.$this->matricula .' <br>'; // con $this accedo a la clase
    
        }
        
        public function setColor($color){
            $this->color = $color; 
        }
            
        public function setModelo($modelo){
            $this->modelo = $modelo; 
        }
            
        public function setMatricula($matricula){
            $this->matricula = $matricula; 
        }

        public function setPuertas($puertas){
            $this->puertas = $puertas; 
    
        }
        public function getModelo(){
            return $this->modelo ; 
    
        }
        public function getMatricula(){
            return $this->matricula ; 
    
        }
        public function getPuertas(){
            return $this->puertas ; 
    
        }
        public function getColor(){
            return $this->color ; 
    
        }
        public function arranca(){
            echo "Se ha arrancado el coche  <br>";
    
        }
        public function para(){
            echo "Se ha parado el coche  <br>";
    
        }
    }
    
 
/*
$persona1 = new  Person();
$persona1->nom = 'Ikram';// no daria  error si es public
$persona1->edad = 37; // da error porque no se puede acceder a un atributo privado
$persona1->peso = 80;// da error porque no se puede acceder a un atributo protected

*/

?>