
<?php
class pedidoContr extends pedido {
        private $numclie;
        private $nomclie;
        private $emailclie;
        private $numemp;
        private $nomemp;
        private $datacomanda;
        private $importtotal;
        private $formatoinvoice_php;
        

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
            return $this->datacomanda;
            }
        public function setdataComanda($datacomanda) {
            $this->dataComanda = $datacomanda;
            }
        public function getimportTotal() {
                return $this->importtotal;
                }
        public function setimportTotal($importtotal) {
                $this->importTotal = $importtotal;
                }
        public function getformatoInvoice_php() {
            return $this->formatoinvoice_php;
            }
        public function setformatoInvoice_php($formatoinvoice_php) {
            $this->formatoinvoice_php = $formatoinvoice_php;
            }   
    
public function consultaLineas() {

        $result = $this->leerLineas();
        
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

        $result = $this->leerPedido();

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
//        print_r($result);

        $this->setdatacomanda($result[1]['datacomanda']);
        $this->setnumClie($result[1]['numclie']); 
        $this->setnomclie($result[1]['nomclie']);
        $this->setemailClie($result[1]['emailclie']);
        $this->setnumemp($result[1]['numemp']);
        $this->setnomemp($result[1]['nomven']);
        $this->setimportTotal($result[1]['importtotal']);
        return $result[1];
}

public function creaInvoice(){

                $pedido = $this->consultaPedido();
//                print_r($pedido);
                $lineas = $this->consultaLineas();
//                print_r($lineas);

                // The Composer autoloader
                
                require_once '../../dompdf/vendor/autoload.php';
                // Reference the Dompdf namespace
                //use Dompdf\Dompdf; 
                // Instantiate and use the dompdf class
                $dompdf = new Dompdf\Dompdf();

                ob_start();

                include '../includes/invoice.php'; // si es dinámica , para que el PHP sea interpretado                
//                include '$this->formatoinvoice_php'; // si es dinámica , para que el PHP sea interpretado


                $html_file = ob_get_contents();
                ob_end_clean();

                // Load HTML content to generate a PDF

                //$dompdf->loadHtml('<h1 style="color:blue;">AllPHPTricks.com3</h1>');
                // $html_file = file_get_contents("factura.html"); // para contenido estatico
                $dompdf->loadHtml($html_file);

                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'portrait');
                // Render the HTML as PDF
                $dompdf->render();

                // Devuelve el archivo PDF en forma de cadena.
                $pdf_string = $dompdf->output(); 
                // Nombre y ubicación del archivo PDF
                $pdf_file_loc = '../invoicesPDF/'.$this->getnumcomanda().'.pdf';
                // Guardar el PDF generado en la ubicación deseada con un nombre personalizado
                file_put_contents($pdf_file_loc, $pdf_string);
                //echo ' despues de "contents"';

                // Download the generated PDF
                // $dompdf->stream()
                // $dompdf->stream("test", array("Attachment" => 1, "compress" => 0));
                //echo ' despues de "stream"';
                       
                //enviar el pdf por email
                $this->enviaEmail();
                

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
//        $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
        $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = 'foap408@gmail.com';
        $mail->Password = 'dyrv alyq ojiq acyd';
                        
        $mail->addAddress($this->emailclie,$this->nomclie);
//      $mail->addAddress('beluca.navarrina@gmail.com', 'Beluca');
        $mail->Subject = "Su factura Foap2023-OOP";
            
        //Replace the plain text body with one created manually
        //Para enviar texto plano     
                        
        $mail->Body = "Hola ".$this->nomclie.", Adjunto su factura correspondienta a su pedido ". $this->getnumcomanda() .".\n\Atentamente,\n\nFoap2023-OOP";
        $mail->addAttachment('../invoicesPDF/'.$this->getnumcomanda().'.pdf');
            
        $err = $mail->send();
        if (!$err) {
                // echo 'Mailing Error: ' . $mail->ErrorInfo;
                header("Location: ../views/listaPedidos.php?error=MailError");
                exit();
        }else{
                header("Location: ../views/listaPedidos.php?error=MailSent");
                exit();       
        };
} 
}          
?>    
