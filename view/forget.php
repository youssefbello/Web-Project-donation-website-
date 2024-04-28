<?php

session_start();
if (isset($_SESSION["id"])) {
    die("ALREADY LOGGED IN");
}

?>
<?php

include "test.php";

if (isset($_COOKIE["jwt_token"])) {
    $jwt_token = $_COOKIE["jwt_token"];

    $decoded_token = decryptJWT($jwt_token);

    $_SESSION["id"] = $decoded_token->id;
    $_SESSION["username"] = $decoded_token->username;
    $_SESSION["role"] = $decoded_token->role;
    $_SESSION["fullname"] = $decoded_token->fullname;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/forget.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
</head>

<body>

    <div class="login_container">
        <a href="index.php"><img src="../assets/img/logo-mini.png" class="logo" alt="Logo"></a>
        <h2 align="center" id="page_title">Forgot Password</h2>
        <form id="forgotPasswordForm" align="center" action="forget.php" method="POST">
            <span id="errorHandlingSpan" class="error-message"></span>
            <label for="email"></label>
            <input type="email" id="email" name="email" placeholder="Email">
            <br>
            <span id="eSpan" class="sp"></span>
            <input type="submit" id="submit" value="Submit">
            <span id="sumbitSpan"></span>
            <a href="login.php" id="back_to_login">Back to Login</a>
        </form>
    </div>
    <script src="../assets/js/forget.js"></script>
</body>

</html>

<?php

include "../model/user.php";
include "../controller/userC.php";
include "mail.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["email"]) && isset($_POST["email"])) {
        $uC = new userC();
        if (count($uC->emailExists($_POST["email"])) > 0){
            $user_info =  $uC->emailExists($_POST["email"])[0];
            $randomPassword = bin2hex(random_bytes(16));
            $u = new user(
                null,
                $user_info["name"],
                $user_info["last_name"],
                $user_info["username"],
                password_hash($randomPassword, PASSWORD_BCRYPT),
                $user_info["age"],
                $user_info["email"],
                0,
                0,
                $user_info["role"],
                $user_info["tel"]
            );
            $html = '
                <h2>PASSWORD RESET</h2>
                <p>Please Use this password to log in to your account, please update your password as fast as possible</p>
                <p><b>USERNAME: </b>'.$user_info["username"].'</p>
                <p><b>PASSWORD: </b>'.$randomPassword.'</p>
                <h3>SADAKA TEAM</h3>
                <blockquote class="imgur-embed-pub" lang="en" data-id="a/H7Uywz3" data-context="false" ><a href="//imgur.com/a/H7Uywz3"></a></blockquote><script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>
            ';
            $uC->updateUser($u, $user_info["id"]);
            sendEmail($_POST["email"], "PASSWORD RESET", $html, $user_info["name"].' '.$user_info["last_name"]);
            echo '<script>
                var ehs = document.getElementById("errorHandlingSpan");
                ehs.innerHTML = "&#10003; Password reset email sent. Please check your email. Redirecting you to login page.";
                
                setTimeout(function(){
                    window.location.href = "login.php";
                }, 5000);
            </script>';

        } else if (count($uC->emailExistsVIP($_POST["email"])) > 0) {
            $user_info =  $uC->emailExistsVIP($_POST["email"])[0];
            $randomPassword = bin2hex(random_bytes(16));
            $u = new user(
                null,
                $user_info["name"],
                $user_info["last_name"],
                $user_info["username"],
                password_hash($randomPassword, PASSWORD_BCRYPT),
                $user_info["age"],
                $user_info["email"],
                $user_info["cc"],
                $user_info["cc"],
                $user_info["role"],
                $user_info["tel"]
            );
            $html = '
                <h2>PASSWORD RESET</h2>
                <p>Please Use this password to log in to your account, please update your password as fast as possible</p>
                <p><b>USERNAME: </b>'.$user_info["username"].'</p>
                <p><b>PASSWORD: </b>'.$randomPassword.'</p>
                <h3>SADAKA TEAM</h3>
                <blockquote class="imgur-embed-pub" lang="en" data-id="a/H7Uywz3" data-context="false" ><a href="//imgur.com/a/H7Uywz3"></a></blockquote><script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>
            ';
            $uC->updateUserVIP($u, $user_info["id"]);
            sendEmail($_POST["email"], "PASSWORD RESET", $html, $user_info["name"].' '.$user_info["last_name"]);
            echo '<script>
                var ehs = document.getElementById("errorHandlingSpan");
                ehs.innerHTML = "&#10003; Password reset email sent. Please check your email. Redirecting you to the login page.";

                setTimeout(function(){
                    window.location.href = "login.php";
                }, 5000);
            </script>';
        }else if (count($uC->emailExistsAdmin($_POST["email"])) > 0) {
            $user_info =  $uC->emailExistsAdmin($_POST["email"])[0];
            $randomPassword = bin2hex(random_bytes(16));
            $u = new user(
                null,
                $user_info["name"],
                $user_info["last_name"],
                $user_info["username"],
                password_hash($randomPassword, PASSWORD_BCRYPT),
                $user_info["age"],
                $user_info["email"],
                0,
                0,
                $user_info["role"],
                $user_info["tel"]
            );
            $html = '
                <h2>PASSWORD RESET</h2>
                <p>Please Use this password to log in to your account, please update your password as fast as possible</p>
                <p><b>USERNAME: </b>'.$user_info["username"].'</p>
                <p><b>PASSWORD: </b>'.$randomPassword.'</p>
                <h3>SADAKA TEAM</h3>
                <blockquote class="imgur-embed-pub" lang="en" data-id="a/H7Uywz3" data-context="false" ><a href="//imgur.com/a/H7Uywz3"></a></blockquote><script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>
            ';
            $uC->updateAdmin($u, $user_info["id"]);
            sendEmail($_POST["email"], "PASSWORD RESET", $html, $user_info["name"].' '.$user_info["last_name"]);
            echo '<script>
                var ehs = document.getElementById("errorHandlingSpan");
                ehs.innerHTML = "&#10003; Password reset email sent. Please check your email.";
                
                setTimeout(function(){
                    window.location.href = "login.php";
                }, 5000);
            </script>';
        } else {
            echo '<script>
            var ehs = document.getElementById("errorHandlingSpan");
            ehs.innerHTML = "Email Does not exist";
            </script>';
        }
    }
} else {
    die();
}

?>