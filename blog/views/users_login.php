<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css_blog.css">
</head>

<body>
    <h1>Iniciar Sesión</h1>
    <form action="../includes/login.php" method="post">
        <input type="text" name="username" placeholder="Nombre de usuario">
        <input type="password" name="password" placeholder="Contraseña">
        <button type="submit" name="send">Iniciar Sesión</button>
    </form>
    <?php
    if (isset($_GET['error'])) {
        echo "<p>" . $_GET['error'] . "</p>";
    }
    ?>


    <a href="users_register.php">Registrarse</a>
</body>

</html>