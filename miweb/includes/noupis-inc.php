<?php
echo "en noupis-inv";
print_r($_POST);
session_start();
if(!isset($_SESSION['user'])){
    echo " la session no ha sido iniciada";
    header("Location: ../index.php");
    exit();
};

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])){



    // recoger datos del formulario
    $uidpis = $_POST["uidpis"];
    $tipus = $_POST["tipus"];
    $numHabitacions = $_POST["numHabitacions"];
    $numLavabos = $_POST["numLavabos"];
    $users_users_id = $_SESSION["user"];

//    echo " en noupis-inc";
//    print_r($_POST);

    require "autoload.models.php";
    require "autoload.controlers.php";

    $elPiso = new PisoContr($uidpis,$tipus,$numHabitacions,$numLavabos,$users_users_id);
    $elPiso->altaPiso();

};
?>