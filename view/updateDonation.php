<?php
include '../controller/donsC.php';
include '../model/dons.php';

$error = "";

// Check if the ID is provided in the query parameters
if (!isset($_POST['id_donation'])) {
    echo "Error: Missing donation ID in the form.";
    exit();
}

$id_donation = $_POST['id_donation'];

// Create an instance of the donsC class
$donsC = new donsC();

// Retrieve the donation data based on the ID
$donsData = $donsC->show_Dons($id_donation);

// Check if the donation data is retrieved successfully
if (!$donsData) {
    echo "Error: Unable to retrieve donation data.";
    exit();
}

// Create an instance of the dons class using the retrieved data
$dons = new dons(
    $donsData['id_donation'],
    $donsData['cause'],
    $donsData['date_debut'],
    $donsData['date_fin'],
    $donsData['img'],
    $donsData['etat'],
    $donsData['amount'],
    $donsData['descr']
);

// Continue with the rest of your code

if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
    // Handle image upload only if a new file is selected
    $targetDir = "../assets/img/";
    $targetFilePath = $targetDir . basename($_FILES['img']['name']);

    if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath)) {
        // File uploaded successfully, update the image path in the database
        $dons->setImg($targetFilePath);
        echo "File uploaded to: " . $targetFilePath;
    } else {
        echo "Error uploading file.";
    }
}
if (
    isset($_POST["cause"]) &&
    isset($_POST["date_debut"]) &&
    isset($_POST["date_fin"]) &&
    isset($_POST["amount"]) &&
    isset($_POST["descr"])
) {
    if (
        !empty($_POST["cause"]) &&
        !empty($_POST["date_debut"]) &&
        !empty($_POST["date_fin"]) &&
        !empty($_POST["amount"]) &&
        !empty($_POST["descr"])
    ) {
        // Supposons que vous ayez récupéré $id à partir des données du formulaire
        $id_donation = $_POST['id_donation'];

        // Vérifiez si la variable contient la valeur attendue
        echo "ID de la donation récupéré : " . $id_donation;

        $dons = new dons(
            $id_donation,
            $_POST['cause'],
            $_POST['date_debut'],
            $_POST['date_fin'],
            $_POST['img'],
            $_POST['etat'],
            $_POST['amount'],
            $_POST['descr']
        );

        // Appel de la fonction d'update avec les données de la donation et l'ID
        $donsC->updateDonation($dons, $id_donation);

        header('Location: index.php');
        exit(); // Add exit after header to stop script execution
    } else {
        $error = "Missing information";
        echo $error;
    }
} else {
    $error = "Missing information";
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
    <title>Update Form</title>
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <!-- Icons font CSS-->
    <link href="../assets/vendor2/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../assets/vendor2/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../assets/vendor2/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../assets/vendor2/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../assets/css2/main.css" rel="stylesheet" media="all">
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
    <link rel="stylesheet" href="../assets/controle_saisie.js">
    <link rel="stylesheet" href="../assets/controle_saisie.css">
    <script src="../assets/js/controle_saisie.js"></script>
</head>

<body>
    <?php
    // Add this block to show existing data in the form
    if (isset($_POST['id_donation'])) {
        $dons = $donsC->show_Dons($_POST['id_donation']);
        ?>
        <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
            <div class="wrapper wrapper--w790">
                <div class="card card-5">
                    <div class="card-heading">
                        <h2 class="title">Création d'une Cause Humanitaire</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="updateDonation.php" enctype="multipart/form-data">
                            <input type="hidden" name="id_donation" value="<?php echo $dons['id_donation']; ?>">
                            <div class="form-row m-b-55">
                                <div class="name">Nom de la cause</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" type="text" id="nom-objet" name="cause"
                                            value="<?php echo isset($dons['cause']) ? $dons['cause'] : ''; ?>" required>
                                    </div>
                                </div>
                                <span id="nom-objet-error" class="error-message"></span>
                            </div>

                            <div class="form-row">
                                <div class="name">Description</div>
                                <div class="value">
                                    <div class="input-group">
                                        <textarea class="input--style-5" name="descr" rows="4" style="width: 100%;"
                                            required><?php echo $dons['descr'] ?></textarea>
                                    </div>
                                </div>
                                <span id="desc-objet-error" class="error-message"></span>
                            </div>
                            <div class="form-row">
                                <div class="name">Montant Initial</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" id="prix-initial" type="number" name="amount"
                                            value="<?php echo $dons['amount'] ?>" required>
                                    </div>
                                </div>
                                <span id="prix-objet-error" class="error-message"></span>
                            </div>
                            <div class="form-row">
                                <div class="name">Date de début </div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" id="date-debut" type="date" name="date_debut"
                                            value="<?php echo $dons['date_debut'] ?>" required>
                                    </div>
                                </div>
                                <span id="dated-objet-error" class="error-message"></span>
                            </div>
                            <div class="form-row">
                                <div class="name">Date de fin </div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-5" id="date-fin" type="date" name="date_fin"
                                            value="<?php echo $dons['date_fin'] ?>" required>
                                    </div>
                                </div>
                                <span id="datef-objet-error" class="error-message"></span>
                            </div>
                            <div class="form-row">
                                <div class="name">Image de la cause</div>
                                <div class="value">
                                    <div class="input-group">
                                    <input class="input--style-5" type="file" name="img" accept="image/*" required>
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
                                <label class="label label--block">Confirmez la création de la cause humanitaire</label>
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
                                <button class="btn btn--radius-2 btn--red" type="submit">Mettre à jour la cause</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <script src="../assets/js/controle_saisie.js"></script>
</body>

</html>
<!-- end document-->