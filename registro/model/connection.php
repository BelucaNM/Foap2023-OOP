
<?php
class connection {

        protected function connect(){
            try {
                $conn = new PDO('mysql:host=localhost;dbname=blogoop','root','');
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return $conn;
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage()."<br>";
            }


        }
    }     
?>    