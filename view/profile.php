<?php
session_start();
if (!$_SESSION["role"]) {
    die("ERROR");
}
$action = ($_SESSION["role"] == "BASIC") ? 2 : 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $_SESSION["username"]?></title>
    <link rel="stylesheet" type="text/css" href="../assets/css/profile.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik">
</head>
<body>

<div class="profile_container">
    <div class="profile_photo">
        <img src="../assets/img/profile/logo.png" alt="Profile Photo">
    </div>
    <h2 class="profile_name"><?php echo $_SESSION["fullname"]; ?></h2>
    <p class="profile_username">
        <?php echo "#" . $_SESSION["username"]; ?>
        <?php
        if ($_SESSION["role"] === "VIP") {
            echo '
                <img src="../assets/img/profile/vip.png" alt="VIP Icon" class="vip_icon">
                ';
        }
        ?>
    </p>
    <p class="profile_bio">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur ab tenetur cumque, modi
        minima necessitatibus consectetur enim culpa optio alias perspiciatis voluptates eaque praesentium commodi
        blanditiis ipsum laudantium expedita molestias!</p>
    <div class="profile_buttons">
        <a href="updateUser.php?id=<?= $_SESSION["id"] ?>" class="update_button">Update Account</a>
        <a href="deleteUser.php?id=<?= $_SESSION["id"] ?>&action=<?= $action ?>" class="delete_button">Delete
            Account</a>
    </div>
    <?php
    if ($_SESSION["role"] === "BASIC") {
        echo '
          <div class="basic_section">
          <a href="#" onclick="showVipForm()" class="become_vip">Become VIP</a>
          </div>';
    }
    ?>
    <a href="index.php"><img src="../assets/img/logo-mini.png" class="logo" alt="Logo"></a>

    <div class="modal" id="vipModal">
        <div class="modal-content">
            <button class="close-btn" onclick="hideVipForm()">X</button>
            <p>Enter your credit card information</p>
            <form id="vipForm" action="becomeVIP.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                <input type="text" name="cc" id="cc" placeholder="Credit Card">
                <span id="ccSpan" class="sp"></span>
                <input type="text" name="ccv" id="ccv" placeholder="CCV">
                <span id="ccvSpan" class="sp"></span>
                <input type="submit" id="submit" value="Submit">
            </form>
            <script src="../assets/js/vip.js"></script>
        </div>
    </div>
</div>
<script src="../assets/js/profile.js"></script>
</body>
</html>