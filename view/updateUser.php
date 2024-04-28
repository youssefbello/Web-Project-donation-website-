<?php
include "../controller/userC.php";
include "../model/user.php";

session_start();
$uC = new userC();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    if ($_SESSION["role"] == "admin") {
        $user_info = $uC->retrieveUser($_GET["id"]);
        if ($user_info == NULL) {
            $user_info = $uC->retrieveVIP($_GET["id"]);
        }
        if ($user_info == NULL) {
            $user_info = $uC->retrieveAdmin($_GET["id"]);
        }
    } else if ($_SESSION["id"] == $_GET["id"]) {
        if ($_SESSION["role"] == "BASIC") {
            $user_info = $uC->retrieveUser($_GET["id"]);
        } else {
            $user_info = $uC->retrieveVIP($_GET["id"]);
        }
    } else {
        die("FORBIDDEN");
    }
}

// TODO : retrieve function admin

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptcha_secret = '6Lc1Px0pAAAAAEkkoglG_JLSN9VC2Blu9Y1Sw9je';
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
        if ($_SESSION["role"] == "admin" || $_SESSION["id"] == $_POST["id"]) {
            $validationErrors = [];
            if (!isset($_POST["id"]) || !is_numeric($_POST["id"])) {
                $validationErrors[] = "Invalid user ID.";
            }
            if (empty($validationErrors)) {
                if ($uC->retrieveUser($_POST["id"])) {
                    $user_info = $uC->retrieveUser($_POST["id"]);
                } else if ($uC->retrieveVIP($_POST["id"])) {
                    $user_info = $uC->retrieveVIP($_POST["id"]);
                } else if ($uC->retrieveAdmin($_POST["id"])) {
                    $user_info = $uC->retrieveAdmin($_POST["id"]);
                }
            } else {
                echo $validationErrors[0];
            }
            if ($user_info["role"] == "BASIC") {
                if (
                    isset($_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["dob"], $_POST["tel"])
                    && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["dob"]) && !empty($_POST["tel"])
                ) {
                    $ifEmail = 0;
                    $ifUser = 0;
                    $existingEmails = $uC->emailExists($_POST["email"]);
                    if (count($existingEmails) > 0 && $existingEmails[0]["email"] !== $user_info["email"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("eSpan").innerHTML = "<h6>Email already exists</h6>";
                            document.getElementById("email").style.border = "1.5px solid";
                            document.getElementById("email").style.borderColor = "red";
                        </script>';
                        $ifEmail = 1;
                    }
                    $existingUser = $uC->checkUser($_POST["username"]);
                    if (count($existingUser) > 0 && $existingUser[0]["username"] !== $user_info["username"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("uSpan").innerHTML = "<h6>username already exists</h6>";
                            document.getElementById("username").style.border = "1.5px solid";
                            document.getElementById("username").style.borderColor = "red";
                        </script>';
                        $ifUser = 1;
                    }
                    $existingEmails = $uC->emailExistsAdmin($_POST["email"]);
                    if (count($existingEmails) > 0 && $existingEmails[0]["email"] !== $user_info["email"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("eSpan").innerHTML = "<h6>Email already exists</h6>";
                            document.getElementById("email").style.border = "1.5px solid";
                            document.getElementById("email").style.borderColor = "red";
                        </script>';
                        $ifEmail = 1;
                    }
                    $existingUser = $uC->checkUserAdmin($_POST["username"]);
                    if (count($existingUser) > 0 && $existingUser[0]["username"] !== $user_info["username"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("uSpan").innerHTML = "<h6>username already exists</h6>";
                            document.getElementById("username").style.border = "1.5px solid";
                            document.getElementById("username").style.borderColor = "red";
                        </script>';
                        $ifUser = 1;
                    }
                    $existingEmails = $uC->emailExistsVIP($_POST["email"]);
                    if (count($existingEmails) > 0 && $existingEmails[0]["email"] !== $user_info["email"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("eSpan").innerHTML = "<h6>Email already exists</h6>";
                            document.getElementById("email").style.border = "1.5px solid";
                            document.getElementById("email").style.borderColor = "red";
                        </script>';
                        $ifEmail = 1;
                    }
                    $existingUser = $uC->checkUserVIP($_POST["username"]);
                    if (count($existingUser) > 0 && $existingUser[0]["username"] !== $user_info["username"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("uSpan").innerHTML = "<h6>username already exists</h6>";
                            document.getElementById("username").style.border = "1.5px solid";
                            document.getElementById("username").style.borderColor = "red";
                        </script>';
                        $ifUser = 1;
                    }
                    if (!$ifEmail && !$ifUser) {
                        $currentDate = new DateTime();
                        $birthdate = new DateTime($_POST['dob']);
                        $u = new user(
                            null,
                            htmlspecialchars($_POST["firstname"]),
                            htmlspecialchars($_POST["lastname"]),
                            htmlspecialchars($_POST["username"]),
                            password_hash($_POST["password"], PASSWORD_BCRYPT),
                            $currentDate->diff($birthdate)->y,
                            htmlspecialchars($_POST["email"]),
                            0,
                            0,
                            $user_info["role"],
                            htmlspecialchars($_POST["tel"])
                        );
                        $uC->updateUser($u, $user_info["id"]);
                        $_SESSION["username"] = $u->getUsername();
                        $_SESSION["fullname"] = $u->getName()." ".$u->getLastName();
                        if ($_SESSION["role"] != "admin") {
                            header("Location: profile.php");
                        } else {
                            header("Location: admin.php");
                        }
                        
                        exit();
                    }
                }
            } else if ($user_info["role"] == "VIP") {
                if (
                    isset($_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["dob"], $_POST["tel"], $_POST["cc"], $_POST["ccv"])
                    && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["dob"]) && !empty($_POST["tel"]) && !empty($_POST["cc"]) && !empty($_POST["ccv"])
                ) {
                    $ifEmail = 0;
                    $ifUser = 0;
                    $existingEmails = $uC->emailExistsVIP($_POST["email"]);
                    if (count($existingEmails) > 0 && $existingEmails[0]["email"] !== $user_info["email"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("eSpan").innerHTML = "<h6>Email already exists</h6>";
                            document.getElementById("email").style.border = "1.5px solid";
                            document.getElementById("email").style.borderColor = "red";
                        </script>';
                        $ifEmail = 1;
                    }
                    $existingUser = $uC->checkUserVIP($_POST["username"]);
                    if (count($existingUser) > 0 && $existingUser[0]["username"] !== $user_info["username"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("uSpan").innerHTML = "<h6>username already exists</h6>";
                            document.getElementById("username").style.border = "1.5px solid";
                            document.getElementById("username").style.borderColor = "red";
                        </script>';
                        $ifUser = 1;
                    }
                    $existingEmails = $uC->emailExists($_POST["email"]);
                    if (count($existingEmails) > 0 && $existingEmails[0]["email"] !== $user_info["email"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("eSpan").innerHTML = "<h6>Email already exists</h6>";
                            document.getElementById("email").style.border = "1.5px solid";
                            document.getElementById("email").style.borderColor = "red";
                        </script>';
                        $ifEmail = 1;
                    }
                    $existingUser = $uC->checkUser($_POST["username"]);
                    if (count($existingUser) > 0 && $existingUser[0]["username"] !== $user_info["username"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("uSpan").innerHTML = "<h6>username already exists</h6>";
                            document.getElementById("username").style.border = "1.5px solid";
                            document.getElementById("username").style.borderColor = "red";
                        </script>';
                        $ifUser = 1;
                    } 
                    $existingEmails = $uC->emailExistsAdmin($_POST["email"]);
                    if (count($existingEmails) > 0 && $existingEmails[0]["email"] !== $user_info["email"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("eSpan").innerHTML = "<h6>Email already exists</h6>";
                            document.getElementById("email").style.border = "1.5px solid";
                            document.getElementById("email").style.borderColor = "red";
                        </script>';
                        $ifEmail = 1;
                    }
                    $existingUser = $uC->checkUserAdmin($_POST["username"]);
                    if (count($existingUser) > 0 && $existingUser[0]["username"] !== $user_info["username"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("uSpan").innerHTML = "<h6>username already exists</h6>";
                            document.getElementById("username").style.border = "1.5px solid";
                            document.getElementById("username").style.borderColor = "red";
                        </script>';
                        $ifUser = 1;
                    }
                    if (!$ifEmail && !$ifUser) {
                        $currentDate = new DateTime();
                        $birthdate = new DateTime($_POST['dob']);
                        $u = new user(
                            null,
                            htmlspecialchars($_POST["firstname"]),
                            htmlspecialchars($_POST["lastname"]),
                            htmlspecialchars($_POST["username"]),
                            password_hash($_POST["password"], PASSWORD_BCRYPT),
                            $currentDate->diff($birthdate)->y,
                            htmlspecialchars($_POST["email"]),
                            htmlspecialchars($_POST["cc"]),
                            htmlspecialchars($_POST["ccv"]),
                            $user_info["role"],
                            htmlspecialchars($_POST["tel"])
                        );
                        $uC->updateUserVIP($u, $user_info["id"]);
                        $_SESSION["username"] = $u->getUsername();
                        $_SESSION["fullname"] = $u->getName()." ".$u->getLastName();
                        if ($_SESSION["role"] != "admin") {
                            header("Location: profile.php");
                        } else {
                            header("Location: admin.php");
                        }
                        
                        exit();
                    }
                }
            } else if ($user_info["role"] == "admin") {
                if (
                    isset($_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["dob"], $_POST["tel"], $_POST["cc"], $_POST["ccv"])
                    && !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["dob"]) && !empty($_POST["tel"]) && !empty($_POST["cc"]) && !empty($_POST["ccv"])
                ) {
                    $ifEmail = 0;
                    $ifUser = 0;
                    $existingEmails = $uC->emailExistsAdmin($_POST["email"]);
                    if (count($existingEmails) > 0 && $existingEmails[0]["email"] !== $user_info["email"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("eSpan").innerHTML = "<h6>Email already exists</h6>";
                            document.getElementById("email").style.border = "1.5px solid";
                            document.getElementById("email").style.borderColor = "red";
                        </script>';
                        $ifEmail = 1;
                    }
                    $existingUser = $uC->checkUserAdmin($_POST["username"]);
                    if (count($existingUser) > 0 && $existingUser[0]["username"] !== $user_info["username"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("uSpan").innerHTML = "<h6>username already exists</h6>";
                            document.getElementById("username").style.border = "1.5px solid";
                            document.getElementById("username").style.borderColor = "red";
                        </script>';
                        $ifUser = 1;
                    }
                    $existingEmails = $uC->emailExistsVIP($_POST["email"]);
                    if (count($existingEmails) > 0 && $existingEmails[0]["email"] !== $user_info["email"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("eSpan").innerHTML = "<h6>Email already exists</h6>";
                            document.getElementById("email").style.border = "1.5px solid";
                            document.getElementById("email").style.borderColor = "red";
                        </script>';
                        $ifEmail = 1;
                    }
                    $existingUser = $uC->checkUserVIP($_POST["username"]);
                    if (count($existingUser) > 0 && $existingUser[0]["username"] !== $user_info["username"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("uSpan").innerHTML = "<h6>username already exists</h6>";
                            document.getElementById("username").style.border = "1.5px solid";
                            document.getElementById("username").style.borderColor = "red";
                        </script>';
                        $ifUser = 1;
                    }
                    $existingEmails = $uC->emailExists($_POST["email"]);
                    if (count($existingEmails) > 0 && $existingEmails[0]["email"] !== $user_info["email"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("eSpan").innerHTML = "<h6>Email already exists</h6>";
                            document.getElementById("email").style.border = "1.5px solid";
                            document.getElementById("email").style.borderColor = "red";
                        </script>';
                        $ifEmail = 1;
                    }
                    $existingUser = $uC->checkUser($_POST["username"]);
                    if (count($existingUser) > 0 && $existingUser[0]["username"] !== $user_info["username"]) {
                        echo '<script type="text/javascript">
                            document.getElementById("uSpan").innerHTML = "<h6>username already exists</h6>";
                            document.getElementById("username").style.border = "1.5px solid";
                            document.getElementById("username").style.borderColor = "red";
                        </script>';
                        $ifUser = 1;
                    }
                    
                    if (!$ifEmail && !$ifUser) {
                        $currentDate = new DateTime();
                        $birthdate = new DateTime($_POST['dob']);
                        $u = new user(
                            null,
                            htmlspecialchars($_POST["firstname"]),
                            htmlspecialchars($_POST["lastname"]),
                            htmlspecialchars($_POST["username"]),
                            password_hash($_POST["password"], PASSWORD_BCRYPT),
                            $currentDate->diff($birthdate)->y,
                            htmlspecialchars($_POST["email"]),
                            0,
                            0,
                            $user_info["role"],
                            htmlspecialchars($_POST["tel"])
                        );
                        $uC->updateAdmin($u, $user_info["id"]);
                        $_SESSION["username"] = $u->getUsername();
                        $_SESSION["fullname"] = $u->getName()." ".$u->getLastName();
                        if ($_SESSION["role"] != "admin") {
                            header("Location: profile.php");
                        } else {
                            header("Location: admin.php");
                        }
                        
                        exit();
                    }
                }
            }
        }
    } else {
        echo '<script>
        var ehs = document.getElementById("errorHandlingSpan");
        ehs.innerHTML = "reCAPTCHA verification failed.";
        </script>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/register.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div class="reg_container">
    <a href="index.php"><img src="../assets/img/logo-mini.png" class="logo" alt="Logo"></a>
    <h2 align="center" id="page_title">Update</h2>
    <form id="registrationForm" align="center" action="updateUser.php" method="POST">
        
    <input type="hidden" name="id" value="<?=$_GET['id']?>">
        <label for="firstName"></label>
        <input type="text" id="firstname" name="firstname" placeholder="First Name" value="<?php echo$user_info["name"] ?>"><span id="fnSpan"></span>

        <label for="lastname"></label>
        <input type="text" id="lastname" name="lastname" placeholder="Last name" value="<?php echo$user_info["last_name"] ?>"><span id="lnSpan" class="sp"></span>

        <label for="username"></label>
        <input type="text" id="username" name="username" placeholder="Username" value="<?php echo$user_info["username"] ?>"><span id="uSpan" class="sp"></span>

        <label for="email"></label>
        <input type="email" id="email" name="email" placeholder="Email" value="<?php echo$user_info["email"] ?>">
        <br>
        <span id="eSpan" class="sp"></span>

        <label for="password"></label>
        <input type="password" id="password" name="password" placeholder="Password" value="<?php echo$user_info["password"] ?>">
        <br>
        <span id="pSpan" class="sp">
            <h6 id="p_character">&#10007; Password must be 8 characters at least</h6>
            <h6 id="p_number">&#10007; Password must contain at least one number (0-9)</h6>
            <h6 id="p_upper">&#10007; Passsword must contain at least one Uppercase character (A-Z)</h6>
            <h6 id="p_special">&#10007; Password must contain at least one special character (eg: .,!@)</h6>
        </span>

        <label for="cpassword"></label>
        <input type="password" id="cpassword" name="cpassword" placeholder="Confirm password" value="<?php echo$user_info["password"] ?>">
        <br>
        <span id="cpSpan" class="sp"></span>
        <?php
            if ($user_info["role"] == "VIP") {
                echo '
                <label for="cc"></label>
                <input type="text" id="cc" name="cc" placeholder="Credit Card" value="'.$user_info["cc"].'">
                <br>
                <span id="CCSpan" class="sp"></span>

                <label for="ccv"></label>
                <input type="text" id="ccv" name="ccv" placeholder="CCV" value="'.$user_info["ccv"].'">
                <br>
                <span id="CCVSpan" class="sp"></span>
                ';
            }
        ?>
        <label for="dob"></label>
        <input type="date" id="dob" name="dob" placeholder="Date of Birth" required>
        <br>
        <span id="dobSpan" class="sp"></span>

        <label for="tel"></label>
        <input type="text" id="tel" name="tel" placeholder="Telephone" value="<?php echo$user_info["tel"] ?>">
        <br>
        <span id="tSpan" class="sp"></span>

        <br>
        <div class="g-recaptcha" data-sitekey="6Lc1Px0pAAAAALipaIEpBkHr59wiMBNJD4mpSTuY"></div>
        <input type="submit" id="submit" value="Update">
        <span id="sumbitSpan"></span>

    </form>
</div>
<script src="../assets/js/update.js"></script>
</body>
</html>
