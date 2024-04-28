<?php
include "../controller/userC.php";
session_start();
$uC = new userC();

$users = $uC->listUsers();
$admins = $uC->listAdmins();
$vips = $uC->listVIPs();

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/list.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="search-container">
        <form id="searchForm" action="#" method="GET" onsubmit="return false;">
            <label for="search"></label>
            <input type="text" id="search" name="search" placeholder="Search">
            <input type="submit" id="searchBtn" value="Search">
        </form>
    </div>

    <div id="searchResults"></div>
    <h2 style="text-align: center;">Admins</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Age</th>
            <th>Email</th>
            <th>Role</th>
            <th>Telephone</th>
            <th>Delete</th>
            <th>Update</th>
            <th>VIP</th>
        </tr>

        <?php foreach ($admins as $admin) : ?>
            <tr>
                <td><?= htmlspecialchars($admin['id_admin']) ?></td>
                <td><?= htmlspecialchars($admin['name']) ?></td>
                <td><?= htmlspecialchars($admin['last_name']) ?></td>
                <td><?= htmlspecialchars($admin['username']) ?></td>
                <td><?= htmlspecialchars($admin['password']) ?></td>
                <td><?= htmlspecialchars($admin['age']) ?></td>
                <td><?= htmlspecialchars($admin['email']) ?></td>
                <td><?= htmlspecialchars($admin['role']) ?></td>
                <td><?= htmlspecialchars($admin['tel']) ?></td>
                <?php
                    if ($_SESSION["id"] == 0 || $admin["id_admin"] == $_SESSION["id"]) {
                        echo ' 
                        <td><a href="deleteUser.php?id='.htmlspecialchars($admin["id_admin"]).'&action=0" class="delete-button">Delete</a></td>
                        <td><a href="updateUser.php?id='.htmlspecialchars($admin["id_admin"]).'" class="update-button">Update</a></td>
                        ';
                    } else {
                        echo ' 
                        <td><a href="#" class="delete-button">FORBIDDEN</a></td>
                        <td><a href="#" class="update-button">FORBIDDEN</a></td>
                        ';
                    }
                ?>
                <td>SUERVIP</td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <h2 style="text-align: center;">Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Age</th>
            <th>Email</th>
            <th>Role</th>
            <th>Telephone</th>
            <th>Delete</th>
            <th>Update</th>
            <th>VIP</th>
        </tr>

        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['last_name']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['password']) ?></td>
                <td><?= htmlspecialchars($user['age']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td><?= htmlspecialchars($user['tel']) ?></td>
                <td><a href="deleteUser.php?id=<?= htmlspecialchars($user["id"]) ?>&action=2" class="delete-button">Delete</a></td>
                <td><a href="updateUser.php?id=<?= htmlspecialchars($user["id"]) ?>" class="update-button">Update</a></td>
                <td><a href="VIP.php?id=<?=htmlspecialchars($user["id"])?>&action=1" class="vip-button">Give VIP</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <h2 style="text-align: center;">VIP</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Age</th>
            <th>Email</th>
            <th>Credit Card</th>
            <th>CCV</th>
            <th>Role</th>
            <th>Telephone</th>
            <th>Delete</th>
            <th>Update</th>
            <th>VIP</th>
        </tr>

        <?php foreach ($vips as $vip) : ?>
            <tr>
                <td><?= htmlspecialchars($vip['id']) ?></td>
                <td><?= htmlspecialchars($vip['name']) ?></td>
                <td><?= htmlspecialchars($vip['last_name']) ?></td>
                <td><?= htmlspecialchars($vip['username']) ?></td>
                <td><?= htmlspecialchars($vip['password']) ?></td>
                <td><?= htmlspecialchars($vip['age']) ?></td>
                <td><?= htmlspecialchars($vip['email']) ?></td>
                <td><?= htmlspecialchars($vip['cc']) ?></td>
                <td><?= htmlspecialchars($vip['ccv']) ?></td>
                <td><?= htmlspecialchars($vip['role']) ?></td>
                <td><?= htmlspecialchars($vip['tel']) ?></td>
                <td><a href="deleteUser.php?id=<?= htmlspecialchars($vip["id"]) ?>&action=1" class="delete-button">Delete</a></td>
                <td><a href="updateUser.php?id=<?= htmlspecialchars($vip["id"]) ?>" class="update-button">Update</a></td>
                <td><a href="VIP.php?id=<?=htmlspecialchars($vip["id"])?>&action=2" class="vip-button-purge">Purge VIP</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <script>
    $(document).ready(function () {
        function loadContent(url, data) {
            $('#searchResults').empty(); // Clear existing content
            $.ajax({
                type: "GET",
                url: url,
                data: data,
                success: function (response) {
                    $('#searchResults').html(response);
                }
            });
        }

        $('#searchForm').on('submit', function (e) {
            e.preventDefault();
            var searchTerm = $('#search').val();
            loadContent('search.php', { search: searchTerm });
        });
    });
    </script>



</body>
</html>