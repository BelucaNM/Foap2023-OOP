<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {


    require "../model/connection.php";
    require "../model/blog.php";
    require "../controllers/PostContr.php";



    $post = new blog();

    $post->getTodos();

    header("Location: ../view/home.php");

}