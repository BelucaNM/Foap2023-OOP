<?php
echo 'Creando instancia de tabla de Pedidos <br>';
require "../model/connection.php";
require "../model/lineaPedido.php";

$lineaPedido = new lineaPedido();
echo "repPedidos <br>";
print_r($lineaPedido);
$todos= $lineaPedido->getTodos();
echo "<br> todos <br>";

if ($todos == 1 ) { // error STMT
        echo "Error al obtener todos los usuarios <br>";
        $num=0;
    } else {
        print_r($todos);
//        $num = $repUsuarios->tablaNumReg;
//        echo " Hay ".$num." registros.<br>";
    }
    ?>
<html>

<head>
    <title> Login ejercicio OOP Selecciona Pedidos </title>
    <meta charset="utf-8" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</head>

<body>
<h1> Ejercicio ListaPedidos OOP</h1>

<div  id="pedidosDesplegable" class ="container">
<form  method="get" action = "../includes/testpdf_php.php">


    <div> 

        <label for="pedido">Seleccione Pedido</label>
        <select name="numcomanda" id="numcomanda">

    <?php
        foreach ($todos as $comanda) {
        echo"<option value=$comanda[numcomanda]>$comanda[numcomanda]</option>";
        };
    ?>
        </select>
    </div>
    <div class="form-floating mb-1 mt-1">    
                    <input class="btn btn-primary" type="submit" name= "submit" value="Submit"> 
            <!-- > value es el txt que muestra el boton. Es "Enviar" por defecto. 
                    El indice en el POST es el name <-->
    </div>
</form>
</div>
 
</body>
</html>              

