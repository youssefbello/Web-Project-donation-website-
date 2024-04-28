<?php
include '../controller/reponseC.php';


$rep = new reponseC();
$rep->supprimer($_GET["id"]);
header('Location:afficherReponse.php');


?>