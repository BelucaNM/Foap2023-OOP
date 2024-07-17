
<?php
class pedido extends connection {
    private $numcomanda;
    
    
    public function getnumcomanda() {
        return $this->numcomanda;
        }
    public function setnumcomanda($numcomanda) {
        $this->numcomanda = $numcomanda;
        }
    

    public function __construct($numcomanda=""){
                $this->numcomanda = $numcomanda;
                } 
    public function __destruct() { 
//            echo "Se ha destruido el registro";
            }
    

    public function leerLineas() {
            
            $error=0;
            $array = array();
            $stmt = $this->connect()->prepare(
            "SELECT l.numcomanda as numcomanda, l.lin_com as lin_com, l.codprod as codprod, l.quant as quant,
                    l.import as import, p.descr as descr, p.preu as preu 
            FROM linia_comanda as l 
            JOIN productes as p WHERE l.codprod= p.codprod and l.numcomanda = ?");

            if (!$stmt->execute(array($this->numcomanda))){
                $error = 1;
            }else{
                if( $stmt->rowCount() >0) {
                    $result = $stmt->fetchAll();
//                    print_r($result);
                    $array[1] = $result;
                }else{
                    $error = 2;
                }
            };
            $array[0] =$error;
            $stmt = null;
            return $array;
        }
    public function leerPedido() {
            
        $error=0;
        $stmt = $this->connect()->prepare("SELECT 
                                            co.data as datacomanda, 
                                            co.clie as numclie, 
                                            co.import_total as importtotal,
                                            co.rep_ven as numemp,
                                            c.nom  as nomclie, 
                                            c.email as emailclie, 
                                            e.nom as nomven
                                            FROM comanda as co 
                                            JOIN clients as c on c.numclie = co.clie 
                                            JOIN empleats as e on co.rep_ven = e.numemp 
                                            WHERE numcomanda = ?");
                                        
        if (!$stmt->execute(array($this->numcomanda))){
                $error = 1;
        }else{
                if( $stmt->rowCount() >0) {
                    $result = $stmt->fetchAll();
                    print_r($result);
                    
                    $array[1] =$result[0];

                }else{
                    $error = 2;
                }
        };
        $array[0] =$error;
        $stmt = null;
        return $array;
    
        }
    public function getTodos() {
        
        $error=0;    
        $result = true;
        $stmt = $this->connect()->prepare("SELECT numcomanda  from comanda");
        $result = $stmt->execute();
        if (!$result){
                return 1;
            }else{
                return $stmt->fetchAll();
            }

        }  
              

} 
           
?>