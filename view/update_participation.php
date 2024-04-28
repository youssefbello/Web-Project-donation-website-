<?php
include '../Model/participation.php';
include '../Controller/participationC.php';
include '../Model/dons.php';
include '../Controller/donsC.php';

$error = "";
$donC = new donsC;

$participation = null;
$participationC = new participationC();

if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["tel"]) &&
    isset($_POST["date_p"]) &&
    isset($_POST["montant"])
) {

    if (
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["tel"]) &&
        !empty($_POST["date_p"]) &&
        !empty($_POST["montant"])
    ) {
        $participation = new $participation(
            $_POST["id_participation"],
            $_POST["nom"],
            $_POST["prenom"],
            $_POST["email"],
            $_POST["tel"],
            $_POST["date_p"],
            $_POST["montant"],
            $_GET["id_donation"]
        );

        // Ajoutez la participation à la base de données
        $participationC = new participationC();
        $participationC->update_participation($participation, $_GET["id_participation"]);

        // Redirige vers la page d'accueil
        header('Location: ../Views/admin.php');
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
    <title>Formulaire de Participation à un Don</title>
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <!-- Icons font CSS-->
    <link href="../Views/vendor2/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../Views/vendor2/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../Views/vendor2/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../Views/vendor2/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->

    <link href="../Views/css2/main.css" rel="stylesheet" media="all">
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
    <link rel="stylesheet" href="../Views/controle_saisie.js">
    <link rel="stylesheet" href="../Views/controle_saisie.css">
    <script src="../Views/controle_saisie.js"></script>
</head>

<body>
    <?php
    // Add this block to show existing data in the form
    if (isset($_GET['id_participation'])) {
        $participation = $participationC->show_participation($_GET['id_participation']);

        ?>
        <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
            <div class="wrapper wrapper--w790">
                <div class="card card-5">
                    <div class="card-heading">
                        <h2 class="title">Participation à un Don</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="update_participation.php" enctype="multipart/form-data" id="form">
                            <input type="hidden" name="id_participation" value="<?php echo $_GET['id_participation']; ?>">
                            <input type="hidden" name="id_donation" value="<?php echo $_GET['id_donation']; ?>">
                            <div class="form-row">
                                <div class="name">Nom</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="text" id="nom" name="nom"
                                            value="<?php echo $participation['nom']; ?>" required>
                                        <span id="nom-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="name">Prénom</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="text" id="prenom" name="prenom"
                                            value="<?php echo $participation['prenom']; ?>" required>
                                        <span id="prenom-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="name">Email</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="email" id="email" name="email"
                                            value="<?php echo $participation['email']; ?>" required>
                                        <span id="email-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="name">Téléphone</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="tel" id="tel" name="tel"
                                            placeholder="Format: 12-345-678" value="<?php echo $participation['tel']; ?>"
                                            required>
                                        <span id="tel-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Date du Don</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="datetime-local" id="date" name="date_p"
                                            value="<?php echo $participation['date_p']; ?>" readonly>
                                        <span id="date-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Montant</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="number" id="montant" name="montant"
                                            value="<?php echo $participation['montant']; ?>" required>
                                        <span id="montant-error" class="error-message"></span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button class="btn btn--radius-2 btn--red" type="submit">Modifier la Cause</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <script src="../Views/controle_saisie2.js"></script>
    <!-- Les liens vers les fichiers CSS et JS restent inchangés -->
</body>

</html>
<!-- end document-->