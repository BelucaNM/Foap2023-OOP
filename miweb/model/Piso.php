<?php
class Piso extends Connection {
    private $tablaNombre = "pisos";
    public $tablaNumReg = 0;

  // Método para leer todos los registros
    public function getTodos() {
            
        $result = true;
        $stmt = $this->connect()->prepare("Select idPis, uidpis, tipus, numHabitacions, numLavabos, users_uid from ". $this->tablaNombre);
        $result = $stmt->execute();
        $this->tablaNumReg = $stmt->rowCount();
        return $stmt->fetchAll();
        } 
        
  protected function setPiso($uidpis, $tipus, $numHabitacions, $numLavabos,  $users_uid){
        $error = 0;
        $stmt = $this->connect()->prepare("INSERT INTO pisos (uidpis, tipus, numHabitacions, numLavabos, users_uid) VALUES (?,?,?,?,?)");
   
        if(!$stmt->execute(array($uidpis, $tipus, $numHabitacions, $numLavabos, $users_uid))){
              $error = 1;
        }
        $stmt = null;
        return $error;
  
      }
protected function checkPiso($uidpis){
      $error = 0;
      $stmt = $this->connect()->prepare("SELECT uidpis FROM pisos WHERE uidpis = ? ");
      if(!$stmt->execute(array($uidpis))){
                $error = 1;
                }
      if($stmt->rowCount()>0){
                $error = 2;
                }
      $stmt = null;
      return $error;
      }

protected function deletePiso($uidpis){
            $error = 0;
            $stmt = $this->connect()->prepare("DELETE FROM pisos WHERE uidpis = ? ");
            if(!$stmt->execute(array($uidpis))){
                  $error = 1;
                  }
            
            $stmt = null;
            return $error;
      }

}
?>
