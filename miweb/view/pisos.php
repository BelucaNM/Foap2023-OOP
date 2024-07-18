
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Agencia Pisos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    *{
        font-family:Verdana, Geneva, Tahoma, sans-serif;
        }

    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;

    }
    
    .table {
        background-color: white;
        padding: 20px;
        text-align :right;
        font-size: 12px;
        width: 598px;
    }
    th,.fondoGris {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>

<?php
session_start();

if(!isset($_SESSION['user'])){
    echo " la session no ha sido iniciada";
    header("Location: ../index.php");
    exit();
}
if (($_SERVER['REQUEST_METHOD'] == 'GET') && isset($_GET['error'])) { // Validaciones

if ( $_GET['error'] == 'Printed') {
    echo '<div class="alert alert-success" role="alert">Se ha generado el listado en DIR Prints.pdf.</div>';
    };
    
};
require "../includes/pisosLista-inc.php";
?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="../index.php">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav  me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">registre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pisos.php">Pisos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="noupis.php">Alta Pis</a>
                </li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav  me-auto">
                    <li class="nav-item">
                        <a href="../index.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="../includes/logout.php">Logout</a>
                    </li>
                </ul>


            </div>
        </div>
    </div>
</nav>
<div class="container mt-3">
    <h2>Pisos</h2>
    <div class="float-end">
        <a href="../includes/generatePdf.php"><button class="btn btn-primary">Generate PDF</button></a> </div>
   <table class="table table-striped">
       <thead>
       <tr>
           <th>Identificador pis</th>
           <th>Tipus</th>
           <th>Num. habitacions</th>
           <th>Num. Lavabos</th>
           <th>Usuario</th>
           <th>Accion</th>
       </tr>
       </thead>
       <tbody>
<?php
            
            foreach ($todos as $key => $piso) {
                echo "<tr>";
                echo "<td>$piso[uidpis]</td>";
                echo "<td>$piso[tipus]</td>";
                echo "<td>$piso[numHabitacions]</td>";
                echo "<td>$piso[numLavabos]</td>";
                echo "<td>$piso[users_uid]</td>";
                echo "<td><a href='../includes/borraPiso.php?uidpis=$piso[uidpis]'>Borrar</a></td>";
                echo "</tr>";
            };
    ?>
</tbody>
</table>
</div>
</body>
</html>