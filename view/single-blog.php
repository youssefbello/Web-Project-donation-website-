<?php
include_once('traitement.php');
$CommentaireC = new CommentaireC();
$publicationC= new publicationC();
$commentaire = $CommentaireC->affichecom($id);
$commentaireliste= $CommentaireC->affichecom($id);
$publicationliste = $publicationC->listepub();
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SADAKA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/style.css">
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
                                    <li><a href="#"> <i class="fa fa-phone"></i> +1 (454) 556-5656</a></li>
                                    <li><a href="#"> <i class="fa fa-envelope"></i>Yourmail@gmail.com</a></li>
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
                                <a href="index.html">
                                    <img src="../assets/img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9">
                            <div class="main-menu">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.html">home</a></li>
                                        <li><a href="About.html">About</a></li>
                                        <li><a href="blog.php">blog</a></li>
                                        </li>
                                        <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="elements.html">elements</a></li>
                                                <li><a href="Cause.html">Cause</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact</a></li>
                                    </ul>
                                </nav>
                                <div class="Appointment">
                                    <div class="book_btn d-none d-lg-block">
                                        <a data-scroll-nav='1' href="#">Make a Donate</a>
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
                        <h3>Blog</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->



   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                      <img class="img-fluid" src="../assets/img/blog/<?php echo $publication['img']; ?>" alt="">     
                  </div>
                  <div class="blog_details">
                     <h2><?php echo $publication['titre']; ?></h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="fa fa-user"></i> <?php echo $publication['auteur']; ?></a></li>
                        <li><a href="#"><i class="fa fa-comments"></i><?php echo count($commentaireliste); ?> Comments</a></li>
                     </ul>
                     <p class="excert">
                         <?php echo $publication['detail']; ?>
                     </p>
                  </div>
               </div>
               <div class="comments-area">
                  <h4><?php echo count($commentaireliste); ?> Comments</h4>
                  <?php
                    // Assuming $articles is an array containing article data retrieved from your database
                             foreach ($commentaireliste as $commentaire) {
                        // Use the showpublication function to get detailed information about the publication
                    ?>
                  <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="../assets/img/comment/comment_1.png" alt="">
                           </div>
                           <div class="desc">
                              <p class="comment">
                                  <?php echo $commentaire['contenu_com']; ?>
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <?php echo $commentaire['nom_auteur']; ?>
                                    </h5>
                                    <p class="date"> <?php echo $commentaire['date_creation']; ?>  </p>
                                 </div>
                                 <div class="reply-btn">
                                    <a href="deletecom2.php?id=<?php echo $commentaire['id_com']; ?>" class="btn-reply text-uppercase">Suprimmer</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                      </div>
                     
                  </div>
                  <?php }?>
               </div>
               <div class="comment-form">
                  <h4>Leave a Reply</h4>
                  <form class="form-contact comment_form" action="../view/single-blog.php?id=<?= $id ?>" method="POST" id="form" onsubmit="return validateForm()" >          
                  <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                                <textarea class="form-control w-100" name="contenu_com" id="contenu_com" cols="30" rows="9"
                                 placeholder="Write Comment" required></textarea>
                                <span id="erreurcontenu_com" style="color: red"></span>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input class="form-control" name="nom_auteur" id="nom_auteur" type="text" placeholder="Name" required>
                              <span id="erreurnom_auteur" style="color: red"></span>
                           </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" name="add-comment" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
                    </div>
                  </form>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
                  <aside class="single_sidebar_widget search_widget">
                    <form action='recherche.php'  method="GET">
                        <div class="form-group">
                           <div class="input-group mb-3">
                              <input type="text" id="search" name="search" class="form-control" placeholder='Search Keyword'
                                    onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Search Keyword'">
                              <div class="input-group-append">
                                 <button class="btn" type="button"><i class="ti-search"></i></button>
                              </div>
                           </div>
                        </div>
                        <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                           type="submit"  name="submit">Search</button>
                    </form>
                  </aside>
                  <aside class="single_sidebar_widget popular_post_widget">
                     <h3 class="widget_title">Recent Post</h3>
                     <?php
                         // Assuming $articles is an array containing article data retrieved from your database
                          foreach ($publicationliste as $publication) {
                         // Use the showpublication function to get detailed information about the publication
                        ?>
                     <div class="media post_item">
                        <div class="media-body">
                           <a href="single-blog.php?id=<?php echo $publication['id']; ?>">
                              <h4><?php echo $publication['titre']; ?></h4>
                           </a>
                           <p><?php echo $publication['date_pub']; ?></p>
                        </div>
                     </div>
                     <?php }?>
                  </aside>
                  <aside class="single_sidebar_widget newsletter_widget">
                     <h4 class="widget_title">Newsletter</h4>
                     <form action="#">
                        <div class="form-group">
                           <input type="email" class="form-control" onfocus="this.placeholder = ''"
                              onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                        </div>
                        <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                           type="submit">Subscribe</button>
                     </form>
                  </aside>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->
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
  <script src="js/vendor/modernizr-3.5.0.min.js"></script>
  <script src="js/vendor/jquery-1.12.4.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/ajax-form.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <script src="js/scrollIt.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/nice-select.min.js"></script>
  <script src="js/jquery.slicknav.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/gijgo.min.js"></script>
  <!--contact js-->
  <script src="js/contact.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/mail-script.js"></script>

  <script src="js/main.js"></script>
  <script>
      $('.datepicker').datepicker({
          iconsLibrary: 'fontawesome',
          icons: {
              rightIcon: '<span class="fa fa-calendar"></span>'
          }
      });

      $('.timepicker').timepicker({
          iconsLibrary: 'fontawesome',
          icons: {
              rightIcon: '<span class="fa fa-clock-o"></span>'
          }
      });
  </script>
</body>

</html>