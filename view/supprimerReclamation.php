<?php
include '../controller/reclamationC.php';


$rec = new reclamationC();
$rec->supprimer($_GET["id"]);
header('Location:afficherReclamation.php');


?>