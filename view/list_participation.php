<?php
include '../Controller/participationC.php';
$participationC = new participationC();
$participations = $participationC->list_participation();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List des Participations</title>
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 3px;
            margin: 5px;
            display: inline-block;
        }

        .add-btn,
        .update-btn,
        .delete-btn {
            background-color: #4CAF50;
            color: white;
            display: inline-block;
            margin: 5px;
        }

        .add-btn:hover,
        .update-btn:hover,
        .delete-btn:hover {
            background-color: #45a049;
        }

        .actions {
            display: flex;
            justify-content: space-around;
            align-items: center;
            /* Ajout de cet alignement */
        }
    </style>
</head>

<body>
    <h1>Liste des Participations</h1>
    <div style="text-align: center; margin-bottom: 20px;">
        <label for="donsType">Choisir une option :</label>
        <select id="donsType">
            <option value="listeDons">Liste des Dons</option>
            <option value="listeParticipations">Liste des Participations</option>
        </select>
        <button onclick="redirectDons()">Go</button>
    </div>
    <script>
        function redirectDons() {
            var selectedOption = document.getElementById("donsType").value;
            if (selectedOption === "listeDons") {

                window.location.href = "listDons.php";
            } else if (selectedOption === "listeParticipations") {

                window.location.href = "list_participation.php";
            }
        }
    </script>

    <table>
        <tr>
            <th>ID participation</th>
            <th>id_donation</th>
            <th>nom</th>
            <th>prenom</th>
            <th>montant</th>
            <th>date_p</th>
            <th>email</th>
            <th>tel</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($participations as $participation) {
            ?>
            <tr>
                <td><?php echo $participation['id_participation']; ?></td>
                <td><?php echo $participation['id_donation']; ?></td>
                <td><?php echo $participation['nom']; ?></td>
                <td><?php echo $participation['prenom']; ?></td>
                <td><?php echo $participation['montant']; ?></td>
                <td><?php echo $participation['date_p']; ?></td>
                <td><?php echo $participation['email']; ?></td>
                <td><?php echo $participation['tel']; ?></td>
                <td align="center">
                    <a href="addDons.php" class="add-btn"><i class="fas fa-plus"></i> Ajouter</a>
                    <form method="GET" action="update_participation.php">
                        <input type="hidden" name="id_participation" value="<?php echo $participation['id_participation']; ?>">
                        <input type="hidden" name="id_donation" value="<?php echo $participation['id_donation']; ?>">
                        <button type="submit" class="update-btn"><i class="fas fa-edit"></i> Update</button>
                    </form>
                <td>
                    <a
                        href="delete_participation.php?id_participation=<?php echo $participation['id_participation']; ?>">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>

</html>