<?php
include "../config.php";
include '../controller/publicationc.php';
$publicationC = new publicationc();
$publicationC->deletepublication($_GET["id"]);
header('Location:admin.php');
