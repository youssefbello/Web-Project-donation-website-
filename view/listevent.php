<?php
include "../controller/eventC.php";

$c = new eventC();

$triAttribut = isset($_GET['triAttribut']) ? $_GET['triAttribut'] : 'ide';
$triOrdre = isset($_GET['triOrdre']) ? $_GET['triOrdre'] : 'ASC';

// Récupérer la liste d'événements triée en utilisant la fonction tri
$tab = $c->tri($triAttribut, $triOrdre);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/listevent.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
    
</head>
<body>


    
    <center>
        
        <h1>Events list</h1>
        <div class="filters">
            <div>
                <label for="eventType">Choisir une option :</label>
                <select id="eventType">
                    <option value="listevent">Liste des event</option>
                    <option value="listsponsor">Liste des sponsors</option>
                    <option value="listpart">Liste des participation</option>
                </select>
                <button class="go-btn" onclick="redirectEvent()">Go</button>
            </div>
            <script>
                    function redirectEvent() {
                        var selectedOption = document.getElementById("eventType").value;
                        if (selectedOption === "listevent") {
                            // Rediriger vers la liste des dons
                            window.location.href = "listevent.php";
                        } else if (selectedOption === "listsponsor") {
                            // Rediriger vers la liste des participations
                            window.location.href = "listsponsor.php";
                        }
                        else if (selectedOption === "listpart") {
                            // Rediriger vers la liste des participations
                            window.location.href = "listpart.php";
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
        <h2>
            <a href="form2.php" class="add-button">Add</a>
        </h2>
    </center>
    <table border="1" align="center" width="100%">
        <tr>
            <th><a href="listevent.php?triAttribut=ide&triOrdre=<?= $triOrdre ?>">ID</a></th>
            <th><a href="listevent.php?triAttribut=obj&triOrdre=<?= $triOrdre ?>">Objectif</a></th>
            <th><a href="listevent.php?triAttribut=place&triOrdre=<?= $triOrdre ?>">Lieu</a></th>
            <th><a href="listevent.php?triAttribut=dh&triOrdre=<?= $triOrdre ?>">Date</a></th>
            <th><a href="listevent.php?triAttribut=type&triOrdre=<?= $triOrdre ?>">type</a></th>
            <th>Update</th> 
            <th>Delete</th> 
        </tr>
        <?php foreach ($tab as $event): ?>
            <tr>
                <td><?php echo $event['ide']; ?></td>
                <td><?php echo $event['obj']; ?></td>
                <td><?php echo $event['place']; ?></td>
                <td><?php echo $event['dh']; ?></td>
                <td><?php echo $event['type']; ?></td>
                <td><a href="update.php?ide=<?= htmlspecialchars($event["ide"]) ?>" class="update-button">Update</a></td>
                <td><a href="deleteE.php?ide=<?= htmlspecialchars($event["ide"]) ?>" class="delete-button">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>
