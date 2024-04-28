<?php
include '../model/enchere.php';
include '../controller/enchereC.php';

$error = "";
$etat = 0;

session_start();
if (!isset($_SESSION["role"])) {
    die("FORBIDDEN");
    
}

if ($_SESSION["role"] == "BASIC") {
    die("FORBIDDEN");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["nom_objet"]) &&
        isset($_POST["descr_objet"]) &&
        isset($_POST["prix_min"]) &&
        isset($_POST["date_debut"]) &&
        isset($_POST["date_fin"])
    ) {
        $nomObjet = $_POST['nom_objet'];
        $descriptionObjet = $_POST['descr_objet'];
        $prixInitial = $_POST['prix_min'];
        $dateDebut = $_POST['date_debut'];
        $dateFin = $_POST['date_fin'];
        $image = $_FILES['image_objet']['name']; // Update to get image from file upload

        // Vérifiez que les champs requis ne sont pas vides
        if (!empty($nomObjet) && !empty($descriptionObjet) && !empty($prixInitial) && !empty($dateDebut) && !empty($dateFin)) {
            // Définir le fuseau horaire pour la Tunisie
            date_default_timezone_set('Africa/Tunis');

            // Obtenir la date actuelle au format de la date locale en Tunisie
            $dateLocaleTunisie = date('Y-m-d H:i:s');
            $dateFinDateTime = new DateTime($dateFin);
            $dateActuelleDateTime = new DateTime($dateLocaleTunisie);

            if ($dateActuelleDateTime < $dateFinDateTime) {
                $etat = 1;
            } else {
                $etat = 0;
            }

            // Créez une instance de l'enchère avec l'état défini
            $enchere = new enchere(null, $dateDebut, $dateFin, $nomObjet, $prixInitial, $etat, 0, $descriptionObjet, $image);

            // Ajoutez l'enchère à la base de données
            $encherC = new enchereC();
            $encherC->add_enchere($enchere);

            // Redirigez l'utilisateur vers la page d'accueil
            header("Location: index.php");
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

    <link rel="stylesheet" rel="stylesheet" href="../assets/tmplate_form/css2/main.css">
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
    <link rel="stylesheet" href="../assets/tmplate_form/controle_saisie.css">
    <script src="../assets/tmplate_form/controle_saisie.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LeCrBspAAAAAIW8ZzA2-b6BNVJQxLfUx4NaQ5yI"></script>
</head>
</head>

<body>

    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Création d'une Vente aux Enchères</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="ajout_enchere.php" enctype="multipart/form-data" id="form">
                        <div class="form-row m-b-55">
                            <div class="name">Nom de l'objet</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" id="nom-objet" name="nom_objet" required>
                                    <span id="nom-objet-error" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Description</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="input--style-5" name="descr_objet" rows="4" style="width: 100%;" required></textarea>
                                    <span id="desc-objet-error" class="error-message"></span>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="name">Prix Initial</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" id="prix-min" type="number" name="prix_min" required>
                                    <span id="prix-objet-error" class="error-message"></span>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="name">Date de début de l'enchère</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" id="date-debut" type="datetime-local" name="date_debut" required>
                                    <span id="date-debut-error" class="error-message"></span>
                                    <script>
                                        // Get the current date and time
                                        var currentDate = new Date();

                                        // Format the date to YYYY-MM-DD
                                        var formattedDate = currentDate.toISOString().slice(0, 10);

                                        // Format the time to HH:MM (assuming your input type is datetime-local)
                                        var formattedTime = ("0" + currentDate.getHours()).slice(-2) + ":" + ("0" + currentDate.getMinutes()).slice(-2);

                                        // Combine date and time
                                        var dateTimeNow = formattedDate + "T" + formattedTime;

                                        // Set the minimum date and time for the input
                                        document.getElementById("date-debut").min = dateTimeNow;
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Date de fin de l'enchère</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" id="date-fin" type="datetime-local" name="date_fin" required>
                                    <span id="date-fin-error" class="error-message"></span>
                                    <script>
                                        // Get the current date and time
                                        var currentDate = new Date();

                                        // Format the date to YYYY-MM-DD
                                        var formattedDate = currentDate.toISOString().slice(0, 10);

                                        // Format the time to HH:MM (assuming your input type is datetime-local)
                                        var formattedTime = ("0" + currentDate.getHours()).slice(-2) + ":" + ("0" + currentDate.getMinutes()).slice(-2);

                                        // Combine date and time
                                        var dateTimeNow = formattedDate + "T" + formattedTime;

                                        // Set the minimum date and time for the input
                                        document.getElementById("date-fin").min = dateTimeNow;
                                        var endOf2027 = "2027-12-31T23:59";
                                        document.getElementById("date-fin").max = endOf2027;
                                    </script>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="name">Image de l'objet</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="file" name="image_objet" accept="image/*" required><span id="nom-objet-error" class="error-message"></span>
                                </div>
                            </div>

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
                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                        
                            <div class="g-recaptcha" data-sitekey="6LeCrBspAAAAAIW8ZzA2-b6BNVJQxLfUx4NaQ5yI"></div>
                        
                        <br>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Créer la Vente aux Enchères</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/template_form/controle_saisie.js"></script>
    <!-- Les liens vers les fichiers CSS et JS restent inchangés -->

</body>

</html>
<!-- end document-->