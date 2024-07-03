
<?php
class calculadora {
        private $numero1;
        private $numero2;
        private $operacion;
        
            
            
        public function __construct($int1, $int2, $operacion) {
                $this->numero1 = $int1;
                $this->numero2 = $int2;
                $this->operacion = $operacion;
                }       

        public function __destruct() { 
                echo "Se ha destruido la calculadora";
                }
             
        public function suma() {
            return $this->numero1 + $this->numero2; 
            }
        public function resta() {
                return $this->numero1 - $this->numero2; 
            }
        public function producto() {
            return $this->numero1 * $this->numero2; 
            }
        public function division() {
            if ($this->numero2 == 0) {return null;
            }else {return $this->numero1 / $this->numero2;
            };
            }
        public function calcular () {
                if (empty( $this->numero1 ) || empty( $this->numero2 )) {return null;};
                If ($this->operacion == 'suma') {return $this->suma();};
                If ($this->operacion == 'resta') {return $this->resta();};
                If ($this->operacion == 'producto') {return $this->producto();};
                If ($this->operacion == 'division') {return $this->division();};
                   
                } 
};  

           
    
?>    
