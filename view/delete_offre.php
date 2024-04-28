<?php
include '../controller/offreC.php';
$offreC = new offreC();
$offreC->delete_offre($_GET["id"]);
header('Location:liste_des_mises.php');
?>