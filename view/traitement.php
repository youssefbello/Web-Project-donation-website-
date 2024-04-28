<?php
include "../config.php";
include "../model/commentaire.php";
include "../controller/publicationc.php";
include "../controller/commentairec.php";
$publicationC = new publicationC();
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $publication = $publicationC->showpublication($id);
 }
if(empty($_GET['id'])){
    die("l'article demande n'existe pas ! ");
}
$CommentaireC = new CommentaireC();
if (isset($_POST['add-comment'])) {
    if (!empty($_POST['contenu_com']) && !empty($_POST['nom_auteur'])) {
            $id=$_POST['id'];
            $nom_auteur=$_POST['nom_auteur'];
            $contenu_com=$_POST['contenu_com'];
            $CommentaireC->addCommentaire($id,$nom_auteur,$contenu_com);
            header('Location:../view/single-blog.php?id='.$_POST['id']);
            exit();
    }
}
if (
    isset($_POST["contenu_com"]) &&
    isset($_POST["nom_auteur"]) 
) {
    if (
        !empty($_POST['contenu_com']) &&
        !empty($_POST['nom_auteur'])
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $commentaire = new commentaire(
            null,
            $_POST['contenu_com'],
            $_POST['nom_auteur']
        );
        var_dump($commentaire);
        
        $CommentaireC->updatecommentaire($commentaire, $_POST['id_com']);

        header('Location:../view/single-blog.php?id='.$_POST['id']);
    }
}