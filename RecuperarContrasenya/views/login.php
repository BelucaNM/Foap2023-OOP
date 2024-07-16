<html>
    <head>
        <title> Login ejercicio OOP </title>
        <meta charset="utf-8" >
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
    </head>

    <body>
    <h1> Ejercicio Login OOP </h1>
    <?php
    if (($_SERVER['REQUEST_METHOD'] == 'GET') && isset($_GET['error'])) { // Validaciones

        if ( $_GET['error'] == 'RegisterDone') {
            echo '<div class="alert alert-success" role="alert">Por favor, compruebe su email. Recibirá un correo de activación.</div>';
            };
        if ( $_GET['error'] == 'activAccount') {
            echo '<div class="alert alert-success" role="alert">Su cuenta ha sido activada.</div>';
            };
        if ( $_GET['error'] == 'emailForgotPassword') {
            echo '<div class="alert alert-success" role="alert">Por favor, compruebe su email. Recibirá un correo para nuevo password</div>';
            };
    };

    ?>
    <div class="row">
    <div class="col"></div>
    <div class="col">
    <div  id="login" class = " container pt-3 pb-3 mt-3 bg-light shadow-lg">
            <form method="post" action = "../includes/login_inc.php">
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control"  id= "user" name="username"" placeholder="Introduzca usuario"> 
                <label for ="user">Usuario</label> 
            </div> 
            <div class="form-floating mb-3 mt-3">
                <input type="password" class="form-control" style="margin-top:5px!important" id="pwd" name="password"  placeholder="Introduzca password" >   
                <label for = "pwd">Password</label>
            </div> 
         <div class="form-check mb-3">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="recordar" value="Si" >Seleccione para recordar 
                </label>
            </div>   
            
            <div>
                <input class="btn btn-primary" type="submit" name="signIn" value="Sign In">
            </div>    
            
            <!-- > value es el txt que muestra el boton. Es "Enviar" por defecto. 
            El indice en el POST es el name <-->
            </form>
    </div>
        <div class = "container mt-3 bg-light shadow-lg">
        <a class = "btn btn-lg btn-link"  href = "../views/introducirEmail.html" name="recuperarPass" value="Recuperar Password">Recuperar Password</a> 
        <a class = "btn btn-lg btn-link"  href = "../views/signup.php" name="signup" value="signup">Registro</a> 

    </div>
    </div>
    
    <div class="col"></div>
</div>
  


    </body>
</html>           