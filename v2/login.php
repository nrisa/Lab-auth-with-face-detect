
<?php 
session_start();
include 'config/db.php';
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Brazzer | Home</title>
    <!-- Bootstrap CSS -->    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Main Style -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- Normalize Style -->
    <link rel="stylesheet" href="assets/css/normalize.css">
    <!-- Fonts Awesome -->
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <!-- Color Switcher -->
    <link rel="stylesheet" href="assets/css/color-switcher.css" type="text/css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="assets/extras/animate.css" type="text/css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="assets/extras/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/extras/owl.theme.css" type="text/css">
    <!-- Rev Slider Css -->
    <link rel="stylesheet" href="assets/extras/settings.css" type="text/css">
    <!-- Nivo Lightbox Css -->
    <link rel="stylesheet" href="assets/extras/nivo-lightbox.css" type="text/css">
    <!-- Slicknav Css -->
    <link rel="stylesheet" href="assets/css/slicknav.css" type="text/css">
    <!-- Responsive Style -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="assets/css/colors/sky.css" media="screen" />
    <link href="vendor/sweetalert/sweetalert.css" rel="stylesheet" />

  </head>
  <body>
   
    <!-- Header area wrapper Starts -->
    <header id="header-wrap">
      <!-- Roof area Starts -->
      <div id="roof" class="hidden-xs">
          <div class="container">
              <!-- Wellcome Starts -->
              <div class="pull-left">
                <i class="fa fa-home" aria-hidden="true"></i> SMKN 1 AMPEK ANGKEK
              </div>
              <!-- Wellcome End -->

              <!-- Quick Contacts Starts -->
              <div class="quick-contacts pull-right">
                  <span><i class="fa fa-phone"></i> (0752) 7834358</span>
                  <span><i class="fa fa-envelope"></i><a href="#">hello@brightuniversity.edu</a></span>
                  <span><a href="?pages=login"><i class="fa fa-user"></i> Login</a> / <a href="?pages=registration">Register</a></span>
              </div>
              <!-- Quick Contacts End -->
          </div>
      </div>
      <!-- Roof area End -->

      <!-- Navbar Start -->
      <nav class="navbar navbar-default main-navigation" role="navigation" data-spy="affix" data-offset-top="50">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"><img src="assets/img/logo.png" alt=""></a>
            </div>
            <!-- Brand End -->

            <!-- Search Icon -->
            <div class="header-search pull-right">
                <a class="open-search">
                    <i class="fa fa-search"></i>
                </a>
            </div>  
            <!-- Collapse Navbar -->
            <div class="collapse navbar-collapse" id="navbar">
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropdown-toggle">
                  <a href="index.php"><i class="fa fa-home"></i> Home </a>
                                       
                </li>
      
    
                <li class="dropdown dropdown-toggle">
                  <a href="#" data-toggle="dropdown">Events <i class="fa fa-angle-down"></i></a>
                  <ul class="dropdown-menu">
                    <li><a href="event-grid.html">Events Grid</a></li>                     
                    <li><a href="event.html">Single Event</a></li>
                  </ul>                        
                </li> 
                         
                <li><a href="contact.html">Contact</a></li>
              </ul>
            </div>  
             <!-- Form for navbar search area -->
            <form class="full-search">
              <div class="container">
                <div class="row">
                  <input class="form-control" type="text" placeholder="Search">
                  <a class="close-search">
                  <span class="fa fa-times">
                  </span>
                  </a>
                </div>
              </div>
            </form>
            <!-- Search form ends -->   

            <!-- Mobile Menu Start -->
            <ul class="wpb-mobile-menu">
              <li>
                <a href="index.php">Home</a>
                <ul>
                  <li><a href="index.php">Home Page 1</a></li>    
                  <li><a href="index-1.html">Home Page 2</a></li>     
                </ul>                        
              </li>
              
              <li>
                <a href="#">Events</a>
                <ul>
                  <li><a href="event-grid.html">Events Grid</a></li>                     
                  <li><a href="event.html">Single Event</a></li>
                </ul>                        
              </li> 
                           
              <li><a href="contact.html">Contact</a></li>
            </ul>
            <!-- Mobile Menu End -->

          </div>
      </nav>
      <!-- Navbar End -->

    </header>
    <!-- Header area wrapper End -->

    <!-- Page Header Start -->
<?php 
$pages = @$_GET['pages'];
if ($pages=='registration') {
$breadcrumb="registration";                       
}elseif ($pages=='login') {
$breadcrumb="Login";                       
}


elseif ($pages=='') {
$breadcrumb="Selamat Datang";   
}
?>
    <div class="page-header" style="background: url(assets/img/banner1.jpg);height: 270px;">
      <div class="container">
        <div class="row">         
          <div class="col-md-12">
            <div class="breadcrumb-wrapper">
              <h2 class="page-title"><?php echo $breadcrumb; ?></h2>
              <a href="index.php">Home</a>
              <span>/</span>
             
                <span class="current"><?php echo $breadcrumb; ?></span>
             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page Header End --> 

    <!-- Start Content Section -->
    <section id="content" class="error-bg">
        <?php
        error_reporting();

        $pages= @$_GET['pages'];
        if ($pages=='login') {
          include 'Home/Login.php';
        }elseif ($pages=='registration') {
          include 'Home/Registrasion.php';
        }elseif ($pages=='proses') {
          include 'Home/Proses.php';
        }elseif ($pages==null) {
         include 'Home/Home.php';
        }else{
          echo "<b>404!</b> Tidak ada ..";
        }
        
     
        ?>
    </section>
    <!-- End Content Section  -->

    <!-- Start Call to Action Section -->
<!--     <div class="cta">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-8">
            <h3>Learning Management System</h3>
          </div>
          <div class="col-md-4 col-sm-4">
            <a href="#" class="btn btn-border">Buat Akun</a>
          </div>
        </div>
      </div>
    </div> -->
    <!-- End Call to Action Section -->

    <!-- Footer Section -->
    <footer>
      <!-- Container Starts -->
      
      <!-- Copyright -->
      <div id="copyright">
        <div class="container">
          <div class="row">
            <div class="col-md-6  col-sm-6">
              <p class="copyright-text">
                © <a rel="nofollow" href=""><b>e-Guru</b> </a> 2019 - SMKN 1 Ampek Angkek
              </p>
            </div>
            <div class="col-md-6  col-sm-6">                
              <div class="bottom-social-icons pull-right">  
                <a class="facebook" target="_blank" href="https://web.facebook.com/GrayGrids"><i class="fa fa-facebook"></i></a> 
                <a class="twitter" target="_blank" href="https://twitter.com/GrayGrids"><i class="fa fa-twitter"></i></a>
                <a class="google-plus" target="_blank" href="https://plus.google.com"><i class="fa fa-google-plus"></i></a>
                <a class="linkedin" target="_blank" href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>
              </div>            
            </div>
          </div>
        </div>
      </div>
      <!-- Copyright  End-->
      
    </footer>
    <!-- Footer Section End-->

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
      <i class="fa fa-arrow-up"></i>
    </a>

 

    <!-- jQuery  -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
       <script src="vendor/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="assets/js/color-switcher.js"></script>
    <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
    <script type="text/javascript" src="assets/js/nivo-lightbox.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.countdown.js"></script>  
    <script type="text/javascript" src="assets/js/jquery.counterup.min.js"></script>   
    <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script> 
    <script type="text/javascript" src="assets/js/form-validator.min.js"></script>
    <script type="text/javascript" src="assets/js/contact-form-script.js"></script>  
    
    <script type="text/javascript" src="assets/js/jquery.slicknav.js"></script>
    <script src="assets/js/main.js"></script>

  </body>
</html>