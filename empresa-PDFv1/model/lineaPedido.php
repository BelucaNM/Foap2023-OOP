
<?php
class lineaPedido extends connection {

    protected function leerLineas($numcomanda) {
            
            $error=0;
            $array = array();
            $stmt = $this->connect()->prepare(
            "SELECT l.numcomanda as numcomanda, l.lin_com as lin_com, l.codprod as codprod, l.quant as quant,
                    l.import as import, p.descr as descr, p.preu as preu 
            FROM linia_comanda as l 
            JOIN productes as p WHERE l.codprod= p.codprod and l.numcomanda = ?");

            if (!$stmt->execute(array($numcomanda))){
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
    protected function leerPedido($numcomanda) {
            
        $error=0;
        $stmt = $this->connect()->prepare("SELECT co.data, co.clie, co.import_total, c.nom  as nomclie, c.email as emailclie, e.nom as nomven FROM comanda as co 
                                            JOIN clients as c on c.numclie = co.clie 
                                            JOIN empleats as e on co.rep_ven = e.numemp 
                                            WHERE numcomanda = ?");
                                        
        if (!$stmt->execute(array($numcomanda))){
                $error = 1;
        }else{
                if( $stmt->rowCount() >0) {
                    $result = $stmt->fetchAll();
//                    print_r($result);
                    $array[1] =$result;
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