<?php

include "../controller/userC.php";
include "../model/user.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION["id"] == $_POST["id"] && $_SESSION["role"] != "VIP" && $_SESSION["role"] != "admin") {
        $uC = new userC();
        $user = $uC->retrieveUser($_POST["id"]);
        $vipUser = new user(
            null,
            $user["name"],
            $user["last_name"],
            $user["username"],
            $user["password"],
            $user["age"],
            $user["email"],
            $_POST["cc"],
            $_POST["ccv"],
            "VIP",
            $user["tel"],
        );
        $uC->addVip($vipUser);
        $uC->deleteUser($_POST["id"]);
        header("Location: logout.php"); // we need to logout so we can the new id to the session variable so we don't get unexpected behaviour
    } else {
        die("ERROR");
    }
} else {
    die("FORBIDDEN");
}

?>