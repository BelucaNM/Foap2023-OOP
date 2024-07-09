<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $urlImg = "";

    var_dump($_FILES);
    if (isset($_FILES) && $_FILES["file"]["size"] != 0) {
        $destino = "../public/img";
        $file_name = $_FILES["file"]["name"];
        $file_tmp = $_FILES["file"]["tmp_name"];
        if (!file_exists($destino . "/" . $file_name)) {

            if (move_uploaded_file($file_tmp, $destino . "/" . $file_name)) {
                if (file_exists($destino . "/" . $file_name)) {
                    $titulo = $_POST["title"];
                    $urlImg = $destino . "/" . $file_name;
                    echo "**" . $urlImg;
                    echo "Archivo subido correctamente y se encuentra en el directorio.";
                } else {
                    $error = error_get_last();
                    echo "Error: " . $error["message"];
                }
            } else {
                $error = error_get_last();
                echo "Error al subir el archivo: " . $error["message"];
            }
        } else {
            echo "el archivo ya existe ";


        }
    } else {
        echo "Seleciona una imagen ";
    }




    $titulo = $_POST["title"];
    $cuerpo = $_POST["content"];
    $fotoURL = $urlImg;
    echo $fotoURL;
    $fotoALT = $_POST["alt"];
    $fecha = new DateTime();
    $idUsuariol = $_POST["user"];

    $fecha = $fecha->format('Y-m-d H:i:s');


    require "../model/connection.php";
    require "../model/blog.php";
    require "../controllers/PostContr.php";



    $post = new PostContr($titulo, $cuerpo, $fotoURL, $fotoALT, $fecha, $idUsuariol);
    $post->newpost();


    /* 
        header("Location: ../view/home.php"); */

}