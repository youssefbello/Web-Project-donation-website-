<?php
include '../controller/reclamationC.php';


$d = new reclamationC();
if (isset($_POST["aff"])) {
    if ($_POST["aff"] == "Tri") {
    $tab = $d->triReclamation();
    } else if ($_POST["aff"] == "Search") {
    $tab = $d->rechercheReclamation($_POST["rech"]);
    }
} else {
    $tab = $d->afficher();
}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Dashboard | Afficher Reclamations</title>
    <link rel="stylesheet" type="text/css" href="../assets/back/admin.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/back/assets/img/favicon.png">


    <link href="../assets/back/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/back/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/back/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/back/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/back/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/back/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/back/vendor/simple-datatables/style.css" rel="stylesheet">

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <main>
        <div class="pagetitle">
            <h1 style="align-items: center;">Liste des Reclamations</h1>
            <br>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <center>
                                <form action="afficherReclamation.php" method="POST">
                                    <br>
                                    <input type="text" placeholder="Search..." name="rech" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" style="height:50px;">
                                    <input type="submit" class="btn btn-outline-primary btn-sm" name="aff" value="Search" />
                                    <input type="submit" class="btn btn-outline-primary btn-sm" name="aff" value="Tri" />
                                </form>
                            </center>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> Nom </th>
                                            <th> Email </th>
                                            <th> Phone </th>
                                            <th> Etat </th>
                                            <th> Sujet </th>
                                            <th> Date </th>
                                            <th> Description </th>
                                            <th>    </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($tab as $rec) { ?>
                                        <tr>
                                            <td> <?= $rec['nom'] ?> </td>
                                            <td> <?= $rec['email'] ?> </td>
                                            <td> <?= $rec['phone'] ?> </td>
                                            <td> <?= $rec['etat'] ?> </td>
                                            <td> <?= $rec['sujet'] ?> </td>
                                            <td> <?= $rec['date'] ?> </td>
                                            <td> <?= $rec['description'] ?> </td>
                                            <td>
                                                <a href="modifierReclamation.php?id=<?php echo $rec['id']; ?>"><button class="btn btn-outline-success btn-sm">Modifier</button></a>
                                                <a href="supprimerReclamation.php?id=<?php echo $rec['id']; ?>"><button class="btn btn-outline-danger btn-sm">Supprimer</button></a>
                                                <a href="ajouterReponse.php?id=<?php echo $rec['id']; ?>"><button class="btn btn-outline-primary btn-sm">Repondre</button></a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>