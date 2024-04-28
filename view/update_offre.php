<?php
include '../model/offre.php';
include '../controller/offreC.php';
include '../model/enchere.php';
include '../controller/enchereC.php';

$error = "";
$encherC = new enchereC();

$offre = null;
$offreC = new offreC();

if (

    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["tel"]) &&
    isset($_POST["date_offre"]) &&
    isset($_POST["montant"])
) {

    if (
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["tel"]) &&
        !empty($_POST["date_offre"]) &&
        !empty($_POST["montant"])
    ) {
        $offre = new offre(
            $_POST["id_offre"],
            $_POST["nom"],
            $_POST["prenom"],
            $_POST["email"],
            $_POST["tel"],
            $_POST["montant"],
            $_POST["date_offre"],
            $_GET["id_enchere"]
        );

        // Ajoutez l'offre à la base de données
        $offreC = new offreC();
        $offreC->updateoffre($offre, $_GET["id_offre"]);

        // Redirige vers la page d'accueil
        header('Location: ../view/admin.php');
        exit(); // Assurez-vous de terminer le script après la redirection

    }
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
    <title>Formulaire de Participation à une Enchère</title>
    <link rel="icon" type="image/png" href="../assets/tmplate_form/favicon.png">
    <!-- Icons font CSS-->
    <link href="../view/tmplate_form/vendor2/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../view/tmplate_form/vendor2/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../view/tmplate_form/vendor2/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../view/tmplate_form/vendor2/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->

    <link rel="stylesheet" rel="stylesheet" href="../view/tmplate_form/css2/main.css">
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
    <link rel="stylesheet" href="../view/tmplate_form/controle_saisie.css">
    <script src="../view/tmplate_form/controle_saisie.js"></script>
</head>

<body>
    <?php
    // Add this block to show existing data in the form
    if (isset($_GET['id_offre'])) {
        $offre = $offreC->show_offre($_GET['id_offre']);

    ?>
        <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
            <div class="wrapper wrapper--w790">
                <div class="card card-5">
                    <div class="card-heading">
                        <h2 class="title">Participation à une Vente aux Enchères</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../view/update_offre.php" enctype="multipart/form-data" id="form">
                            <input type="hidden" name="id_offre" value="<?php echo $_GET['id_offre']; ?>">
                            <input type="hidden" name="id_enchere" value="<?php echo $_GET['id_enchere']; ?>">
                            <div class="form-row">
                                <div class="name">Nom</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="text" id="nom" name="nom" value="<?php echo $offre['nom']; ?>" required>
                                        <span id="nom-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="name">Prénom</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="text" id="prenom" name="prenom" value="<?php echo $offre['prenom']; ?>" required>
                                        <span id="prenom-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="name">Email</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="email" id="email" name="email" value="<?php echo $offre['email']; ?>" required>
                                        <span id="email-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="name">Téléphone</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="tel" id="tel" name="tel" placeholder="Format: 12-345-678" value="<?php echo $offre['tel']; ?>" required>
                                        <span id="tel-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Date de l'Enchère</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="datetime-local" id="date" name="date_offre" value="<?php echo $offre['date_offre']; ?>" readonly>
                                        <span id="date-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Mise</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="number" id="mise" name="montant" value="<?php echo $offre['montant']; ?>" required>
                                        <span id="montant-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>
                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                            <div class="g-recaptcha" data-sitekey="6LeCrBspAAAAAIW8ZzA2-b6BNVJQxLfUx4NaQ5yI"></div>
                            <br>
                            <div>
                                <button class="btn btn--radius-2 btn--red" type="submit">Modifier l'Enchère</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <script src="../view/tmplate_form/controle_saisie2.js"></script>
    <!-- Les liens vers les fichiers CSS et JS restent inchangés -->
</body>

</html>
<!-- end document-->