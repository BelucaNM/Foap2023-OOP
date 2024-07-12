<?php





require "../model/connection.php";
require "../model/blog.php";
require "../controllers/PostContr.php";



$post = new blog();

$lista = $post->getTodos();

if (array($lista)) {
    foreach ($lista as $post) {
        echo "
   
   
    <div class='cards-container'" . $post["idBlog"] . ">
        <div class='card'>
            <img src='" . $post["fotoURL"] . "' alt='" . $post["fotoALT"] . "' class='card-img'>
            <div class='card-body'>
                <h3 class='card-title'>" . $post["titulo"] . "</h3>
                <p class='card-text'>" . $post["cuerpo"] . "
                </p>
              <p class='card-title'>" . $post["fecha"] . "</p>
            </div>
        </div>
       
    </div>";
    }

}


