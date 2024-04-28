<?php

include '../controller/eventC.php';
include '../model/event.php';
$error = "";

// create event
$event = null;
// create an instance of the controller
$eventC = new eventC();


if (
    
    isset($_POST["obj"]) &&
    isset($_POST["place"]) &&
    isset($_POST["dh"]) &&
    isset($_POST["bud"]) &&
    isset($_POST["be"]) &&
    isset($_POST["nbrp"]) &&
    isset($_POST["type"]) 
) {
    if (
        
        !empty($_POST["obj"]) &&
        !empty($_POST["place"]) &&
        !empty($_POST["dh"]) &&
        !empty($_POST["bud"]) &&
        !empty($_POST["be"]) &&
        !empty($_POST["nbrp"]) &&
        !empty($_POST["type"])
    ) {
     
        $ide=$_POST['ide'];
        $dateTime = new DateTime($_POST['dh']);
        $event = new event(
            null,
            $_POST['obj'],
            $_POST['place'],
            $dateTime,
            $_POST['bud'],
            $_POST['be'],
            $_POST['nbrp'] ,
            $_POST['type']
        );
      var_dump($event);
        
        $eventC->update($event, $ide);

        header('Location:admin.php');
        exit() ;
    } else
        $error = "Missing information";
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="../assets/css2/main.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="../assets/yassine/css/update.css">

</head>

<body>


    <button><a href="listevent.php">Back to list</a></button>
    <hr>
    <?php
    if (isset($_GET['ide'])) {
        $event = $eventC->showevent($_GET['ide']);
    ?>
     <form method="POST" action="update.php" enctype="multipart/form-data">
     <input type="hidden" name="ide" value="<?php echo $_GET['ide']; ?>">
                        <div class="form-row m-b-55">
                            <div class="name">obj</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="obj" id="obj"  value="<?php echo $event['obj']; ?>">
                                            
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
                                    <input class="input--style-5" type="text" name="place" id="place"   value="<?php echo $event['place']; ?>"  >
                                </div>
                            </div>
                            <span id="s2"></span>
                        </div>
                      <div class="form-row">
                            <div class="name">date</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="date" name="dh" id="dh"  value="<?php echo $event['dh']; ?>">
                                </div>
                            </div>
                            <span id="s3"></span>
                        </div> 
                        
                        <div class="form-row">
                            <div class="name">budget</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="bud" id="bud"  value="<?php echo $event['bud'] ; ?>">
                                </div>
                            </div>
                            <span id="s4"></span>
                        </div>
                        <div class="form-row">
                            <div class="name">be</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="be" id="be"  value="<?php echo $event['be'] ; ?>">
                                </div>
                            </div>
                            <span id="s5"></span>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">Number of participation</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="nbrp" id="nbrp" value="<?php echo $event['nbrp'] ; ?>">
                                </div>
                            </div>
                            
                            <span id="s6"></span>
                        </div>
                 
                        <div class="form-row">
                            <div class="name">type</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="type" id="type" value="<?php echo $event['type']; ?>">
                                </div>
                            </div>
                            
                            <span id="s6"></span>
                        </div>
                        
                        <div>
                        <input type="submit" value="Save">
                        <br>
                        <br>
                        <input type="reset" value="Reset">
                          <!-- <button class="btn btn--radius-2 btn--red"  type="submit" value="save"   onclick="validerEtSoumettre(event)">Register</button> -->

                       <!-- <input type="submit" value="Save" onclick="validerEtSoumettre(event)> -->
 </div>
                    </form>
    <?php
    }
    ?>
</body>

</html>