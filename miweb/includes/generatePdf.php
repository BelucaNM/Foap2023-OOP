<?php

    // The Composer autoloader
    
    require_once '../../dompdf/vendor/autoload.php';
    // Reference the Dompdf namespace
    //use Dompdf\Dompdf; 
    // Instantiate and use the dompdf class
    $dompdf = new Dompdf\Dompdf();

    ob_start();

    include '../view/pisos.php'; // si es dinámica , para que el PHP sea interpretado                
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
    $pdf_file_loc = '../printsPDF/listaPisos.pdf';
    // Guardar el PDF generado en la ubicación deseada con un nombre personalizado
    file_put_contents($pdf_file_loc, $pdf_string);
    //echo ' despues de "contents"';

    // Download the generated PDF
    // $dompdf->stream()
    // $dompdf->stream("test", array("Attachment" => 1, "compress" => 0));
    //echo ' despues de "stream"';
           
    
    header("Location: ../view/pisos.php?error=Printed");
 
?>