<?php
session_start();
if (!isset($_SESSION["role"])) {
    die("FORBIDDEN");
} else if ($_SESSION["role"] != "admin") {
    die("FORBIDDEN");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Management Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function loadContent(url) {
                $.ajax({
                    url: url,
                    success: function (data) {
                        $('#dynamic-content').html(data);
                    }
                });
            }

            $('#users').click(function (e) {
                e.preventDefault();
                loadContent('users.php');
            });

            $('#encher').click(function (e) {
                e.preventDefault();
                loadContent('historique_des_encheres.php');
            });

            $('#dons').click(function (e) {
                e.preventDefault();
                loadContent('listDons.php');
            });

            $('#events').click(function (e) {
                e.preventDefault();
                loadContent('listevent.php');
            });

            $('#don_requests').click(function (e) {
                e.preventDefault();
                loadContent('reclamation.html');
            });

            $('#blog').click(function (e) {
                e.preventDefault();
                loadContent('listepub.php');
            });

            loadContent('default_content.php');
        });
    </script>
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="../assets/img/logo.png" alt="Logo" class="logox"></a>
            <h1 id="title">Management Dashboard</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#users" id="users">Users</a></li>
                <li><a href="#encher" id="encher">Encher</a></li>
                <li><a href="#dons" id="dons">Dons</a></li>
                <li><a href="#events" id="events">Events</a></li>
                <li><a href="#reclamation" id="don_requests">Reclamation</a></li>
                <li><a href="#blog" id="blog">Blog</a></li>
                <li><a href="addAdmin.php" id="admin">Add Admin</a></li>
                <li><a href="profile.php" id="profile">Profile</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div id="dynamic-content">
        </div>
    </main>

    <footer>
        <p>&copy; 2023 Sadaka Management Dashboard</p>
    </footer>
</body>

</html>