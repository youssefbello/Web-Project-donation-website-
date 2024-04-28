<?php
include '../controller/reponseC.php';
include_once '../controller/reclamationC.php';


$rep = new reponseC();
$rec = new reclamationC();
if (isset($_POST["aff"])) {
    if ($_POST["aff"] == "Tri") {
    $tabRep = $rep->triReponse();
    } else if ($_POST["aff"] == "Search") {
    $tabRep = $rep->rechercheReponse($_POST["rech"]);
    }
} else
    $tabRep = $rep->afficher()

?>



<!DOCTYPE html>
<html>

<body>

    <main>
        <div class="pagetitle">
            <h1>Liste des Reponses</h1>
            <br>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <center>
                                <form action="afficherReponse.php" method="POST">
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
                                            <th> Date </th>
                                            <th> Description </th>
                                            <th> Reclamation de </th>
                                            <th>    </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tabRep as $rep) { ?>
                                        <tr>
                                            <td> <?= $rep['date'] ?> </td>
                                            <td> <?= $rep['description'] ?> </td>
                                            <td> <?= $rec->recupererReclamation($rep['id_rec'])["email"] ?> </td>
                                            <td>
                                                <a href="modifierReponse.php?id=<?php echo $rep['id']; ?>"><button class="btn btn-outline-success btn-sm">Modifier</button></a>
                                                <a href="supprimerReponse.php?id=<?php echo $rep['id']; ?>"><button class="btn btn-outline-danger btn-sm">Supprimer</button></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
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