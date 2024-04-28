<?php
include '../Controller/participationC.php';
$participationC = new participationC();
$participationC->delete_participation($_GET["id_participation"]);
header('Location:list_participation.php');
?>