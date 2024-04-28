<?php
include '../controller/enchereC.php';
include '../model/enchere.php';
$error = "";
$enchere = null;

// Create an instance of the controller
$enchereC = new enchereC();

// Retrieve the existing enchere data
$idEnchere = isset($_POST['id_enchere']) ? $_POST['id_enchere'] : null;
$enchere = $enchereC->show_enchere($idEnchere);

if ($enchere) {

    // Check if the required fields are set and not empty
    if (
        isset($_POST["nom_objet"]) &&
        isset($_POST["descr"]) &&
        isset($_POST["prix_initial"]) &&
        !empty($_POST["nom_objet"]) &&
        !empty($_POST["descr"]) &&
        !empty($_POST["prix_initial"])
    ) {
        // Create a new enchere object with updated values
        $enchere = new enchere(
            $idEnchere,
            $_POST["date_debut"],
            $_POST["date_fin"],
            $_POST["nom_objet"],
            $_POST["prix_initial"],
            $_POST["etat"],
            $_POST["statut"],
            $_POST["descr"],
            $_POST["image_objet"]
        );

        // Update the enchere
        $enchereC->updateEnchere($enchere, $idEnchere);

        // Redirect to the index page after the update
        header('Location: historique_des_encheres.php');
        exit(); // Add exit after header to stop script execution
    } else {
        $error = "Missing information";
        echo $error;
    }
} else {
    $error = "Enchere not found"; // Handle the case where enchere is not found
    echo $error;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">


    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>
    <link rel="icon" type="image/png" href="../assets/tmplate_form/favicon.png">
    <!-- Icons font CSS-->
    <link href="../assets/tmplate_form/vendor2/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../assets/tmplate_form/vendor2/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../assets/tmplate_form/vendor2/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../assets/tmplate_form/vendor2/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../assets/tmplate_form/css2/main.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles_offre.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/tmplate_form/controle_saisie.js">
    <link rel="stylesheet" href="../assets/tmplate_form/controle_saisie.css">
    <script src="../assets/tmplate_form/controle_saisie.js"></script>
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Création d'une Vente aux Enchères</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="../view/update_enchere.php" enctype="multipart/form-data">
                    <input type="hidden" name="id_enchere" value="<?php echo $_POST['id_enchere']; ?>">
                        <div class="form-row m-b-55">
                            <div class="name">Nom de l'objet</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" id="nom-objet" name="nom_objet" value="<?php echo isset($enchere['nom_objet']) ? $enchere['nom_objet'] : ''; ?>" required>
                                </div>
                            </div>
                            <span id="nom-objet-error" class="error-message"></span>
                        </div>

                        <div class="form-row">
                            <div class="name">Description</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="input--style-5" name="descr" rows="4" style="width: 100%;" required ><?php echo $enchere['descr'] ?></textarea>
                                </div>
                            </div>
                            <span id="desc-objet-error" class="error-message"></span>
                        </div>
                        <div class="form-row">
                            <div class="name">Prix Initial</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" id="prix-initial" type="number" name="prix_initial" value="<?php echo $enchere['prix_min'] ?>" required>
                                </div>
                            </div>
                            <span id="prix-objet-error" class="error-message"></span>
                        </div>
                        <div class="form-row">
                            <div class="name">Date de début de l'enchère</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" id="date-debut" type="date" name="date_debut" value="<?php echo $enchere['date_debut'] ?>" required>
                                </div>
                            </div>
                            <span id="dated-objet-error" class="error-message"></span>
                        </div>
                        <div class="form-row">
                            <div class="name">Date de fin de l'enchère</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" id="date-fin" type="date" name="date_fin" value="<?php echo $enchere['date_fin'] ?>" required>
                                </div>
                            </div>
                            <span id="datef-objet-error" class="error-message"></span>
                        </div>

                        <div class="form-row">
                            <div class="name">Image de l'objet</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="file" name="image_objet" accept="image/*"  required>
                                </div>
                            </div>
                            <span id="nom-objet-error" class="error-message"></span>
                        </div>
                        <div class="form-row">
                            <div class="name">Méthode de collecte</div>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">En ligne
                                    <input type="radio" checked="checked" name="methode-collecte" value="en-ligne">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">PayPal
                                    <input type="radio" name="methode-collecte" value="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <span id="nom-objet-error" class="error-message"></span>
                        </div>
                        <div class="form-row p-t-20">
                            <label class="label label--block">Confirmez la création de la vente aux enchères</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Oui
                                    <input type="radio" checked="checked" name="confirmation" value="oui">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">Non
                                    <input type="radio" name="confirmation" value="non">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit" >Créer la Vente aux Enchères</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    
    ?>
    <script src="../assets/tmplate_form/controle_saisie.js"></script>
</body>

</html>
<!-- end document-->