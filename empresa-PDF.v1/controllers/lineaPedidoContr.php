
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
    private $email;
    private $numemp;
    private $nomemp;

    

    public function __construct($numcomanda='', $lin_com ='',$codprod='',$quant='',$import='',$email='') {
                $this->numcomanda = $numcomanda;
                $this->lin_com = $lin_com;
                $this->codprod = $codprod;
                $this->quant = $quant;
                $this->import = $import;
                $this->email = $email;
                } 
    public function __destruct() { 
//            echo "Se ha destruido el registro";
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
   public function getEmail() {
        return $this->email;
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
public function setEmail($email) {
        $this->email = $email;
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

public function enviaEmail(){
                /*use PHPMailer\PHPMailer\PHPMailer;
                  use PHPMailer\PHPMailer\Exception;
                  use PHPMailer\PHPMailer\SMTP;*/
    
                require '../../PHPMailer/src/Exception.php';
                require '../../PHPMailer/src/PHPMailer.php';
                require '../../PHPMailer/src/SMTP.php';
                
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                $mail->isSMTP();
                $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPAuth = true;
                $mail->Username = 'foap408@gmail.com';
                $mail->Password = 'dyrv alyq ojiq acyd';
                $mail->addAddress($this->email, $this->nom);
        //      $mail->addAddress('beluca.navarrina@gmail.com', 'Beluca');
                $mail->Subject = "Su factura Foap2023-OOP";
    
            //Replace the plain text body with one created manually
            //Para enviar texto plano     
                
                $mail->Body = "Hola $this->nom, Adjunto su factura correspondienta a su pedido $this->numcomanda.\n\Atentamente,\n\nFoap2023-OOP";
                $mail->addAttachment('../invoicesPDF/'.$numcomanda.'.pdf');
    
                $err = 0;
                if (!$mail->send()) {
                    echo 'Mailing Error: ' . $mail->ErrorInfo;
                    $err = 1;
                } else {
                    echo 'Message sent!';
                }
                return $err;
            }    

    }            
        
?>    
