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

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav  me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="view/signup.php">registre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view/pisos.php">Pisos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view/noupis.php">Alta Pis</a>
                </li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav  me-auto">

                    <li class="nav-item">
                        <a href="index.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="includes/logout.php">Logout</a>
                    </li>
                </ul>


            </div>
        </div>
    </div>
</nav>

<div class="container mt-3">
  <h2>Login</h2>
  <form action="includes/login-inc.php" method="post">
    <div class="mb-3">
      <label for="uid">Username:</label>
      <input type="text" class="form-control" id="uid" placeholder="Enter your username" name="uid">
    </div>
    <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    <div class="mb-3">
      <a href="view/forgotpassword.php">Forgot Password?</a> /
        <a href="view/signup.php">Don't have an account yet? Sign up here!</a>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</body>
</html>
