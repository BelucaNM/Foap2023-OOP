
<?php
class connection {

        protected function connect(){
            try {
                $con = new PDO ("mysql:host= localhot ; dbname='usuariosOBJ'",'root','');
                return $con;
            } catch (PDOException $e) {
             return "Error: " . $e->getMessage()."<br>";
            }


        }
}     
?>    