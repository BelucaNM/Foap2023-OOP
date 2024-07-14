<?php
class tablaUsuarios extends usuario {
    private $tablaNombre = "usuarios";
    public $tablaNumReg = 0;

  // Método para leer todos los registros
    public function getTodos() {
            
        $result = true;
        $stmt = $this->connect()->prepare("Select idUsuario, username, password, email, recordar from ". $this->tablaNombre);
        $result = $stmt->execute();
        $this->tablaNumReg = $stmt->rowCount();
        return $stmt->fetchAll();
        }   

}
?>
