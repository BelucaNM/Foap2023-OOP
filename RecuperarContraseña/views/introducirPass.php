<html>
<head>
		<title> Ejercicio RecuperarContraseña - Introduir Nueva Contraseña</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
	
</head>
<body>
    <?php
        echo "hola";
        $token = "";
        if (($_SERVER['REQUEST_METHOD'] == 'GET') && isset($_GET['token']) ){// Validaciones
    
            $token = $_GET['token'];
            print_r($_GET);
        };

    ?>

    <h1> Ejercicio Registro OOP Recuperar Password</h1>
    <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
    <div id="entradaDatos" class = "container pt-3 pb-3 mt-3 bg-light shadow-lg">
        <form  method="post" action = "../includes/pass_inc.php"> 
              
        
        <div class="form-floating mb-1 mt-1">
            <input type="password" class="form-control" id="password1" name="password1"" placeholder="Introduzca password">
            <label for ="password1" class="form-label" >Password</label>

        </div> 
        <div class="form-floating mb-1 mt-1">
            <input type="password" class="form-control" id="password2" name="password2" " placeholder="ReIntroduzca password">
            <label for ="password2" class="form-label" >Reintroduzca password</label>

        </div> 
        <div class="form-floating mb-1 mt-1">
            <input type="text" class="form-control" id="token" name="token" value="<?=$token;?>"  readonly  >

        </div> 
        
        
        <div class="form-floating mb-1 mt-1">    
                <input class="btn btn-primary" type="submit" name= "submit" value="Submit"> 
        <!-- > value es el txt que muestra el boton. Es "Enviar" por defecto. 
                El indice en el POST es el name <-->
        </div>
        </form>
    </div>

    </div>
    <div class="col-2"></div>
    </div>
 
</body>
</html>