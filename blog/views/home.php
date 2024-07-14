<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Listado de Entradas</title>
    <link rel="stylesheet" type="text/css" href="css_blog.css">
    
</head>
<?php
session_start();
$_SESSION["user"] = 1;
require "../includes/retrivePost.php";
?>

<body>
    <header>
        <h1>Blog</h1>
        <nav>

            <a class="btnStack" href="nuevaEntrada.php">Nueva Entrada</a>
            <a class="btnStack" href="..\includes\logout.php">LogOut</a>
        </nav>
    </header>

    <main>
    <section id="nueva" class="section">
        <h2>Listado de Entradas</h2>
        <div class='cards-container'> 
    <?php
        if($num = 0) {
            echo "No se encontraron usuarios.";
        }else{ 
            foreach ($lista as $post) {
                echo "
           
            <div class='card'" . $post["idBlog"] . ">
                
                    <img src='" . $post["fotoURL"] . "' alt='" . $post["fotoALT"] . "' class='card-img'>
                    <div class='card-body'>
                        <h3 class='card-title'>" . $post["titulo"] . "</h3>
                        <p class='card-text'>" . $post["cuerpo"] . "
                        </p>
                      <p class='card-title'>" . $post["fecha"] . "</p>
                    </div>
                
            </div>";
            }
        };
       
    ?>
        </div>
        <div>
            <input type="hidden" id="user" name="user" value="<?= $_SESSION['user'] ?>" readonly>
        </div>
        </section>

       
    </main>

<?php include("footer.php");?>
</body>

</html>