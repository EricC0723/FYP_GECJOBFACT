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
              <li><a href="about.php">About</a></li>
              <li>
                <a href="job-listings.php">Job Listings</a>
              </li>
              <li class="has-children">
                <a href="services.html">Pages</a>
                <ul class="dropdown">
                  <li><a href="services.html">Services</a></li>
                  <li><a href="service-single.html">Service Single</a></li>
                  <li><a href="blog-single.html">Blog Single</a></li>
                  <li><a href="portfolio.html">Portfolio</a></li>
                  <li><a href="portfolio-single.html">Portfolio Single</a></li>
                  <li><a href="testimonials.html">Testimonials</a></li>
                  <li><a href="faq.html">Frequently Ask Questions</a></li>
                  <li><a href="gallery.html">Gallery</a></li>
                </ul>
              </li>
              <li><a href="blog.html">Blog</a></li>
              <li><a href="contact.php">Contact</a></li>
              <li class="d-lg-none"><a href="login.php">Log In</a></li>
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
            <h1 class="text-white font-weight-bold">Terms Of Use</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Terms Of Use</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section block__18514" id="next-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <span class="text-primary d-block mb-5"><span class="icon-magnet display-1"></span></span>
            <h2 class="mb-4">Terms Of Use</h2>
            <p style="font-size:20px;">By accessing this web site, you are agreeing to be bound by these web site Terms and Conditions of Use, all applicable laws, and regulations, and agree that you are responsible for compliance with any applicable local laws.     If you do not agree with any of these terms, you are prohibited from using or accessing this site.     The materials contained in this web site are protected by applicable copyright and trademark law.     Users are bound by Google's Terms of Service.</p>
            <h2 class="mb-4" style="margin-top:30px;">Use License</h2>
            <p style="font-size:20px;">Permission is granted to temporarily download one copy of the materials (information or software) on Job Majestic's web site for personal, non-commercial transitory viewing only.  This is the grant of a license, not a transfer of title, and under this license you may not:</p>
            <p style="font-size:20px;">Modify or copy the materials;
Use the materials for any commercial purpose, or for any public display (commercial or non-commercial);
Remove any copyright or other proprietary notations from the materials;  or
Transfer the materials to another person or "mirror" the materials on any other server.
This license shall automatically terminate if you violate any of these restrictions and may be terminated by Job Majestic at any time.  Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.</p>
            <h2 class="mb-4" style="margin-top:30px;">Disclaimer</h2>
            <p style="font-size:20px;">Permission is granted to temporarily download one copy of the materials (information or software) on Job Majestic's website for personal, non-commercial transitory viewing only.  This is the grant of a license, not a transfer of title, and under this license you may not:
</p>
            <h2 class="mb-4" style="margin-top:30px;">Limitations</h2>
                <p style="font-size:20px;">By accessing this web site, you are agreeing to be bound by these web site Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws.  If you do not agree with any of these terms, you are prohibited from using or accessing this site.  The materials contained in this website are protected by applicable copyright and trade mark law.  Users are bound by Google's Terms of Service.
            </p>
            <h2 class="mb-4" style="margin-top:30px;">Revisions and Errata</h2><p style="font-size:20px;">The materials appearing on Job Majestic's web site could include technical, typographical, or photographic errors.  Job Majestic's does not warrant that any of the materials on its website are accurate, complete, or current.  Job Majestic's may make changes to the materials contained on its web site at any time without notice.  Job Majestic's does not, however, make any commitment to update the materials.
            </p>
            <h2 class="mb-4" style="margin-top:30px;">Links</h2><p style="font-size:20px;">Job Majestic has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site.  The inclusion of any link does not imply endorsement by Job Majestic's of the site.  Use of any such linked web site is at the user's own risk.
            </p>
            <h2 class="mb-4" style="margin-top:30px;">Site Terms of Use Modifications</h2><p style="font-size:20px;">Job Majestic has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site.  The inclusion of any link does not imply endorsement by Job Majestic's of the site.  Use of any such linked web site is at the user's own risk.
            </p>
            <h2 class="mb-4" style="margin-top:30px;">Governing Law</h2><p style="font-size:20px;">You are responsible to ensure that you comply to your country's law, regulation and legislation on employment.  This includes your responsibility to ensure that you are of legal employment age in your respective country to apply for a job.  Any claim relating to Job Majestic's web site shall be governed by the laws of Malaysia and the users hereby submit to the jurisdiction of the Malaysia courts.  General Terms and Conditions applicable to Use of a Web Site.
            </p>
          </div>
        </div>
      </div>
    </section>

    <footer class="site-footer" style="margin-top:200px;">

      <a href="#top" class="smoothscroll scroll-top">
        <span class="icon-keyboard_arrow_up"></span>
      </a>

      <div class="container">
        <div class="row mb-5">
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Search Trending</h3>
            <ul class="list-unstyled">
              <li><a href="#">Web Design</a></li>
              <li><a href="#">Graphic Design</a></li>
              <li><a href="#">Web Developers</a></li>
              <li><a href="#">Python</a></li>
              <li><a href="#">HTML5</a></li>
              <li><a href="#">CSS3</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Company</h3>
            <ul class="list-unstyled">
              <li><a href="about.php">About Us</a></li> 
              <li><a href="term_of_use.php">Term of use</a></li>
              <li><a href="privacy.php">Privacy policy</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Resources</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Support</h3>
            <ul class="list-unstyled">
              <li><a href="#">Support</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Contact Us</h3>
            <div class="footer-social">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-instagram"></span></a>
              <a href="#"><span class="icon-linkedin"></span></a>
            </div>
          </div>
        </div>

        <div class="row text-center">
          <div class="col-12">
            <p class="copyright"><small>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
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