
<?php

print_r($_POST);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']) ){
    $num1 = $_POST['numero1'];
    $num2 = $_POST['numero2'];
    $operacion = $_POST['operacion'];
    echo 'TENEMOS CALCULADORA <br>';
//  require "../controlador/calculadoraControlador.php";
    require "autoload_controlador.php";
    $calculadoraFoap= new calculadora($num1, $num2, $operacion);
    echo 'TENEMOS CALCULADORA <br>';
    echo $calculadoraFoap->calcular().'<br>';
};
 
?>