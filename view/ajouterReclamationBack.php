<?php
    include_once '../controller/reclamationC.php';
    include_once '../model/reclamation.php';


    date_default_timezone_set('Africa/Tunis');
    $systemDate = date('Y-m-d');

    $error = "";
    // create user
    $reclamation = null;
    // create an instance of the controller
    $reclamationC = new reclamationC();
    if (
        isset($_POST['nom']) &&
        isset($_POST['email']) &&
        isset($_POST['phone']) &&
        isset($_POST['sujet']) &&
        isset($_POST['description'])
    ){
        if (
            !empty($_POST["nom"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["phone"]) &&
            !empty($_POST["sujet"]) &&
            !empty($_POST["description"]) 
        ) {
            $reclamation = new reclamation(
                $_POST['nom'],
                $_POST['email'] ,
                $_POST['phone'] ,
                "Pending" ,
                $_POST['sujet'] ,
                $systemDate ,
                $_POST['description'] 
            );
			$reclamationC->ajouter($reclamation);
            $reclamationC->sendSMS();
        }
        else
            $error = "Missing information";
   }

   if(isset($_POST['ajouter']))
	{
    	header ('Location:afficherReclamation.php');
	}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Dashboard | Ajouter Reclamations</title>
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
            <h1>Ajouter une Reclamation</h1>
            <br>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <form method="POST" onsubmit="return verif();">
                                <div class="mb-5">
                                    <div class="row">
                                        <div class="card-body" style="margin-left:50px;">
                                            <form method="POST">
                                                <div class="row mb-3">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control p-2" name="nom" id="nom" placeholder="Nom">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control p-2" name="email" id="email" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control p-2" name="phone" id="phone" placeholder="Phone">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control p-2" name="sujet" id="sujet" placeholder="Sujet">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-10">
                                                        <textarea type="text" class="form-control p-2" name="description" id="description" placeholder="Description"></textarea>
                                                    </div>
                                                <br>
                                                </div>
                                                <div class="text-center">
                                                    <input class="btn btn-success" type="submit" name="ajouter" value="Ajouter">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="ctrlReclamations.js"></script>
</body>

</html>