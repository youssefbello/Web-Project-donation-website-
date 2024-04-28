<?php
    include_once '../controller/reponseC.php';
    include_once '../controller/reclamationC.php';
    include_once '../model/reponse.php';


    date_default_timezone_set('Africa/Tunis');
    $systemDate = date('Y-m-d');

    $error = "";
    // create user
    $reponse = null;
    $reclamationC = new reclamationC();
    // create an instance of the controller
    $reponseC = new reponseC();
    if (
        isset($_POST['description'])
    ){
        if (
            !empty($_POST["description"])
        ) {
            $reponse = new reponse(
                $systemDate,
                $_POST['description'] ,
                $_GET["id"]
            );
			$reponseC->ajouter($reponse);
        }
        else
            $error = "Missing information";
    }

    if(isset($_POST['repondre']))
	{
    	header ('Location:afficherReponse.php');
	}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Dashboard | Ajouter Reponse</title>
    <link rel="stylesheet" type="text/css" href="back/admin.css">
    <link rel="shortcut icon" type="image/x-icon" href="back/assets/img/favicon.png">


    <link href="back/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="back/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="back/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="back/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="back/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="back/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="back/vendor/simple-datatables/style.css" rel="stylesheet">

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <a href="#"><img src="back/assets/img/logo.png" alt="Logo" class="logox"></a>
            <h1 id="title">Management Dashboard</h1>
            <br><br><br>
        </div>
        <nav>
            <ul>
                <li><a href="#users" id="users">Users</a></li>
                <li><a href="#encher" id="encher">Encher</a></li>
                <li><a href="#dons" id="dons">Dons</a></li>
                <li><a href="#events" id="events">Events</a></li>
                <li><a href="reclamation.html">Don Requests</a></li>
                <li><a href="#blog" id="blog">Blog</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="pagetitle">
            <h1>Ajouter une Reponse</h1>
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
                                                <div class="mb-5">
                                                    <div class="row">
                                                        <div class="card-body" style="margin-left:50px;">
                                                            <form method="POST" onsubmit="return verif();">
                                                                <div class="row mb-3">
                                                                    <div class="col-sm-10">
                                                                        <textarea name="description" class="form-control" id="description" placeholder="Description"></textarea>
                                                                        <br>
                                                                    </div>
                                                                </div>
                                                                <div class="text-center">
                                                                    <input class="btn btn-success" type="submit" name="repondre" value="Répondre">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
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

    <footer>
        <p>&copy; 2023 Sadaka Management Dashboard</p>
    </footer>

    <script src="ctrlReponse.js"></script>
</body>

</html>