<?php
require_once '../config.php';
include "../controller/commentairec.php";
include "../model/commentaire.php";

$CommentaireC = new CommentaireC();

$id_com = isset($_GET["id"]) ? $_GET["id"] : null;
if ($CommentaireC->supprimerCommentaire($id_com)) {
        header('Location:../view/blog.php');
        exit();
} else {
        echo "Erreur lors de la suppression du commentaire.";
    }
?>