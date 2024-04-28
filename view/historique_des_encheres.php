<?php
include '../controller/enchereC.php';
$enchereC = new enchereC();

if (isset($_GET['tri'])) {
    if ($_GET['tri'] === 'decroissant_prix') {
        // Tri par prix décroissant
        $encheres = $enchereC->trierEncheresParPrixDecroissant();
    } elseif ($_GET['tri'] === 'date_fin_proche') {
        // Tri par date de fin la plus proche
        $encheres = $enchereC->trierEncheresParDateFinProche();
    } else {
        // Par défaut, tri par prix croissant
        $encheres = $enchereC->listenchere();
    }
} else {
    // Par défaut, tri par prix croissant
    $encheres = $enchereC->listenchere();
}
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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 20px;
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
            color: #fff;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-btn,
        .update-btn,
        .delete-btn,
        .filter-btn,
        .go-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-btn:hover,
        .update-btn:hover,
        .delete-btn:hover,
        .filter-btn:hover,
        .go-btn:hover {
            background-color: #2980b9;
        }

        .actions {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 20px;
        }

        .filters {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>List des Enchères</h1>
    <div class="filters">
        <div>
            <label for="enchereType">Choisir une option :</label>
            <select id="enchereType">
                <option value="listeEncheres">Liste des Enchères</option>
                <option value="listeMises">Liste des Mises</option>
            </select>
            <button class="go-btn" onclick="redirectEnchere()">Go</button>
        </div>
        <div>
            <label for="tri">Trier par :</label>
            <select id="tri">
                <option value="croissant_prix">Prix Croissant</option>
                <option value="decroissant_prix">Prix Décroissant</option>
                <option value="date_fin_proche">Date de fin la plus proche</option>
            </select>
            <button class="filter-btn" onclick="tri()">Filtrer</button>
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

                function tri() {
                    var selectedTri = document.getElementById("tri").value;
                    var url = window.location.href.split('?')[0]; // Supprimer les paramètres de l'URL actuelle
                    window.location.href = url + '?tri=' + selectedTri;
                }
            </script>
        </div>
    </div>

    <table>
        <tr>
            <th>ID Enchère</th>
            <th>État</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Prix Initial</th>
            <th>Description</th>
            <th>Nom Objet</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($encheres as $enchere) { ?>
            <tr>
                <td><?php echo $enchere['id_enchere']; ?></td>
                <td><?php echo $enchere['etat']; ?></td>
                <td><?php echo $enchere['date_debut']; ?></td>
                <td><?php echo $enchere['date_fin']; ?></td>
                <td><?php echo $enchere['prix_min']; ?></td>
                <td><?php echo $enchere['descr']; ?></td>
                <td><?php echo $enchere['nom_objet']; ?></td>
                <td><?php echo $enchere['image_objet']; ?></td>
                <td class="actions">

                    <form method="POST" action="update_enchere.php">
                        <input type="hidden" name="id_enchere" value="<?php echo $enchere['id_enchere']; ?>">
                        <button type="submit" class="update-btn"><i class="fas fa-edit"></i> Modifier</button>
                    </form>
                    <a href="delete_enchere.php?id=<?php echo $enchere['id_enchere']; ?>" class="delete-btn"><i class="fas fa-trash-alt"></i> Supprimer</a>
            </tr>
        <?php } ?>
    </table>

    <!-- Bouton "Ajouter" en dehors du tableau -->
    <div class="actions">
        <a href="ajout_enchere.php" class="add-btn"><i class="fas fa-plus"></i> Ajouter</a>
    </div>
</body>

</html>