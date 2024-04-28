<?php
include "../config.php";
require_once "../controller/commentairec.php";
require_once "../model/commentaire.php";
require_once "../model/publication.php";

$CommentaireC=new CommentaireC();
if($_SERVER["REQUEST_METHOD"]=="POST"){
   if(isset($_POST['id']) && isset($_POST['search'])){
    $id =$_POST['id'];
    $list=$CommentaireC->affichecom($id); 
   }
}
$publications=$CommentaireC->affichepublication();
?>
<!DOCTYPE html>
<head>
    <title>Recherche de commentaire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        select {
            padding: 5px;
        }

        input[type="submit"] {
            padding: 8px 15px;
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h2 {
            margin-top: 20px;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <a href="admin.php">Back to list </a>
    <h1>Recherche de commentaire par publication</h1>
    <form action="" method="POST">
        <label for="id">Selectionnez une publication : </label>
        <select name="id" id="id">
            <?php
            foreach($publications as $publication ){
                echo '<option value="' .$publication['id']. '">'. $publication['id']  .  $publication['titre'] .'</option>';
            }
            ?>
            </select>
            <input type="submit" value="Rechercher" name="search">
        </form>
<?php if(isset($list)){?>
  <h2>commentaire correspondants a la publication selectionné : </h2>
  <ul>
    <?php foreach($list as $commentaire){?>
        <li><?= $commentaire['id_com'] ?> - <?= $commentaire['nom_auteur'] ?> - <?=$commentaire['contenu_com']?> - <?=$commentaire['date_creation']?> 
        <a href="deletecom.php?id=<?php echo $commentaire['id_com']; ?>">Delete</a></li>
        <?php } ?>

    </ul>
<?php } ?> 
</body>
</html>        