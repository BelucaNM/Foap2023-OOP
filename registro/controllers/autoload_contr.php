
<?php

spl_autoload_register ('myAutoloadControler');

function myAutoloadControler($classname){
    $extension = ".php";
    $path = "../controllers/";

    $fullpath= $path.$classname.$extension;

    if (file_exists($fullpath)) { require_once $fullpath;}
    else { echo "No existe el archivo ".$fullpath;} ; 

}

?>