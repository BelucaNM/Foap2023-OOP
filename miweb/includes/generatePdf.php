<?php
echo 'Creando instancia de tabla de pisos <br>';
require "../model/connection.php";
require "../model/piso.php";
require "../model/pisoContr.php";

$PisoContr = new PisoContr();
echo "PisoContr <br>";

$todos= $PisoContr->getTodos();
echo "<br> todos <br>";

if ($todos == 1 ) { // error STMT
        echo "Error al obtener todos los usuarios <br>";
        $num=0;
    } else {
        print_r($todos);
        $num = $repUsuarios->tablaNumReg;
        echo " Hay ".$num." registros.<br>";
    }
    ?>
<html>

<head>
    <title> Lista Pisos </title>
    <meta charset="utf-8" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</head>

<body>
<h1> Ejercicio ListaUsuarios OOP</h1>
<div  id="tablaUsuarios" class = "container"></div>
<table border='1'>
    <thead>
        <tr>
            <th>Piso</th>
            <th>TipoPiso</th>
            <th>Habitaciones</th>
            <th>Lavabos</th>
        </tr>
    </thead>
    <tbody>
<?php
        if($num = 0) {
            echo "No se encontraron pisos.";
        }else{      
        foreach ($todos as $key => $piso) {
                echo "<tr>";
                echo "<td>$piso[uidpis]</td>";
                echo "<td>$piso[tipus]</td>";
                echo "<td>$piso[numHabitacions]</td>";
                echo "<td>$piso[numLavabos]</td>";
                echo "</tr>";
            };
    echo "</tbody>";
echo "</table>";
    }
?>
 </div>
 
</body>
</html>              

