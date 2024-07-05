
<?php
   

    echo 'Creando instancia de registro <br>';
    require "../modelo/connection.php";
    require "../modelo/tablaUsuarios.php";
    
    $printUsuarios= new tablaUsuarios();
    $printUsuarios->getUsuarios();
    
              
   

    
?>
