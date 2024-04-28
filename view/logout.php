<?php
session_start(); 


unset($_SESSION['username']);
unset($_SESSION['id']);
unset($_SESSION['role']);
unset($_SESSION['fullname']);

session_destroy();
if (isset($_COOKIE['jwt_token'])) {
    unset($_COOKIE['jwt_token']);
    setcookie('jwt_token', null, -1, '/');
}
header("Location: index.php");

exit;
?>
