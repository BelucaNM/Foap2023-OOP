<?php
// echo 'Creando instancia de posts <br>';
require "../model/connection.php";
require "../model/blog.php";
require "../controllers/BlogContr.php";

$post = new blogContr();
$lista = $post->getTodos();

//echo "<br> todos <br>";

if ($lista == 1 ) { // error STMT
        echo "Error al obtener todos los posts <br>";
        $num=0;
    }
?>