<?php 

class PisoContr extends Piso{
    private $uidpis;
    private $tipus;
    private $numHabitacions;
    private $numLavabos;

    public function __construct($uidpis ="" ,$tipus="", $numHabitacions="", $numLavabos=""){
        $this->uidpis = $uidpis;
        $this->tipus = $tipus;
        $this->numHabitacions = $numHabitacions;
        $this->numLavabos = $numLavabos;

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

}