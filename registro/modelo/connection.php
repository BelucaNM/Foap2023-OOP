
<?php
class connection {

        protected function connect(){
            try {
                $conn = new PDO('mysql:host=localhost;dbname=usuariosoop','root','');
                return $conn;
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage()."<br>";
            }


        }
    }     
?>    