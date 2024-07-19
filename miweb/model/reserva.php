<?php
class Reserva extends Connection {
    private $tablaNombre = "reservas";
    public  $tablaNumReg = 0;

  // Método para leer todos los registros
    public function getReservas() {
            
        $result = true;
        $stmt = $this->connect()->prepare(
            "Select r.idReservas, r.fechaSolicitud, r.pisos_idPis, r.users_users_uid, p.uidpis from 
            reservas as r
            join pisos as p
            on r.pisos_idPis = p.idPis
            where r.users_users_uid = ?");

        $result = $stmt->execute(array($this->getusers_users_uid()));
        $this->tablaNumReg = $stmt->rowCount();
        return $stmt->fetchAll();
        }
    
        
    protected function setReserva($pisos_idPis, $users_users_uid){
        $error = 0;
        $stmt = $this->connect()->prepare("INSERT INTO reservas ( pisos_idPis, users_users_uid) VALUES (?,?)");
   
        if(!$stmt->execute(array($pisos_idPis, $users_users_uid))){
              $error = 1;
        }
        $stmt = null;
        return $error;
  
      }

}
?>
