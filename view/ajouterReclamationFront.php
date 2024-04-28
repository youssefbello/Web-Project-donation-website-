<?php
    include_once '../controller/reclamationC.php';
    include_once '../model/reclamation.php';

    session_start();
    
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
            if (!isset($_SESSION["role"])) {
                die("FORBIDDEN");
            }
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

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Charifit</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/front/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/front/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/front/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/front/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/front/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/front/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/front/css/nice-select.css">
    <link rel="stylesheet" href="../assets/front/css/flaticon.css">
    <link rel="stylesheet" href="../assets/front/css/gijgo.css">
    <link rel="stylesheet" href="../assets/front/css/animate.css">
    <link rel="stylesheet" href="../assets/front/css/slicknav.css">
    <link rel="stylesheet" href="../assets/front/css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->


    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div class="header-top_area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-md-12 col-lg-8">
                            <div class="short_contact_list">
                                <ul>
                                    <li><a href="#"> <i class="fa fa-phone"></i> +1 (454) 556-5656</a></li>
                                    <li><a href="#"> <i class="fa fa-envelope"></i>contact@sadaka.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-lg-4">
                            <div class="social_media_links d-none d-lg-block">
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-pinterest-p"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-3">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="../assets/img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9">
                            <div class="main-menu">
                                <nav>
                                <ul id="navigation">
                                        <li><a href="index.php">home</a></li>
                                        <li><a id="about_link" href="index.php#our_volunteer_area">About</a></li>
                                        <li><a href="blog.php">blog</a></li>
                                        </li>
                                        <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="enchereF.php">Enchere</a></li>
                                                <li><a href="donsF.php">Dons</a></li>
                                                <li><a href="eventa.php">Event</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="ajouterReclamationFront.php">Reclamation</a></li>
                                    </ul>
                                </nav>
                                <div class="Appointment">
                                    <div class="book_btn d-none d-lg-block">
                                        <?php 
                                            if (!isset($_SESSION["username"])) {
                                                echo '<a href="login.php">Login/Register</a>';
                                            } else {
                                                if ($_SESSION["role"] === "admin") {
                                                echo '<div class="dropdown">
                                                        <a href="admin.php"><img src="../assets/img/profile/logo.png" alt="User Profile Image" class="profile-image">'.$_SESSION["username"].'</a>
                                                        <a href="logout.php">Log Out</a>
                                                    ';
                                                } else {
                                                    echo '<div class="dropdown">
                                                    <a href="profile.php">
                                                    <img src="../assets/img/profile/logo.png" alt="User Profile Image" class="profile-image">'.$_SESSION["username"].'</a>
                                                    <a href="logout.php">Log Out</a>
                                                ';
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- bradcam_area_start  -->
    <div class="bradcam_area breadcam_bg overlay d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Contact</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Get in Touch</h2>
                    </div>
                    <div class="col-lg-8">
                        <form method="POST" onsubmit="return verif();">
                            <div class="mb-5">
                                <div class="row">
                                    <div class="card-body" style="margin-left:50px;">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control valid" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom'" name="nom" id="nom" placeholder="Nom">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control valid" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" name="email" id="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control valid" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone'" name="phone" id="phone" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control valid" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Sujet'" name="sujet" id="sujet" placeholder="Sujet">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <textarea type="text" class="form-control w-100" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'" name="description" id="description" placeholder="Description"></textarea>
                                            </div>
                                        <br>
                                        </div>
                                        <div class="text-center">
                                            <input class="button button-contactForm boxed-btn" type="submit" name="envoyer" value="Envoyer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>Buttonwood, California.</h3>
                                <p>Rosemead, CA 91770</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>+1 253 565 2365</h3>
                                <p>Mon to Fri 9am to 6pm</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>support@colorlib.com</h3>
                                <p>Send us your query anytime!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- ================ contact section end ================= -->
    

    <!-- footer_start  -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-lg-4 ">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="img/footer_logo.png" alt="">
                                </a>
                            </div>
                            <p class="address_text">Lorem ipsum dolor sit amet, <br> consectetur adipiscing elit, sed do <br> eiusmod tempor incididunt ut labore.
                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-dribbble"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Services
                            </h3>
                            <ul class="links">
                                <li><a href="#">Donate</a></li>
                                <li><a href="#">Sponsor</a></li>
                                <li><a href="#">Fundraise</a></li>
                                <li><a href="#">Volunteer</a></li>
                                <li><a href="#">Partner</a></li>
                                <li><a href="#">Jobs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Contacts
                            </h3>
                            <div class="contacts">
                                <p>+2(305) 587-3407 <br>
                                    info@loveuscharity.com <br>
                                    Flat 20, Reynolds Neck, North
                                    Helenaville, FV77 8WS
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Top News
                            </h3>
                            <ul class="news_links">
                                <li>
                                    <div class="thumb">
                                        <a href="#">
                                            <img src="img/news/news_1.png" alt="">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="#">
                                            <h4>School for African 
                                                Childrens</h4>
                                        </a>
                                        <span>Jun 12, 2019</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb">
                                        <a href="#">
                                            <img src="img/news/news_2.png" alt="">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="#">
                                            <h4>School for African 
                                                Childrens</h4>
                                        </a>
                                        <span>Jun 12, 2019</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="row">
                    <div class="bordered_1px "></div>
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer_end  -->
    
        <!-- JS here -->
        <script src="../assets/front/js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="../assets/front/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="../assets/front/js/popper.min.js"></script>
        <script src="../assets/front/js/bootstrap.min.js"></script>
        <script src="../assets/front/js/owl.carousel.min.js"></script>
        <script src="../assets/front/js/isotope.pkgd.min.js"></script>
        <script src="../assets/front/js/ajax-form.js"></script>
        <script src="../assets/front/js/waypoints.min.js"></script>
        <script src="../assets/front/js/jquery.counterup.min.js"></script>
        <script src="../assets/front/js/imagesloaded.pkgd.min.js"></script>
        <script src="../assets/front/js/scrollIt.js"></script>
        <script src="../assets/front/js/jquery.scrollUp.min.js"></script>
        <script src="../assets/front/js/wow.min.js"></script>
        <script src="../assets/front/js/nice-select.min.js"></script>
        <script src="../assets/front/js/jquery.slicknav.min.js"></script>
        <script src="../assets/front/js/jquery.magnific-popup.min.js"></script>
        <script src="../assets/front/js/plugins.js"></script>
        <script src="../assets/front/js/gijgo.min.js"></script>
    
        <!--contact js-->
        <script src="../assets/front/js/contact.js"></script>
        <script src="../assets/front/js/jquery.ajaxchimp.min.js"></script>
        <script src="../assets/front/js/jquery.form.js"></script>
        <script src="../assets/front/js/jquery.validate.min.js"></script>
        <script src="../assets/front/js/mail-script.js"></script>
        <script src="../assets/front/js/main.js"></script>

        <script src="../assets/js/ctrlReclamations.js"></script>
    </body>
    
    </html>