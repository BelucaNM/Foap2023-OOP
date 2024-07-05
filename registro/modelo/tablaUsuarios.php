<?php
class tablaUsuarios extends connection {
    private $tablaNombre = "usuarios";

  // Método para leer todos los registros
    public function getUsuarios() {
            
        $result = true;
        $stmt = $this->connect()->prepare("Select id, username, password1, email, recordar from ". $this->tablaNombre);
        $result = $stmt->execute();
        return $result;
        }   

}
?>
