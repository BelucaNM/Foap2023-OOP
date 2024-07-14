<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Nueva Entrada</title>
    <link rel="stylesheet" type="text/css" href="css_blog.css">
    
</head>
<?php
session_start();
$_SESSION["user"] = 1;

?>

<body>
    <header>
        <h1>Blog</h1>
        <nav>
            <a class="btnStack" href="home.php">Listado de Entradas</a>
            <a class="btnStack" href="..\includes\logout.php">LogOut</a>
        </nav>
    </header>

    <main>
        <section id="nueva" class="section">
            <h2>Nueva Entrada</h2>
            <form action="../includes/nuevoPost.php" method="post" enctype="multipart/form-data">
                <div>
                    <label for="title">Título</label>
                    <input type="text" id="title" name="title" >
                </div>
                <div>
                    <label for="content">Contenido</label>
                    <textarea id="content" name="content" rows="5" ></textarea>
                </div>
                <div>
                    <label for="image">Imagen</label>
                    <input type="file" id="image" name="file">
                </div>
                <div>
                    <label for="image">alt</label>
                    <input type="text" id="alt" name="alt">
                </div>
                <div>

                    <input type="hidden" id="user" name="user" value="<?= $_SESSION['user'] ?>" readonly>

                </div>
                <button type="submit" name="send">Crear Entrada</button>
            </form>
        </section>
    </main>

<?php include "footer.php";?>
</body>

</html>