<?php
include '../model/enchere.php';
include '../controller/enchereC.php';

$encherC = new enchereC();
session_start();
// Check if the ID of the auction has been submitted
if (isset($_GET['id_enchere'])) {
    $id_enchere = $_GET['id_enchere'];

    // Get auction information by its ID
    $enchere = $encherC->show_enchere($id_enchere);
} else {
    // Handle the case when ID is not provided
    // For example, you may redirect the user to an error page or show a message
    echo "Auction ID is missing.";
    exit();
}
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
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css1/bootstrap.min.css">
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
    <!-- header-end -->

    <!-- bradcam_area_start  -->
    <div class="bradcam_area breadcam_bg overlay d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Mises aux enchères solidaires</h3>
                        <h4 style="color: white;">Soutenir ceux dans le besoin</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->

    <!-- popular_causes_area_start  -->
    <form action="../view/ajout_offre.php" class="bid_form text-center" method="POST">
        <input type="hidden" name="id_enchere" value="<?= $enchere['id_enchere'] ?>">
        <div class="popular_causes_area pt-120 cause_details ">
            <?php
            /*foreach ($enchereListe as $enchere) {*/
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="single_cause">
                            <div class="thumb">
                                <img src="../assets/image_bd/<?= htmlspecialchars($enchere['image_objet']) ?>" alt="<?= htmlspecialchars($enchere['nom_objet']) ?>">
                            </div>
                            <div class="causes_content">

                                <div class="balance d-flex justify-content-between align-items-center" name="offre_actuelle">
                                    <span>Prix Actuel: <?= htmlspecialchars($enchere['prix_min']) ?>$ </span>
                                </div>
                                <h4 name="nom_objet"><?= htmlspecialchars($enchere['nom_objet']) ?></h4>
                                <p><?= htmlspecialchars($enchere['descr']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="make_bid_area section_padding">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section_title text-center mb-55">
                                <h3><span>Placez une enchère</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center  ">
                        <div class="col-lg-6">
                            <form action="../view/ajout_offre.php" class="bid_form text-center" method="POST">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="bid_button">
                                            <input type="hidden" name="id_enchere" value="<?= $enchere['id_enchere'] ?>">
                                            <style>
                                                .bid_button {
                                                    position: relative;
                                                    overflow: hidden;
                                                    text-align: center;
                                                }

                                                button {
                                                    border: none;
                                                    background: none;
                                                    padding: 10px 20px;
                                                    font-size: 16px;
                                                    cursor: pointer;
                                                    outline: none;
                                                    transition: transform 0.3s ease-in-out;
                                                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                                                    background-color: #2ecc71;
                                                    color: #fff;
                                                }

                                                button:hover {
                                                    transform: scale(1.1);
                                                }

                                                .bid_button div {
                                                    position: absolute;
                                                    top: 0;
                                                    left: 0;
                                                    width: 100%;
                                                    height: 100%;
                                                    background: #27ae60;
                                                    opacity: 0;
                                                    transition: opacity 0.3s;
                                                }

                                                .bid_button:hover div {
                                                    opacity: 1;
                                                }
                                            </style>
                                            <button type="submit">Enchérir</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            //} 
            ?>
        </div>
    </form>
    <!-- footer_start  -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-lg-4 ">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="../assets/img/footer_logo.png" alt="">
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
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="row">
                    <div class="bordered_1px "></div>
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </p>
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