<?php
include '../model/enchere.php';
include '../controller/enchereC.php';

include '../model/offre.php';
include '../controller/offreC.php';
include "test.php";



session_start();


$encherC = new enchereC();
$enchereListe = $encherC->listenchere();
$offreC = new offreC();

?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sadaka</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->

    <link rel="icon" type="image/png" href="../assets/tmplate_form/favicon.png">

    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
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
    
    
    <!-- <link rel="stylesheet" href="../assets/css/responsive.css"> -->
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
                                    <li><a href="#"> <i class="fa fa-phone"></i> +216 58 358 649</a></li>
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

    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1 overlay2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="slider_text ">
                            <span>Commencez aujourd'hui.</span>
                            <h3> Aidez les enfants
                                quand ils en ont besoin</h3>
                            <p>Avec tant de choses à consommer et si peu de temps, trouver des idées de titre
                                pertinentes est essentiel.</p>
                            <a href="About.php" class="boxed-btn3">En savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="popular_causes_area section_padding">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb-55">
                        <h3><span>Enchères Populaires</span></h3>
                    </div>
                </div>
            </div>
            <div class="search-bar creative-search">
                <form action="../view/index.php" method="get">
                    <input type="text" name="q" placeholder="Rechercher...">
                    <button type="input" class="search-button">Rechercher</button>
                    <style>
                        .search-bar {
                            text-align: right;
                        }

                        .search-bar form {
                            /*display: flex;*/
                            align-items: center;
                        }

                        .search-bar input[type="text"] {
                            padding: 8px;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                        }

                        .search-bar button {
                            background-color: #4CAF50;
                            color: white;
                            border: none;
                            padding: 8px 12px;
                            border-radius: 4px;
                            cursor: pointer;
                        }

                        /* Ajoutez du style supplémentaire pour un design créatif si nécessaire */
                    </style>
                </form>
            </div>
            <div class="row">
                <?php
                $searchTerm = isset($_GET['q']) ? $_GET['q'] : '';
                $enchereListe =  $encherC->listenchere($searchTerm);
                foreach ($enchereListe as $enchere) {
                    $dateDebut = new DateTime($enchere['date_fin']);
                    $dateFin = new DateTime();
                    $duree = $dateFin->diff($dateDebut);
                    $offres=$offreC->listoffrebyid($enchere['id_enchere']);
                    $max = $enchere['prix_min'];
                    foreach ($offres as $offre) {
                         // Valeur par défaut si aucune offre n'est présente
                    
                        if ($offres != null) {
                            // Assurez-vous que la méthode getMaxMise retourne toujours un nombre
                            $maxMise = $offreC->getMaxMise($enchere['id_enchere']);
                    
                            if ($maxMise !== false) {
                                $max = $maxMise;
                            }
                        } else {
                            // Si aucune offre n'est présente, utilisez la valeur de 'offre_min'
                            $max = $enchere['prix_min'];
                        }
                        
                    }
                    $encherC->updatePrix($enchere['id_enchere'], $max);
                    
                ?>
                
                    <div class="col-lg-4">
                        <div class="single_cause">
                            <div class="thumb">
                                <img src="../assets/image_bd/<?= htmlspecialchars($enchere['image_objet']) ?>" alt="<?= htmlspecialchars($enchere['nom_objet']) ?>">

                            </div>
                            <div class="causes_content">
                                <h4><?= htmlspecialchars($enchere['nom_objet']) ?></h4>
                                <p><?= htmlspecialchars($enchere['descr']) ?></p>
                                <div class="auction_info">
                                    <div class="time_left">
                                        <i class="ti-timer"></i> Il reste <?= $duree->format('%d jours, %h heures et %i minutes') ?>
                                    </div>
                                    <div class="current_bid">
                                        Offre actuelle : <?= htmlspecialchars($max) ?> $
                                    </div>
                                </div>
                                <a class="read_more" href="cause_details.php?id_enchere=<?= urlencode($enchere['id_enchere']) ?>">Faire une offre</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
            <?php
                if (isset($_SESSION["role"])) {
                    if ($_SESSION["role"] == "VIP" || $_SESSION["role"] == "admin") {
                        echo '<button id="creer" class="mx-auto" onclick="window.location.href=\'../view/ajout_enchere.php\' " type="button">Créer l enchère</button>';
                    }
                }
            ?>
        </div>


    <div class="counter_area">
        <div class="container">
            <div class="counter_bg overlay">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-calendar"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">120</h3>
                                <p>Événements </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-heart-beat"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">120</h3>
                                <p>Événements </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-in-love"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">120</h3>
                                <p>Événements </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-hug"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">120</h3>
                                <p>Événements </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="../assets/img/footer_logo.png" alt="">
                                </a>
                            </div>
                            <p class="address_text">Lorem ipsum dolor sit amet, <br> consectetur adipiscing elit, sed do
                                <br> eiusmod tempor incididunt ut labore.
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
                                            <img src="../assets/img/news/news_1.png" alt="">
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
                                            <img src="../assets/img/news/news_2.png" alt="">
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


    </footer>
    <!-- footer_end  -->

    <!-- link that opens popup -->

    <!-- JS here -->
    <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/isotope.pkgd.min.js"></script>
    <script src="../assets/js/ajax-form.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="../assets/js/scrollIt.js"></script>
    <script src="../assets/js/jquery.scrollUp.min.js"></script>
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/nice-select.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/gijgo.min.js"></script>
    <!--contact js-->
    <script src="../assets/js/contact.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="../assets/js/jquery.form.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>