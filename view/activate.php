<!DOCTYPE html>
<html>
<head>
    <title>Activate your account</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/activate.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
</head>
<body>

    <div class="activation_container">
        <a href="index.html"><img src="../assets/img/logo-mini.png" class="logo" alt="Logo"></a>
        <h2 align="center" id="page_title">Activation</h2>
        <form id="activationForm" align="center" action="activate.php" method="POST">

            <label for="activationCode"></label>
            <input type="text" id="aCode" name="aCode" placeholder="aCode" required>
            <span id="acSpan" class="ac"></span>

            <br>
            <input type="submit" id="submit" value="Activate">
    <script src="../assets/js/login.js"></script>
</body>
</html>

<?php
include "../model/user.php";
include "../controller/userC.php";
//TODO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

} else {
    die();
}

?>