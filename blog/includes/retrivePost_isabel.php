<?php
// echo 'Creando instancia de posts <br>';
require "../model/connection.php";
require "../model/blog.php";
require "../controllers/PostContr.php";
$post = new blog();
$lista = $post->getTodos();

//echo "<br> todos <br>";

if ($lista == 1 ) { // error STMT
        echo "Error al obtener todos los posts <br>";
        $num=0;
    }
?>