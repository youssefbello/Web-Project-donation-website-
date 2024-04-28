<?php
include '../controller/participationEventC.php';

$clientC = new participationC();
$clientC->deletepart($_GET["idp"]);
header('Location:admin.php');
?>