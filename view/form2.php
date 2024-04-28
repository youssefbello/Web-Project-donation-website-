<?php
include '../model/event.php';
include '../controller/eventC.php';

$error = "";
$event = null ;
$eventC = new eventC() ;
    if (
        isset($_POST["obj"]) &&
        isset($_POST["place"]) &&
        isset($_POST["dh"]) &&
        isset($_POST["bud"]) &&
        isset($_POST["be"]) &&
        isset($_POST["nbrp"]) &&
        isset($_POST["type"]) 
    ) {
        if(
            !empty($_POST["obj"]) &&
            !empty($_POST["place"]) &&
            !empty($_POST["dh"]) &&
            !empty($_POST["bud"]) &&
            !empty($_POST["be"]) &&
            !empty($_POST["nbrp"]) &&
            !empty($_POST["type"])
        ){
            $event = new event(
                null ,
                $_POST['obj'],
                $_POST['place'],
                new DateTime($_POST['dh']),
                $_POST['bud'],
                $_POST['be'] ,
                $_POST['nbrp'] ,
                $_POST['type']
                
            );
            $eventC->addevent($event);
            header('Location:admin.php');
        }else
        $error = "";
       



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
    <title>Event</title>

   
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

 

    <!-- Main CSS-->
    <link href="../assets/css2/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Event Suggestion Form</h2>
                </div>
                <div class="card-body">
                <?php echo $error; ?>
                    <form method="POST" >
              
                        <div class="form-row m-b-55">
                            <div class="name">obj</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="obj" id="obj">
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                               
                            </div>
                            <span id="s1"></span>
                        </div>
                    
                        <div class="form-row">
                            <div class="name">place</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="place" id="place">
                                </div>
                            </div>
                            <span id="s2"></span>
                        </div>
                        <div class="form-row">
                            <div class="name">date</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="date" name="dh" id="dh">
                                </div>
                            </div>
                            <span id="s3"></span>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">budget</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="bud" id="bud">
                                </div>
                            </div>
                            <span id="s4"></span>
                        </div>
                        <div class="form-row">
                            <div class="name">bénéficier</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="be" id="be">
                                </div>
                            </div>
                            <span id="s5"></span>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">Number of participation</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="nbrp" id="nbrp">
                                </div>
                            </div>
                            
                            <span id="s6"></span>
                        </div>
                        <div class="form-row">
                            <div class="name">type</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="type" id="type">
                                </div>
                            </div>
                            <span id="s7"></span>
                        </div>
                        
                        <div>
                          <button class="btn btn--radius-2 btn--red"  type="submit"   onclick="validerEtSoumettre(event)">verifier</button> 

                        <input type="submit" value="Save" > 
 </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

  

    <!-- Main JS-->
    <script src="../assets/js/validation2.js"></script>

</body>

</html>
