<?php
require_once '../config.php'; // Remplacez par le chemin correct vers votre fichier de configuration
include "../controller/commentairec.php";
include "../model/commentaire.php";
$CommentaireC = new CommentaireC();
if ($CommentaireC->supprimerCommentaire($_GET["id"])) {
    header('Location:searchcom.php');
    exit();
} else {
    echo "Erreur lors de la suppression du commentaire.";
}
?>

