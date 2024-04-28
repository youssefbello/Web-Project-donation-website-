<?php
include '../controller/offreC.php';
$offreC= new offreC();
$offres = $offreC->listoffre();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List des Enchères</title>
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
            align-items: center; /* Ajout de cet alignement */
        }
    </style>
</head>

<body>
    <h1>Liste des Mises</h1>
    <div style="text-align: center; margin-bottom: 20px;">
        <label for="enchereType">Choisir une option :</label>
        <select id="enchereType">
            <option value="listeEncheres">Liste des Enchères</option>
            <option value="listeMises">Liste des Mises</option>
        </select>
        <button onclick="redirectEnchere()">Go</button>
    </div>
    <script>
        function redirectEnchere() {
            var selectedOption = document.getElementById("enchereType").value;
            if (selectedOption === "listeEncheres") {
                // Rediriger vers la liste des enchères
                window.location.href = "historique_des_encheres.php";
            } else if (selectedOption === "listeMises") {
                // Rediriger vers la liste des mises
                window.location.href = "liste_des_mises.php";
            }
        }
    </script>
    <table>
        <tr>
            <th>ID offre</th>
            <th>id_enchere</th>
            <th>nom</th>
            <th>prenom</th>
            <th>date</th>
            <th>email</th>
            <th>tel</th>
            <th>montant</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($offres as $offre) { ?>
            <tr>
                <td><?php echo $offre['id_offre']; ?></td>
                <td><?php echo $offre['id_enchere']; ?></td>
                <td><?php echo $offre['nom']; ?></td>
                <td><?php echo $offre['prenom']; ?></td>
                <td><?php echo $offre['date_offre']; ?></td>
                <td><?php echo $offre['email']; ?></td>
                <td><?php echo $offre['tel']; ?></td>
                <td><?php echo $offre['montant']; ?></td>
                <td class="actions">
                    <a href="ajout_enchere.php" class="add-btn"><i class="fas fa-plus"></i> Ajouter</a>
                    <form method="GET" action="update_offre.php">
                        <input type="hidden" name="id_offre" value="<?php echo $offre['id_offre']; ?>">
                        <input type="hidden" name="id_enchere" value="<?php echo $offre['id_enchere']; ?>">
                        <button type="submit" class="update-btn"><i class="fas fa-edit"></i> Modifier</button>
                    </form>
                    <a href="delete_offre.php?id=<?php echo $offre['id_offre']; ?>" class="delete-btn"><i class="fas fa-trash-alt"></i> Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>

