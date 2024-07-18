<?php 

class PisoContr extends Piso{
    private $idpis;
   
    private $uidpis;
    private $tipus;
    private $numHabitacions;
    private $numLavabos;
    private $users_users_id;

    public function __construct($uidpis ="" ,$tipus="", $numHabitacions="", $numLavabos="", $users_users_id=""){
        $this->uidpis = $uidpis;
        $this->tipus = $tipus;
        $this->numHabitacions = $numHabitacions;
        $this->numLavabos = $numLavabos;
        $this->users_users_id = $users_users_id;

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

        if (!$this->setPiso($this->uidpis, $this->tipus, $this->numHabitacions, $this->numLavabos, $this->users_users_id)) { // en usuario.php
            echo " el stmt es incorrecto";
            header ("location: ../view/noupis.php?error=FailedStmt");
            exit();
        }
        //Volver a la pagina inicial--- 
        header("Location: ../view/noupis.php?error=none");
    }
}

private function emptyInput(){
        $result = false;
        if (empty($this->uidpis) || empty($this->tipus) || empty($this->numHabitacions) || empty($this->numLavabos)){
/*          echo $this->uidpis;
            echo $this->tipus;
            echo $this->numHabitacions;
            echo $this->numLavabos;
            $result = true; 
*/
        }
        return $result;
    }    



}
