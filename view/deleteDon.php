<?php
include '../controller/donsC.php';
$donC = new donsC();
$donC->deleteDon($_GET["id"]);
header('Location: admin.php');