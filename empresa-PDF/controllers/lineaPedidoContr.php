
<?php
class lineaPedidoContr extends lineaPedido {
    private $numcomanda;
    private $lin_com;
    private $codprod;
    private $quant;
    private $import;
    private $descr;
    private $numclie;
    private $nom;

    

    public function __construct($numcomanda, $lin_com ='',$codprod='',$quant='',$import='') {
                $this->numcomanda = $numcomanda;
                $this->lin_com = $lin_com;
                $this->codprod = $codprod;
                $this->quant = $quant;
                $this->import = $import;
                } 
    public function __destruct() { 
            echo "Se ha destruido el registro";
            }
    public function getNumComanda() {
            return $this->numcomanda;
            }
    public function getLin_com() {
            return $this->lin_com;
            }
    public function getCodProd() {
             return $this->codprod;
            }
    public function getQuant() {
            return $this->quant;
            }
    public function getImport() {
            return $this->import;
            }
    public function setNumComanda($numcomanda) {
            $this->numcomanda = $numcomanda;
            }
    public function setLin_com($lin_com) {
            $this->lin_com = $lin_com;
            }
   public function setCodProd($codProd) {
            $this->codProd = $codProd;
            }
   public function setQuant($quant) {
            $this->quant = $quant;
            }
   public function setImport($import) {
         $this->import = $import;
                }
//
   public function getDescr() {
        return $this->descr;
       }
   public function getNumclie() {
       return $this->numclie;
       }
   public function getNom() {
       return $this->nom;
       }
   public function setDescr($descr) {
        $this->descr = $descr;
        }
  public function setNumClie($numclie) {
        $this->numclie = $numclie;
        }
  public function setNom($nom) {
        $this->nom = $nom;
        }

public function consultaLineasPedido() {

        $result = $this->leerLineas($this->numcomanda);

        if ($result[0] == 1) {
            echo " Ejecución stmt incorrecta";
            header ("location: ../views/introducirPedido.html?error=FailedStmt");
        exit();
        }
        if ($result[0] == 2) { 
            echo " El pedido no tiene lineas";
            header ("location: ../views/introducirPedido.html?error=noOrderLines"); 
            exit();
        }
        return $result[1];
        }


public function consultaLineas() {

        $result = $this->leerLineas($this->numcomanda);
        
        if ($result[0] == 1) {
                echo " Ejecución stmt incorrecta";
                header ("location: ../views/introducirPedido.html?error=FailedStmt");
                exit();
                }
        if ($result[0] == 2) { 
                echo " El pedido no tiene lineas";
                header ("location: ../views/introducirPedido.html?error=noOrderLines"); 
                exit();
                }
        return $result[1];
        }

public function consultaPedido() {
        $result = $this->leerPedido($this->numcomanda);
        if ($result[0] == 1) {
                echo " Ejecución stmt incorrecta";
                header ("location: ../views/introducirPedido.html?error=FailedStmt");
                exit();
                }
        if ($result[0] == 2) { 
                echo " El pedido no corresponde a ningun cliente actual";
                header ("location: ../views/introducirPedido.html?error=noRefCostumer"); 
                exit();
                }
        return $result[1];
}






public function validate_input($input)
            { // sanear datos
                $input = trim($input);
                $input = htmlspecialchars($input);
                $input = stripslashes($input);
                return $input;

            }

    

    }            
        
?>    
