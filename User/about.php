<?php
  session_start();
  include("C:/xampp/htdocs/FYP/dataconnection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <title>JobBoard &mdash; Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">

    <link rel="stylesheet" href="css/style.css">    
  </head>
  <body id="top">

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
    

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    

    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="index.php">GEC  JOBFACT</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php" class="nav-link">Home</a></li>
              <li><a href="about.php" class="active">About</a></li>
              <li>
                <a href="job-listings.php">Job Listings</a>
              </li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </nav>

          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
          
    <a href="../Company/company_login.php"><button type="button" class="btn btn-success" style="margin-left: 600px; color: white; margin-top: -5px; max-width: 150px; white-space: nowrap;">Employer site</button></a>
          <div class="ml-auto">
          <?php 
              if (isset($_SESSION['User_ID'])) {
                ?>
                <!-- <a href="login.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span><?php echo $_SESSION['First_Name'];?></a> -->
                <!-- <a href="#" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Eric Ching Khai Jie</a> -->
                <div class="user-info-dropdown">
                <div class="dropdown">
                  <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" style="color:white;border: 2px solid #787785;border-radius: 4px;padding: 5px;background-color:#787785;">
                    <span class="user-name"><?php echo $_SESSION['First_Name'];?></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                  <a class="dropdown-item" href="userProfile.php"><i class="dw dw-user1" style="margin-right: 10px;"></i> Profile</a>
                    <a class="dropdown-item" href="setting.php"><i class="dw dw-settings2" style="margin-right: 10px;"></i> Setting</a>
                    <a class="dropdown-item" href="user_savedjob.php"><i class="icon-copy fa fa-bookmark-o" style="margin-right: 10px;"></i>Saved job</a>
                    <a class="dropdown-item" href="user_applyjob.php"><i class="icon-copy fa fa-check-square-o" style="margin-right: 10px;"></i></i>Job applications</a>
                    <a class="dropdown-item" href="faq.html"><i class="dw dw-help" style="margin-right: 10px;"></i> Help</a>
                    <a class="dropdown-item" href="logout.php"style="color:red;"><i class="dw dw-logout" style="margin-right: 10px;"></i> Log Out</a>
                  </div>
                </div>
              </div>
                <?php
              } else {
                ?>
                <a href="login.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block" style="margin-left: 30px; color: white; margin-top: -5px; max-width: 150px; white-space: nowrap;"><span class="mr-2 icon-lock_outline" ></span>Log In</a>
                <?php
              }
              ?>
              <!-- <a href="login.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log In</a> -->
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">About Us</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>About Us</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5 bg-image overlay-primary fixed overlay" id="next-section" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2 text-white">JobBoard Site Stats</h2>
            <p class="lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita unde officiis recusandae sequi excepturi corrupti.</p>
          </div>
        </div>
        <div class="row pb-0 block__19738 section-counter">

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="1930">+</strong>
            </div>
            <span class="caption">Candidates</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="54">0</strong>
            </div>
            <span class="caption">Jobs Posted</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="120">0</strong>
            </div>
            <span class="caption">Jobs Filled</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="550">0</strong>
            </div>
            <span class="caption">Companies</span>
          </div>

            
        </div>
      </div>
    </section>

    
    <section class="site-section pb-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
              <img src="images/sq_img_6.jpg" alt="Image" class="img-fluid img-shadow">
          </div>
          <div class="col-lg-5 ml-auto">
            <h2 class="section-title mb-3">Career Site</h2>
            <p class="lead">Helping job seekers to build a successful and happy career.   We believe everyone deserves an opportunity to find a happy career.</p>
            <h2 class="section-title mb-3">Our Achievements</h2>
            <p class="lead">In 2023, the Company has focused on building its talent pool to cater for its further growth in 2024.   Currently, our platform has recruited more than 10,000 potential candidates to fulfil the job demands from our 30 business partners.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section pt-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0 order-md-2">
              <img src="images/sq_img_8.jpg" alt="Image" class="img-fluid img-shadow">
          </div>
          <div class="col-lg-5 mr-auto order-md-1  mb-5 mb-lg-0">
            <h2 class="section-title mb-3">For Job Seekers</h2>
            <p class="lead">Build their successful career by providing career guidance, expert advice, interviews, videos, and a job board with wide selection of job opportunities.</p>
            <h2 class="section-title mb-3">For Organisations</h2>
            <p class="lead">We help them to filter, engage and retain the talents by helping them to build an-depth company profiles or more.   GEC JobFact is a bridge between job seekers and employers.</p>
          </div>
        </div>
      </div>
    </section>
    <h2 class="section-title mb-2 text-black" style="text-align:center;text-decoration:underline;">About our team</h2>
    <section class="site-section pb-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
              <img src="images/gy.jpg" alt="Image" class="img-fluid img-shadow"style="width:400px;height:500px;margin-left:100px;">
          </div>
          <div class="col-lg-5 ml-auto">
            <h2 class="section-title mb-3">Looi Guang Yong</h2>
            <p class="text-muted">Team leader</p>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section pt-0" style="margin-top:50px;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0 order-md-2">
              <img src="images/eric.jpeg" alt="Image" class="img-fluid img-shadow"style="width:400px;height:500px;margin-right:100px;">
          </div>
          <div class="col-lg-5 mr-auto order-md-1  mb-5 mb-lg-0">
          <h2 class="section-title mb-3">Eric Ching Khai Jie</h2>
            <p class="text-muted">Team member</p>
          </div>
        </div>
      </div>
    </section>
    <section class="site-section pb-0" style="margin-top:-170px;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
              <img src="images/jielun.jpg" alt="Image" class="img-fluid img-shadow"style="width:400px;height:500px;margin-left:100px;">
          </div>
          <div class="col-lg-5 ml-auto">
          <h2 class="section-title mb-3">Chong Jie Lun</h2>
            <p class="text-muted">Team member</p>
          </div>
        </div>
      </div>
    </section>

    <footer class="site-footer">
      <a href="#top" class="smoothscroll scroll-top">
        <span class="icon-keyboard_arrow_up"></span>
      </a>

      <div class="container">
        <div class="row mb-5">
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Job seekers</h3>
            <ul class="list-unstyled">
              <li><a href="job-listings.php">Job listings</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>About JOBFACT</h3>
            <ul class="list-unstyled">
              <li><a href="about.php">About Us</a></li> 
              <li><a href="term_of_use.php">Term of use</a></li>
              
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Support</h3>
            <ul class="list-unstyled">
            <li><a href="contact.php">Contact us</a></li>
             <li><a href="privacy.php">Privacy policy</a></li>
             <li><a href="term_of_service.php">Term of Service</a></li>
            </ul>
          </div>
        </div>

        <div class="row text-center" style="margin-top:100px;">
          <div class="col-12">
            <p class="copyright"><small>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></small></p>
          </div>
        </div>
      </div>
    </footer>
  </div>

    <!-- SCRIPTS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/stickyfill.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/quill.min.js"></script>
    
    
    <script src="js/bootstrap-select.min.js"></script>
    
    <script src="js/custom.js"></script>
   
   
  </body>
</html>