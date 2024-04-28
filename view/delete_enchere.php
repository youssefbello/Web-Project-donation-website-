<?php
include '../controller/enchereC.php';
$encherC = new enchereC();
$encherC->delete_enchere($_GET["id"]);
header('Location:admin.php');
?>