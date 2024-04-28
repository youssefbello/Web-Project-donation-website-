<?php
include '../model/offre.php';
include '../controller/offreC.php';
include '../model/enchere.php';
include '../controller/enchereC.php';
session_start();

if (!isset($_SESSION["role"])) {
    die("FORBIDDEN");
}
$error = "";
$encherC = new enchereC();
$enchere = $encherC->show_enchere($_POST['id_enchere']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["nom"]) &&
        isset($_POST["prenom"]) &&
        isset($_POST["montant"]) &&
        isset($_POST["tel"]) &&
        isset($_POST["email"]) &&
        isset($_POST["date_offre"])
    ) {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $montant = $_POST['montant'];
        $tel = $_POST['tel'];
        $date = $_POST['date_offre'];
        $email = $_POST['email'];
        $id_enchere =  $_POST['id_enchere'];


        // Vérifiez que les champs requis ne sont pas vides
        if (!empty($nom) && !empty($prenom)  && !empty($date) && !empty($tel) && !empty($email) && !empty($montant)) {
            $offre = new offre(null, $nom, $prenom, $date, $montant, $tel, $email, $id_enchere);

            // Ajoutez l'offre à la base de données
            $offreC = new offreC();
            $offreC->add_offre($offre);

            // Redirige vers la page d'accueil
            header('Location: index.php');
            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            $error = "Missing information";
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['stripeToken'])) {
    require_once __DIR__ . '/../vendor/autoload.php'; 

    \Stripe\Stripe::setApiKey('sk_test_51OJMBwAZmmEr24Ck9oLM10KmhHqxuBg5edBXhRdX9MAtQ8R5xKm2w3NWYBRFzMKnczoQEAvCGAtLCsz1eRKcFEqp00eyaQxtP6');

    $token = isset($_POST['stripeToken']) ? $_POST['stripeToken'] : '';

    if (empty($token)) {
        // Gérer le cas où le token est vide
    } else {
        try {
            $charge = \Stripe\Charge::create([
                'amount' => $montant , // Montant en cents
                'currency' => 'usd',
                'description' => 'mise de l enchere',
                'source' => $token,
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            // Gérer les erreurs liées à la carte
            echo "Erreur de carte: " . $e->getError()->message;
        } catch (\Stripe\Exception\StripeException $e) {
            // Gérer les erreurs générales de Stripe
            echo "Erreur Stripe: " . $e->getMessage();
        } catch (Exception $e) {
            // Gérer les erreurs inattendues
            echo "Une erreur inattendue s'est produite: " . $e->getMessage();
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
    <title>Formulaire de Participation à une Enchère</title>
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
    <link rel="stylesheet" href="../assets/css1/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css1/styles_offre.css">
    <link rel="stylesheet" href="../assets/css1/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css1/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css1/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css1/themify-icons.css">
    <link rel="stylesheet" href="../assets/css1/nice-select.css">
    <link rel="stylesheet" href="../assets/css1/flaticon.css">
    <link rel="stylesheet" href="../assets/css1/gijgo.css">
    <link rel="stylesheet" href="../assets/css1/animate.css">
    <link rel="stylesheet" href="../assets/css1/slicknav.css">
    <link rel="stylesheet" href="../assets/css1/style.css">
    <link rel="stylesheet" href="../assets/tmplate_form/controle_saisie.css">
    <script src="../assets/js/controle_saisie.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>

    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Participation à une Vente aux Enchères</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="../view/ajout_offre.php" enctype="multipart/form-data" id="form">
                        <input type="hidden" name="id_enchere" value="<?php echo $_POST['id_enchere']; ?>">
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
                                    <input class="input--style-5" type="tel" id="tel" name="tel" placeholder="Format: 12-345-678" required>
                                    <span id="tel-error" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Date de l'Enchère</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="datetime-local" id="date" name="date_offre" readonly>
                                    <span id="date-error" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Mise</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" id="mise" name="montant" value="<?php echo $enchere["prix_min"] + 1 ?>" required>
                                    <span id="montant-error" class="error-message"></span>
                                    <script>
                                        function validerMontant() {
                                            var miseObjet = document.getElementById("mise");
                                            var montantParDefaut = <?php echo $enchere["prix_min"]; ?>;
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
                        <style>
                            #card-element {
                                border: 1px solid #ccc;
                                padding: 10px;
                                border-radius: 4px;
                                margin-bottom: 10px;
                            }

                            button {
                                background-color: #4CAF50;
                                color: white;
                                padding: 10px;
                                border: none;
                                border-radius: 4px;
                                cursor: pointer;
                            }

                            button:hover {
                                background-color: #45a049;
                            }

                            #card-errors {
                                color: #dc3545;
                                margin-top: 8px;
                            }
                        </style>
                        <div>
                            <input type="hidden" name="stripeToken" />
                            <div id="card-element"></div>
                            <div id="card-errors" role="alert"></div>
                            <br>
                        </div>
                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                        <div class="g-recaptcha" data-sitekey="6LeCrBspAAAAAIW8ZzA2-b6BNVJQxLfUx4NaQ5yI"></div>
                        <br>
                        <button type="submit" onclick="submitPayment()">Participer à l'Enchère</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/tmplate_form/controle_saisie2.js"></script>
    <script>
        var stripe = Stripe('pk_test_51OJMBwAZmmEr24CkZ9m3Y9N28azlQvRPeeGjT2ya5RJrixo33yl7gMTzm0JfAFMmg902QZLgATKQz6jyPUqMVy8v00MouUN7wC'); // Remplacez par votre clé publique Stripe
        var elements = stripe.elements();

        // Crée un Card Element et le montre dans le formulaire
        var card = elements.create('card');
        card.mount('#card-element');

        // Fonction pour soumettre le formulaire
        function submitPayment() {
            // Récupérer le montant de la mise aux enchères
            var bidAmount = document.getElementById('montant').value;

            // Crée une charge avec la carte de crédit du client
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Informe l'utilisateur s'il y a une erreur
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Ajouter le montant de la mise aux enchères au formulaire
                    var bidInput = document.createElement('input');
                    bidInput.setAttribute('type', 'hidden');
                    bidInput.setAttribute('name', 'montant');
                    bidInput.setAttribute('value', bidAmount);
                    document.getElementById('payment-form').appendChild(bidInput);

                    // Si la création du token est réussie, affichez un message d'alerte
                    alert("Paiement réussi pour une mise de " + bidAmount);

                    // Effacez le formulaire ou effectuez d'autres actions si nécessaire
                    document.getElementById('payment-form').reset();
                }
            });
        }
    </script>
    <!-- Les liens vers les fichiers CSS et JS restent inchangés -->
</body>
<?php

?>


</html>
<!-- end document-->