<?php
class piso extends Connection {
    private $tablaNombre = "pisos";
    public $tablaNumReg = 0;

  // Método para leer todos los registros
    public function getTodos() {
            
        $result = true;
        $stmt = $this->connect()->prepare("Select uidpis, tipus, numHabitacions, numLavabos from ". $this->tablaNombre);
        $result = $stmt->execute();
        $this->tablaNumReg = $stmt->rowCount();
        return $stmt->fetchAll();
        }   

}
?>
