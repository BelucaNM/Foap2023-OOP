<?php 

class PisoContr extends Piso{
    private $idpis;
   
    private $uidpis;
    private $tipus;
    private $numHabitacions;
    private $numLavabos;
    private $users_uid;

public function __construct($uidpis ="" ,$tipus="", $numHabitacions="", $numLavabos="", $users_uid=""){
        $this->uidpis = $uidpis;
        $this->tipus = $tipus;
        $this->numHabitacions = $numHabitacions;
        $this->numLavabos = $numLavabos;
        $this->users_uid = $users_uid;

    }

    /**Setters and getters */
    public function setuidpis($uidpis){
         $this->uidpis = $uidpis;
    }
    public function getuidpis(){
        return $this->uidpis;
    }
    //rellenar
    /*** */
    
Public function altaPiso(){
        
        if ($this->emptyInput() == true){
            echo " la entrada es vacia";
            header ("location: ../view/noupis.php?error=EmptyInput"); 
            exit();
            }
        
        $result = $this->checkPiso($this->uidpis); // 
            if ($result == 2) {
                    echo " el uid único ya existe";
                    header ("location: ../view/noupis.php?error=uidTaken");
                    exit();
                } else  {if ($result == 1) {
                    echo " el stmt es incorrecto";
                    header ("location: ../view/noupis.php?error=FailedStmt");
                    exit();
                }
        //setPiso to BD
        
        $result =$this->setPiso($this->uidpis, $this->tipus, $this->numHabitacions, $this->numLavabos, $this->users_uid);
        echo $result;
        if ($result == 1) { // en usuario.php
            header ("location: ../view/noupis.php?error=FailedStmt");
            exit();
        }
        //Volver a la pagina inicial--- 
        header("Location: ../view/noupis.php?error=none");
    }
}

private function emptyInput(){
        $result = false;
        if (empty($this->uidpis) || empty($this->tipus) || empty($this->numHabitacions) || empty($this->numLavabos)
        || empty($this->users_uid)){
/*          echo $this->uidpis;
            echo $this->tipus;
            echo $this->numHabitacions;
            echo $this->numLavabos;
*/
            $result = true; 

        }
        return $result;
    }  
    
Public function borraPiso(){
       
        $result =$this->deletePiso($this->uidpis);
        echo $result;
        if ($result == 1) { // en usuario.php
            header ("location: ../view/pisos.php?error=FailedStmt");
            exit();
        }
        //Volver a la pagina inicial--- 
        header("Location: ../view/pisos.php?error=none");
    }
}

?>
