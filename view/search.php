<?php
include "../controller/userC.php";

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    $uC = new userC();

    $searchResults = $uC->searchUsersByUsername($searchTerm);

    foreach ($searchResults as $table => $users) {
        if ($table == "user_table") {
            echo "<h2 style='text-align: center;'>Users</h2>";
        } else if ($table == "admin_table") {
            echo "<h2 style='text-align: center;'>Admins</h2>";
        } else if ($table == "vip_table") {
            echo "<h2 style='text-align: center;'>VIP</h2>";
        }
        echo "<table>
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
        </tr>";


        foreach ($users as $user) {
            // Output HTML for each user (similar to your existing HTML structure)

            if ($user["role"] != "admin") { 
                echo "<tr>
                        <td>" . htmlspecialchars($user['id']) . "</td>
                        <td>" . htmlspecialchars($user['name']) . "</td>
                        <td>" . htmlspecialchars($user['last_name']) . "</td>
                        <td>" . htmlspecialchars($user['username']) . "</td>
                        <td>" . htmlspecialchars($user['password']) . "</td>
                        <td>" . htmlspecialchars($user['age']) . "</td>
                        <td>" . htmlspecialchars($user['email']) . "</td>
                        <td>" . htmlspecialchars($user['role']) . "</td>
                        <td>" . htmlspecialchars($user['tel']) . "</td>
                        <td><a href='deleteUser.php?id=" . htmlspecialchars($user['id']) . "&action=2' class='delete-button'>Delete</a></td>
                        <td><a href='updateUser.php?id=" . htmlspecialchars($user['id']) . "' class='update-button'>Update</a></td>
                        <td><a href='VIP.php?id=" . htmlspecialchars($user['id']) . "&action=1' class='vip-button'>Give VIP</a></td>
                    </tr>";
            } else {
                echo "<tr>
                    <td>" . htmlspecialchars($user['id_admin']) . "</td>
                    <td>" . htmlspecialchars($user['name']) . "</td>
                    <td>" . htmlspecialchars($user['last_name']) . "</td>
                    <td>" . htmlspecialchars($user['username']) . "</td>
                    <td>" . htmlspecialchars($user['password']) . "</td>
                    <td>" . htmlspecialchars($user['age']) . "</td>
                    <td>" . htmlspecialchars($user['email']) . "</td>
                    <td>" . htmlspecialchars($user['role']) . "</td>
                    <td>" . htmlspecialchars($user['tel']) . "</td>
                    <td><a href='deleteUser.php?id=" . htmlspecialchars($user['id_admin']) . "&action=2' class='delete-button'>Delete</a></td>
                    <td><a href='updateUser.php?id=" . htmlspecialchars($user['id_admin']) . "' class='update-button'>Update</a></td>
                    <td><a href='#' class='vip-button'>SUPERVIP</a></td>
                </tr>";
            }
        }

        echo "</table>";
    }
}
?>
