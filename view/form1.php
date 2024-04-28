<?php
include '../model/sponsor.php';
include '../controller/sponsorC.php';
include '../model/event.php';
include '../controller/eventC.php';
session_start();
if (!isset($_SESSION["role"])) {
    die("FORBIDDEN");
}
$error = "";
$c = new eventC();
$tab = $c->listevent();
$sponsor = null ;
$sponsorC = new sponsorC() ;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["noms"]) &&
        isset($_POST["typs"]) &&
        isset($_POST["ide"])

    ) {
        $noms = $_POST['noms'];
        $typs= $_POST['typs'];
        $ide =  $_POST['ide'];
        print_r('ide=' . $ide);
        if(
            !empty($_POST["noms"]) &&
            !empty($_POST["typs"]) &&
            !empty($_POST["ide"])  
           
        ){
            $sponsor = new sponsor(
                null ,
                $noms,
                $typs,
                $ide
                
            );
            $sponsorC->addsponsor($sponsor);
            header('Location:admin.php');
        }else
        $error = "Missing information";
       



  }
}

?>

<!-- Reste du code HTML inchangé -->

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
    <title>sponsor</title>


    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

   

    <!-- Main CSS-->
    <link href="../assets/css1/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Sponsor Form </h2>
                </div>
                <div class="card-body">
                <?php echo $error; ?>
                
                    <form method="POST"  action="form1.php" enctype="multipart/form-data" id="form" >
                   <!-- <input type="hidden" name="ids" value="<?php echo $_POST['ids']; ?>"> -->

                        <div class="form-row m-b-55">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="noms" id="noms" required>
                                            <label class="label--desc"> name</label>
                                        </div>
                                        <br>
                                        <span id="s1"></span>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="typs" id="typs" required>
                                            <label class="label--desc">type</label>
                                            <br>
                                            <br>
                                        <span id="s2"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">id event </div>
                            <div class="value">
                                <div class="input-group">
                                    <select id="ide" name="ide">
                                        <option>............</option>
                                        <?php
                                    foreach($tab as $event){
                                        ?>
                                <option value="<?php echo $event['ide']; ?>">
                        <?php echo $event['obj']; ?>
                    </option>
                                        <?php
                                    }
                                    ?>
                                    </select>
                                </div>
                                <br>
                                <span id="s3"></span>
                            </div>
                        </div>
                        
                      
                     
                        <div>
                          <button class="btn btn--radius-2 btn--red" type="submit" value="Signup" onclick="validerEtSoumettre (event)">verifier</button> 

                          <input type="submit" value="Save" > 

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

 

    <!-- Main JS-->
    <script src="../assets/js/valiid.js"></script>

</body>

</html>
<!-- end document-->