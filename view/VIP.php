<?php

include "../controller/userC.php";
include "../model/user.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"]) && isset($_GET["action"])) {
        $uC = new userC();
        $id = htmlspecialchars($_GET["id"]);
        $action = htmlspecialchars($_GET["action"]);

        if ($action == 1) {
            $user = $uC->retrieveUser($id);
            $vipUser = new user(
                null,
                $user["name"],
                $user["last_name"],
                $user["username"],
                $user["password"],
                $user["age"],
                $user["email"],
                0,
                0,
                "VIP",
                $user["tel"],
            );
            $uC->addVip($vipUser);
            $uC->deleteUser($id);

            header("Location: admin.php");
        } else if ($action == 2) {
            $user = $uC->retrieveVIP($id);
            $basicUser = new user(
                null,
                $user["name"],
                $user["last_name"],
                $user["username"],
                $user["password"],
                $user["age"],
                $user["email"],
                0,
                0,
                "BASIC",
                $user["tel"],
            );
            $uC->addUser($basicUser);
            $uC->deleteVip($id);

            header("Location: admin.php");
        }
    }
}
?>