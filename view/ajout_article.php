<?php
include('../controller/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $auteur = $_POST['auteur'];

    $sql = "INSERT INTO publication (titre, contenu, auteur) VALUES ('$titre', '$contenu', '$auteur')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Article ajouté avec succès";
    } else {
        echo "Erreur lors de l'ajout de l'article : " . $conn->error;
    }
}

$conn->close();
?>