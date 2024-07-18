
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Agencia Pisos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['user'])){
    echo " la session no ha sido iniciada";
    header("Location: ../index.php");
}

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
    <h2>Alta Pis</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="uidpis">Identificado Pis:</label>
            <input type="text" class="form-control" id="uidpis"  name="uidpis">
        </div>
        <div class="mb-3">
            <label for="tipus">Tipus:</label>
            <select class="form-control" id="tipus" name="tipus">
                <option value="1">Venta</option>
                <option value="2">Lloguer</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="numHabitacions">Num. habitacions:</label>
            <input type="number" class="form-control" id="numHabitacions" name="numHabitacions">
        </div>
        <div class="mb-3">
            <label for="numLavabos">Num. Lavabos:</label>
            <input type="numLavabos" class="form-control" id="numLavabos" name="numLavabos">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>