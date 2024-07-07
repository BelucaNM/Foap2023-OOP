<?php
echo 'Creando instancia de tabla de Usuarios <br>';
require "../modelo/connection.php";
require "../modelo/usuario.php";
require "../modelo/tablaUsuarios.php";
$repUsuarios = new tablaUsuarios();
echo "repUsuarios <br>";
print_r($repUsuarios);
$todos= $repUsuarios->getTodos();
echo "<br> todos <br>";
print_r($todos);
$num = $repUsuarios->tablaNumReg;
echo " Hay ".$num." registros.<br>";
?>
<html>

<head>
    <title> Login ejercicio OOP </title>
    <meta charset="utf-8" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</head>

<body>
<h1> Ejercicio ListaUsuarios OOP</h1>
<div  id="tablaUsuarios" class = "container"></div>
<table border='1'>
    <tr>
    <th>ID</th>
    <th>Username</th>
    <th>email</th>
    </tr>

<?php
    if($num = 0) {
        echo "No se encontraron usuarios.";
    }else{      
       foreach ($todos as $key => $usuario) {
            echo "<tr>";
            echo "<td>$usuario[idUsuario]</td>";
            echo "<td>$usuario[username]</td>";
            echo "<td>$usuario[email]</td>";
            echo "</tr>";
        };
       echo "</table>";
    }
?>
 </div>
</body>
</html>              

