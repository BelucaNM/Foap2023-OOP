<?php
if (($_SERVER['REQUEST_METHOD'] == 'GET') && isset($_GET['numcomanda']) ){

$numcomanda = $_GET["numcomanda"];
require "../includes/testpdf_php.php";

}
?>