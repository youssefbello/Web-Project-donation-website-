<?php
include '../controller/eventC.php';

$clientC = new eventC();
$clientC->deleteevent($_GET["ide"]);
header('Location:admin.php');
?>