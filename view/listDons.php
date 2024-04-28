<?php
include "../controller/donsC.php";

// Créer une instance de la classe donsC
$donsC = new donsC();

if (isset($_GET['tri'])) {
    if ($_GET['tri'] === 'decroissant_prix') {
        // Tri par prix décroissant
        $don = $donsC->trierDonsParPrixDecroissant();
    } elseif ($_GET['tri'] === 'date_fin_proche') {
        // Tri par date de fin la plus proche
        $don = $donsC->trierDonsParDateFinProche();
    } else {
        // Par défaut, tri par prix croissant
        $don = $donsC->listDons();
    }
} else {
    // Par défaut, tri par prix croissant
    $don = $donsC->listDons();
}

$triAttribut = isset($_GET['triAttribut']) ? $_GET['triAttribut'] : 'id_donation';
$triOrdre = isset($_GET['triOrdre']) ? $_GET['triOrdre'] : 'ASC';

// Récupérer la liste de dons triée en utilisant la fonction tri
$tab = $donsC->tri($triAttribut, $triOrdre);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List des Dons</title>
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
    <center>
        <h1>List of Causes</h1>
        <div class="filters">
            <div>
                <label for="donsType">Choisir une option :</label>
                <select id="donsType">
                    <option value="listeDons">Liste des Dons</option>
                    <option value="listeParticipations">Liste des Particiations</option>
                </select>
                <button class="go-btn" onclick="redirectDons()">Go</button>
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
                    function redirectDons() {
                        var selectedOption = document.getElementById("donsType").value;
                        if (selectedOption === "listeDons") {
                            // Rediriger vers la liste des dons
                            window.location.href = "listDons.php";
                        } else if (selectedOption === "listeParticipations") {
                            // Rediriger vers la liste des participations
                            window.location.href = "list_participation.php";
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
    </center>
    <table>
        <tr>
            <th>ID Donation</th>
            <th>Cause</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Image</th>
            <th>Etat</th>
            <th>Montant Initial</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($don as $dons) { ?>
            <tr>
                <td>
                    <?php echo $dons['id_donation']; ?>
                </td>
                <td>
                    <?php echo $dons['cause']; ?>
                </td>
                <td>
                    <?php echo $dons['date_debut']; ?>
                </td>
                <td>
                    <?php echo $dons['date_fin']; ?>
                </td>
                <td>
                    <?php echo $dons['img']; ?>
                </td>
                <td>
                    <?php echo $dons['etat']; ?>
                </td>
                <td>
                    <?php echo $dons['amount']; ?>
                </td>
                <td>
                    <?php echo $dons['descr']; ?>
                </td>
                <td class="actions">

                    <form method="POST" action="updateDonation.php">
                    <input type="hidden" name="id_donation" value="<?php echo $dons['id_donation']; ?>">                        
                    <button type="submit" class="update-btn"><i class="fas fa-edit"></i> Modifier</button>
                    </form>
                    <a href="deleteDon.php?id=<?php echo $dons['id_donation']; ?>" class="delete-btn"><i
                            class="fas fa-trash-alt"></i> Supprimer</a>
            </tr>
        <?php } ?>
    </table>

    <!-- Bouton "Ajouter" en dehors du tableau -->
    <div class="actions">
        <a href="addDons.php" class="add-btn"><i class="fas fa-plus"></i> Ajouter</a>
    </div>
</body>

</html>