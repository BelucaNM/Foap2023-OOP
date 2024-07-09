<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
    <link rel="stylesheet" href="css_blog.css">
</head>

<body>
    <h1>Registrarse</h1>
    <form action="../includes/register.php" method="post">
        <input type="text" name="username" placeholder="Nombre de usuario">
        <input type="password" name="password" placeholder="Contraseña">
        <input type="email" name="email" placeholder="email">
        <button type="submit" name="send" value="send">Registrarse</button>
    </form>
    <a href="users_login.php">Iniciar Sesión</a>

    <?php
    if (isset($_GET['error'])) {
        echo "<p>" . $_GET['error'] . "</p>";
    }
    ?>
</body>

</html>