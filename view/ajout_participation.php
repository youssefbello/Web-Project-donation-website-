<?php
include '../Model/participation.php';
include '../Controller/participationC.php';
include '../Controller/donsC.php';
include '../Model/dons.php';

session_start();
if (!isset($_SESSION["role"])) {
    die("FORBIDDEN");
}

$error = "";
$c = new donsC(); // Utilisation de la classe donsC pour gérer les dons

$c2 = new participationC();
$tab = $c2->list_participation();
$participation = null;
$participationC = new participationC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["nom"]) &&
        isset($_POST["prenom"]) &&
        isset($_POST["montant"]) &&
        isset($_POST["date_p"]) &&
        isset($_POST["email"]) &&
        isset($_POST["tel"]) &&
        isset($_POST["id_donation"])
    ) {
        echo $id_donation;
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $montant = $_POST['montant'];
        $date = $_POST['date_p'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $id_donation = $_POST['id_donation'];
        print_r('id_donation=' . $id_donation);

        // Vérifiez que les champs requis ne sont pas vides
        if (!empty($nom) && !empty($prenom) && !empty($montant) && !empty($date) && !empty($email) && !empty($tel)) {
            $participation = new participation(null, $nom, $prenom, $montant, $date, $email, $tel, $id_donation);
            $participationC->ajout_participation($participation);

            // Redirige vers la page d'accueil
            header('Location: donsF.php');
            exit(); // Ajout de l'instruction exit pour arrêter l'exécution du script après la redirection
        } else {
            $error = "Missing information";
        }
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
    <link href="../view/vendor2/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../view/vendor2/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../view/vendor2/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../view/vendor2/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->

    <link rel="stylesheet" rel="stylesheet" href="../assets/css2/main.css">
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
    <link rel="stylesheet" href="../asset/css/controle_saisie.css">
    <script src="../assets/js/controle_saisie.js"></script>
</head>

<body>

<div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Participation à un don</h2>
            </div>
            <div class="card-body">
            <?php echo $error; ?>
                <form method="POST" action="ajout_participation.php" enctype="multipart/form-data" id="form">
                    <input type="hidden" name="id_donation" value="<?php echo($_POST['id_donation']); ?>">
                    <div class="form-row">
                        <div class="name">Nom</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="text" id="nom" name="nom" required>
                                <span id="nom-error" class="error-message"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Prénom</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="text" id="prenom" name="prenom" required>
                                <span id="prenom-error" class="error-message"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Email</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="email" id="email" name="email" required>
                                <span id="email-error" class="error-message"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Téléphone</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="tel" id="tel" name="tel"
                                    placeholder="Format: 12-345-678" required>
                                <span id="tel-error" class="error-message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Date du Don</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="datetime-local" id="date" name="date_p"
                                    readonly>
                                <span id="date-error" class="error-message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Montant</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="number" id="mise" name="montant"
                                    value="<?php echo $dons["amount"] + 1 ?>" required>
                                <span id="montant-error" class="error-message"></span>
                                <script>
                                    function validerMontant() {
                                        var miseObjet = document.getElementById("mise");
                                        var montantParDefaut = <?php echo $dons["amount"]; ?>;
                                        var montantObjetError = document.getElementById("montant-error");

                                        if (miseObjet.value <= montantParDefaut) {
                                            montantObjetError.innerHTML = "Le montant doit être supérieur à celui par défaut.";
                                            miseObjet.style.border = "1.5px solid red";
                                            miseObjet.style.borderColor = "red";
                                        } else {
                                            montantObjetError.innerHTML = "";
                                            miseObjet.style.border = "none";
                                            miseObjet.style.borderColor = "green";
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>

                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                    <div class="g-recaptcha" data-sitekey="6Ld0fB0pAAAAAOU9-ylQjST4CJxrSSvyJbFqEfAX"></div>
                    <br>
                    <br>
                    <br>

                    <div>
                        <button class="btn btn--radius-2 btn--red" type="submit">Participer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/controle_saisie2.js"></script>
<!-- Les liens vers les fichiers CSS et JS restent inchangés -->
</body>
</html>
<!-- end document-->