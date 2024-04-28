<?php
    include_once '../controller/reponseC.php';
    include_once '../model/reponse.php';


    $error = "";
    // create user
    $reponse = null;
    // create an instance of the controller
    $reponseC = new reponseC();
    if (
        isset($_POST['date']) &&
        isset($_POST['description']) &&
        isset($_POST['id_rec'])
    ){
        if (
            !empty($_POST["date"]) &&
            !empty($_POST["description"]) &&
            !empty($_POST["id_rec"])
        ) {
            $reponse = new reponse(
                $_POST['date'],
                $_POST['description'] ,
                $_POST['id_rec']
            );
			$reponseC->modifier($reponse,$_GET['id']);
        }
        else
            $error = "Missing information";
    }  
	if(isset($_POST['modifier']))
	{
    	header ('Location:afficherReponse.php');
	}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Dashboard | Modifier Reponse</title>
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
            <h1>Modifier Reponse</h1>
            <br>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body"> 
                        <?php 
                            if (isset($_GET['id'])){
                            $rep = $reponseC->recupererReponse($_GET['id']);
                        ?>
                        <form method="POST">
                            <div class="mb-5">
                                <div class="row">
                                    <div class="card-body" style="margin-left:50px;">
                                        <form method="POST" onsubmit="return verif();">
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <input type="date" name="date" value="<?php echo $rep['date']?>" class="form-control" id="date" placeholder="Date">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <textarea name="description" class="form-control" id="description" placeholder="Description"><?php echo $rep['description']?></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-10">
                                                    <input type="text" name="id_rec" value="<?php echo $rep['id_rec']?>" class="form-control file-upload-info" placeholder="Reclamation de Mr/Mme" readonly="readonly">
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

    <script src="ctrlReclamations.js"></script>
</body>

</html>