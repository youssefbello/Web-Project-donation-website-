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
        isset($_POST['etat']) &&
        isset($_POST['sujet']) &&
        isset($_POST['date']) &&
        isset($_POST['description'])
    ){
        if (
            !empty($_POST["nom"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["phone"]) &&
            !empty($_POST["etat"]) &&
            !empty($_POST["sujet"]) &&
            !empty($_POST["date"]) &&
            !empty($_POST["description"]) 
        ) {
            $reclamation = new reclamation(
                $_POST['nom'],
                $_POST['email'] ,
                $_POST['phone'] ,
                $_POST['etat'] ,
                $_POST['sujet'] ,
                $_POST['date'] ,
                $_POST['description'] 
            );
			$reclamationC->modifier($reclamation,$_GET['id']);
        }
        else
            $error = "Missing information";
   }

   if(isset($_POST['modifier']))
	{
    	header ('Location: afficherReclamation.php');
	}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Dashboard | Modifier Reclamations</title>
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
    <header>
        <div class="logo">
            <a href="#"><img src="../assets/img/logo.png" alt="Logo" class="logox"></a>
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
            <h1>Modifier Reclamation</h1>
            <br>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body"> 
                            <?php 
                                if (isset($_GET['id'])){
                                $rec = $reclamationC->recupererReclamation($_GET['id']);
                            ?>
                            <form method="POST" onsubmit="return verif();">
                                <div class="mb-5">
                                    <div class="row">
                                        <div class="card-body" style="margin-left:50px;">
                                        <form method="POST">
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control p-2" value="<?php echo $rec['nom']?>" name="nom" id="nom" placeholder="Nom">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control p-2" value="<?php echo $rec['email']?>" name="email" id="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control p-2" value="<?php echo $rec['phone']?>" name="phone" id="phone" placeholder="Phone">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <select class="form-control p-2" name="etat" id="etat">
                                                        <option value="<?php echo $rec['etat']?>"><?php echo $rec['etat']?></option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Not Approved">Not Approved</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control p-2" value="<?php echo $rec['sujet']?>" name="sujet" id="sujet" placeholder="Sujet">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control p-2" value="<?php echo $rec['date']?>" name="date" id="date" placeholder="Date">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control p-2" name="description" id="description" placeholder="Description"><?php echo $rec['description']?></textarea>
                                                </div>
                                            <br>
                                            </div>
                                            <div class="text-center">
                                                <input class="btn btn-success" type="submit" name="modifier" value="Modifier">
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Sadaka Management Dashboard</p>
    </footer>

    <script src="../assets/js/ctrlReclamations.js"></script>
</body>

</html>