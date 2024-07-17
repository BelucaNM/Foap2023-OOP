
<?php
class pedido extends connection {
    private $numcomanda;
    private $numclie;
    private $nomclie;
    private $emailclie;
    private $numemp;
    private $nomemp;
    private $dataComanda;
    private $importTotal;
    private $formatoInvoice_php;

    

    public function __construct($numcomanda, $formatoInvoice){
                $this->numcomanda = $numcomanda;
                $this->formatoInvoice = $formatoInvoice;
                } 
    public function __destruct() { 
//            echo "Se ha destruido el registro";
            }
    public function getnumcomanda() {
            return $this->numcomanda;
            }
    public function setnumcomanda($numcomanda) {
            $this->numcomanda = $numcomanda;
            }
   public function getnumclie() {
       return $this->numclie;
       }
    public function setnumClie($numclie) {
        $this->numclie = $numclie;
        }
   public function getnomclie() {
       return $this->nomclie;
        }
   public function setnomclie($nomclie) {
        $this->nomclie = $nomclie;
        }
   public function getemailClie() {
        return $this->emailclie;
         }
   public function setemailClie($emailclie) {
        $this->emailclie = $emailclie;
        }
    public function getnumemp() {
        return $this->numemp;
        }
    public function setnumemp($numemp) {
        $this->numemp = $numemp;
        }
    public function getnomemp() {
            return $this->nomemp;
            }
    public function setnomemp($nomemp) {
            $this->nomemp = $nomemp;
            }
    public function getdataComanda() {
        return $this->dataComanda;
        }
    public function setdataComanda($dataComanda) {
        $this->dataComanda = $dataComanda;
        }
    public function getimportTotal() {
            return $this->importTotal;
            }
    public function setimportTotal($importTotal) {
            $this->importTotal = $importTotal;
            }
    public function getformatoInvoice_php() {
        return $this->formatoInvoice_php;
        }
    public function setformatoInvoice_php($formatoInvoice_php) {
        $this->formatoInvoice_php = $formatoInvoice_php;
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
                                            co.data as dataComanda, 
                                            co.clie as numClie, 
                                            co.import_total as import_total,
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
//                    print_r($result);
                    $array[1] =$result;

                    $this->setnumcomanda=$array[1]['dataComanda'];
                    $this->setnumClie=$array[1]['numClie']; 
                    $this->setnomclie=$array[1]['nomclie'];
                    $this->setemailClie=$array[1]['emailclie'];
                    $this->setnumemp=$array[1]['numemp'];
                    $this->setnomemp=$array[1]['nomven'];
                    $this->setimportTotal=$array[1]['import_total'];

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