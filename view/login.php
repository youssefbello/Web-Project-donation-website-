<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/login.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

    <div class="login_container">
        <a href="index.php"><img src="../assets/img/logo-mini.png" class="logo" alt="Logo"></a>
        <h2 align="center" id="page_title">Login</h2>
        <form id="loginForm" align="center" action="login.php" method="POST">
            <span id="errorHandlingSpan" class="error-message"></span>
            <label for="username"></label>
            <input type="text" id="username" name="username" placeholder="Username/Email"><span id="uSpan" class="sp"></span>

            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="Password">
            <br>
            <span id="pSpan" class="sp"></span>

            <label for="rememberMe" style="display: flex; align-items: center; font-size: 12px; line-height: 1.5; margin-top: 5px; margin-bottom: -12px;">
                <input type="checkbox" id="rememberMe" name="rememberMe" style="margin-right: 5px;">
                Remember me
            </label>

            <br>
            <div class="g-recaptcha" data-sitekey="6LdDWx4pAAAAADcWOAOv76zKmKlf3Ul3fKzmHNp3" data-type="image" data-callback="recaptchaCallback"></div>
            <input type="submit" id="submit" value="Login">
            <span id="sumbitSpan"></span>
            <div class="social-buttons">
                <button class="social-button google" data-social="Login with Google">
                    <img src="../assets/img/icons/gmail.png" alt="Gmail Icon" class="icon">
                </button>
                <button class="social-button facebook" data-social="Login with Facebook">
                    <img src="../assets/img/icons/facebook.png" alt="Facebook Icon" class="icon">
                </button>
                <button class="social-button linkedin" data-social="Login with LinkedIn">
                    <img src="../assets/img/icons/linkedin.png" alt="LinkedIn Icon" class="icon">
                </button>
            </div>
            <a href="register.php" id="no_acc">Don't have an account ?</a>
            <a href="forget.php" id="forgot_pass">Forgot Password?</a>
        </form>
    </div>
    <script src="../assets/js/login.js"></script>
</body>
</html>

<?php

include "../model/user.php";
include "../controller/userC.php";
include "test.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        if (isset($_POST["username"])&& isset($_POST["password"])) {
            $recaptcha_secret = '6LdDWx4pAAAAAEIrnB48hVDJu_A5DSajYoqAXxA3';
            $recaptcha_response = $_POST['g-recaptcha-response'];
            $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
            $recaptcha_data = [
                'secret' => $recaptcha_secret,
                'response' => $recaptcha_response,
            ];
            $options = [
                'http' => [
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($recaptcha_data),
                ],
            ];
            $context = stream_context_create($options);
            $result = file_get_contents($recaptcha_url, false, $context);
            $recaptcha_response = json_decode($result, true);
            if ($recaptcha_response['success'] == true) {
                if(filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
                    $uC = new userC();
                    if (count($uC->checkEmailPassword($_POST["username"], $_POST["password"])) > 0) {
                        $array = $uC->checkEmailPassword($_POST["username"], password_hash($_POST["password"], PASSWORD_BCRYPT))[0];
                        $_SESSION["id"] = $array["id"];
                        $_SESSION["username"] = $array["username"];
                        $_SESSION["role"] = $array["role"];
                        $_SESSION["fullname"] = $array["name"]." ".$array["last_name"];
                        header("location:index.php");
                    } else if (count($uC->checkEmailPasswordVIP($_POST["username"], $_POST["password"])) > 0) {
                        $array = $uC->checkEmailPasswordVIP($_POST["username"], password_hash($_POST["password"], PASSWORD_BCRYPT))[0];
                        $_SESSION["id"] = $array["id"];
                        $_SESSION["username"] = $array["username"];
                        $_SESSION["role"] = $array["role"];
                        $_SESSION["fullname"] = $array["name"]." ".$array["last_name"];
                        header("location:index.php");
                    }else if (count($uC->checkEmailPasswordAdmin($_POST["username"], $_POST["password"])) > 0) {
                        $array = $uC->checkEmailPasswordAdmin($_POST["username"], password_hash($_POST["password"], PASSWORD_BCRYPT))[0];
                        $_SESSION["id"] = $array["id"];
                        $_SESSION["username"] = $array["username"];
                        $_SESSION["role"] = $array["role"];
                        $_SESSION["fullname"] = $array["name"]." ".$array["last_name"];
                        header("location:index.php");
                    } else {
                        echo '<script>
                            var ehs = document.getElementById("errorHandlingSpan");
                            ehs.innerHTML = "WRONG USERNAME OR PASSWORD";
                        </script>';
                    }
                } else {
                    $uC = new userC();
                    if ($uC->checkUserPassword($_POST["username"], $_POST["password"]) != NULL) {
                        $array = $uC->checkUserPassword($_POST["username"], $_POST["password"])[0];
                        $_SESSION["id"] = $array["id"];
                        $_SESSION["username"] = $array["username"];
                        $_SESSION["role"] = $array["role"];
                        $_SESSION["fullname"] = $array["name"]." ".$array["last_name"];
                        if (isset($_POST["rememberMe"]) && $_POST["rememberMe"] == "on") {
                            $payload = array(
                                "id" => $array["id"],
                                "username" => $array["username"],
                                "role" => $array["role"],
                                "fullname" => $array["name"]." ".$array["last_name"]
                            );
                            $jwt = encryptJWT($payload);
                            setcookie("jwt_token", $jwt, time() + (7 * 24 * 60 * 60), "/");
                        }
                        header("location:index.php");
                    } else if ($uC->checkUserPasswordVIP($_POST["username"], $_POST["password"]) != NULL) {
                        $array = $uC->checkUserPasswordVIP($_POST["username"], $_POST["password"])[0];
                        $_SESSION["id"] = $array["id"];
                        $_SESSION["username"] = $array["username"];
                        $_SESSION["role"] = $array["role"];
                        $_SESSION["fullname"] = $array["name"]." ".$array["last_name"];
                        if (isset($_POST["rememberMe"]) && $_POST["rememberMe"] == "on") {
                            $payload = array(
                                "id" => $array["id"],
                                "username" => $array["username"],
                                "role" => $array["role"],
                                "fullname" => $array["name"]." ".$array["last_name"]
                            );
                            $jwt = encryptJWT($payload);
                            setcookie("jwt_token", $jwt, time() + (7 * 24 * 60 * 60), "/");
                        }
                        header("location:index.php");
                    } else if ($uC->checkUserPasswordAdmin($_POST["username"], $_POST["password"]) != NULL) {
                        $array = $uC->checkUserPasswordAdmin($_POST["username"], $_POST["password"])[0];
                        $_SESSION["id"] = $array["id_admin"];
                        $_SESSION["username"] = $array["username"];
                        $_SESSION["role"] = $array["role"];
                        $_SESSION["fullname"] = $array["name"]." ".$array["last_name"];
                        if (isset($_POST["rememberMe"]) && $_POST["rememberMe"] == "on") {
                            $payload = array(
                                "id" => $array["id"],
                                "username" => $array["username"],
                                "role" => $array["role"],
                                "fullname" => $array["name"]." ".$array["last_name"]
                            );
                            $jwt = encryptJWT($payload);
                            setcookie("jwt_token", $jwt, time() + (7 * 24 * 60 * 60), "/");
                        }
                        header("location:index.php");
                    } else {
                        echo '<script>
                            var ehs = document.getElementById("errorHandlingSpan");
                            ehs.innerHTML = "WRONG USERNAME OR PASSWORD";
                        </script>';
                    }
                }
            } else {
                echo '<script>
                    var ehs = document.getElementById("errorHandlingSpan");
                    ehs.innerHTML = "reCAPTCHA verification failed.";
                </script>';
            }
        }
    }
} else {
    die();
}

?>
