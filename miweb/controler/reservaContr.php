<?php 

class ReservaContr extends Reserva{
    private $idreservas;
    private $fechaSolicitud;
    private $pisos_idpis;
    private $users_users_uid;

public function __construct($idreservas ="" ,$fechaSolicitud="", $pisos_idpis="", $users_users_uid=""){
        $this->idreservas = $idreservas;
        $this->fechaSolicitud = $fechaSolicitud;
        $this->pisos_idpis = $pisos_idpis;
        $this->users_users_uid = $users_users_uid;


    }

    /**Setters and getters */
    public function setuidpis($idreservas){
         $this->idreservas = $idreservas;
    }
    public function setfechaSolicitud(){
        return $this->fechaSolicitud;
    }
    public function getusers_users_uid(){
        return $this->users_users_uid;
    }
    
    //terminar de rellenar
    /*** */
    
Public function altaReserva(){
        
        if ($this->emptyInput() == true){
            echo " la entrada es vacia";
//            header ("location: ../view/pisos.php?error=EmptyInput"); 
            exit();
            }
        
        
        //set to BD
        
        $result =$this->setReserva($this->pisos_idpis, $this->users_users_uid);
        echo $result;
        if ($result == 1) { // en usuario.php
            header ("location: ../view/pisos.php?error=FailedStmt");
            exit();
        }
        //Volver a la pagina inicial--- 
        header("Location: ../view/pisos.php?error=reservaDone");
    }


private function emptyInput(){
        $result = false;
        echo "emppty";

        echo $this->pisos_idpis;
        echo $this->users_users_uid;

        if ( empty($this->pisos_idpis) || empty($this->users_users_uid) ){
        
            echo $this->pisos_idpis;
            echo $this->users_users_uid;

            $result = true; 

        }
        return $result;
    }  
    

}

?>
