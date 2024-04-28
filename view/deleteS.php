<?php
include '../controller/sponsorC.php';

$clientC = new sponsorC();
$clientC->deletesponsor($_GET["ids"]);
header('Location:admin.php');
?>