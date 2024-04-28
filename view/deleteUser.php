<?php

include "../controller/userC.php";
session_start();

$uC = new userC();
if ($_SESSION["role"] == "admin" || $_SESSION["id"] == $_GET["id"]) {
    if ($_GET["action"] == 0) {
        $uC->deleteAdmin($_GET["id"]);
    } else if ($_GET["action"] == 1) {
        $uC->deleteVip($_GET["id"]);
    } else if($_GET["action"] == 2) {
        $uC->deleteUser($_GET["id"]);
    }
} else {
    die("FORBIDDEN");
}
if ($_SESSION["role"] == "admin") {
    header("location:admin.php?view=users");
} else {
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    unset($_SESSION['role']);
    unset($_SESSION['fullname']);
    session_destroy();
    header('Location: index.php');
}


?>