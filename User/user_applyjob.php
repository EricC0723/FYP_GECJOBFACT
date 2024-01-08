<?php
  session_start();
  include("C:/xampp/htdocs/FYP/dataconnection.php");
  require 'script.php';
  require 'validation/veridationProfile.php';
  require 'validation/veridationSummary.php';
  require 'validation/veridationCareer.php';
  require 'validation/veridationEditCareer.php';
  require 'validation/veridationEducation.php';
  require 'validation/veridationEditEducation.php';
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
    <link rel="stylesheet" href="css/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" href="css/style.css">   
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css"> 
    <style>
        p{
    font-size: 1.2em;
  } 
.modal.fade .modal-bottom,
.modal.fade .modal-left,
.modal.fade .modal-right,
.modal.fade .modal-top {
    position: fixed;
    z-index: 1050;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: 0;
    max-width: 100%
}
.modal.fade .modal-right {
    left: auto!important;
    transform: translate3d(100%, 0, 0);
    transition: transform .3s cubic-bezier(.25, .8, .25, 1)
}

.modal.fade.show .modal-bottom,
.modal.fade.show .modal-left,
.modal.fade.show .modal-right,
.modal.fade.show .modal-top {
    transform: translate3d(0, 0, 0)
}
.w-xl {
    width: 650px
}

.modal-content,
.modal-footer,
.modal-header {
    border: none
}

.h-100 {
    height: 100%!important
}

.list-group.no-radius .list-group-item {
    border-radius: 0!important
}

.btn-light {
    color: #212529;
    background-color: #f5f5f6;
    border-color: #f5f5f6
}

.btn-light:hover {
    color: #212529;
    background-color: #e1e1e4;
    border-color: #dadade
}
.modal-header {
    text-align: left; /* 设置标题左对齐 */
    justify-content: flex-start;
}

.modal-body {
    text-align: left; /* 设置内容左对齐 */
    max-height: calc(100vh - 120px); /* 设置最大高度为视口高度减去标题和底部的高度 */
    overflow-y: auto;
}
.modal-body h3 {
    margin-top: 20px; /* 适当调整标题的上边距 */
    margin-bottom: 30px; /* 适当调整标题的下边距 */
}
.modal-footer {
    display: flex;
    align-items: left;
    justify-content: flex-end;
    padding: 1rem;
    border-top: 1px solid rgba(160, 175, 185, .15);
    border-bottom-right-radius: .3rem;
    border-bottom-left-radius: .3rem
}
  .fa-edit {
    margin-left: 10px;
    transition: font-size 0.3s ease; /* 添加颜色过渡效果 */
  }

  .fa-edit:hover {
    font-size:1.2em;
  }
    </style>
  </head>
  <body id="top">

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
          <div class="site-logo col-6"><a href="index.php">DEC JobFact</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php" class="nav-link">Home</a></li>
              <li><a href="about.html">About</a></li>
              <li class="has-children">
                <a href="job-listings.php">Job Listings</a>
                <ul class="dropdown">
                  <li><a href="job-single.php">Job Single</a></li>
                  <li><a href="post-job.html">Post a Job</a></li>
                </ul>
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
              <li><a href="contact.html">Contact</a></li>
            </ul>
          </nav>
          
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
          <div class="ml-auto">
          <?php 
              if (isset($_SESSION['User_ID'])) {
                ?>
                <!-- <a href="login.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span><?php echo $_SESSION['First_Name'];?></a> -->
                <!-- <a href="#" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Eric Ching Khai Jie</a> -->
                <div class="user-info-dropdown">
                <div class="dropdown">
                  <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" style="color:white;border: 2px solid #787785;border-radius: 4px;padding: 5px;background-color:#787785;">
                    <span class="user-name" style="color:white;"><?php echo $_SESSION['First_Name'];?></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="userProfile.php"><i class="dw dw-user1" style="margin-right: 10px;"></i> Profile</a>
                    <a class="dropdown-item" href="profile.html"><i class="dw dw-settings2" style="margin-right: 10px;"></i> Setting</a>
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
                <a href="login.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log In</a>
                <?php
              }
              ?>
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
            <h1 class="text-white font-weight-bold">Activity</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">
      <?php 
      $user_id = $_SESSION['User_ID'];
      $query = "SELECT * FROM applications WHERE UserID = $user_id";
      $result = mysqli_query($connect,$query);
    ?>
    <?php
    if(mysqli_num_rows($result)>0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $job_post_id = $row["JobID"];
            $job_query = "SELECT job_post.*, companies.* FROM job_post
            INNER JOIN companies ON job_post.CompanyID = companies.CompanyID WHERE Job_Post_ID = $job_post_id";
            $job_result = mysqli_query($connect,$job_query);
            $job_row = mysqli_fetch_assoc($job_result);
       ?>
        <div class="row">
        <!-- Profile -->
        <div class="col-lg-10 mb-4" id="savejob-section">
              <!-- <div class="block__87154 bg-primary"> -->
              <div class="block__87154 bg-white">
                <blockquote>
                  <div class="block__91147 d-flex align-items-center" style="margin-bottom:20px;">
                  <i class="icon-copy fa fa-trash-o" class="deleteCareerBtn" data-toggle="tooltip" title="Delete" aria-hidden="true" style="position:absolute;margin-left:800px;margin-top:-21px;font-size:26px;cursor: -webkit-grab; cursor: grab;" onclick="save_job('delete_job',<?php echo $job_post_id; ?>)"></i>
                  <div>
                    <a href="job-single.php?view&jobid=<?php echo $job_post_id;?>"><h4 class="text-black" style="text-decoration:underline;"><?php echo $job_row['Job_Post_Title'];?></h4></a>
                  </div>
                </div>
                <p><?php echo $job_row['CompanyName'];?></p>
                <p><?php echo $job_row['Main_Category_Name'];?>(<?php echo $job_row['Sub_Category_Name'];?>)</p>
                <p>Job posted at <?php echo date('d-m-Y', strtotime($job_row['AdStartDate']));?></p>
                <p><span class="text-black"><span class="icon-room" style="margin-right:10px;"></span></span><?php echo $job_row['Job_Post_Location'];?></p>
                
                <p style="margin-top:40px;margin-bottom:-2px;color:green;"><i class="icon-copy fa fa-check-circle-o" aria-hidden="true" style="font-size:20px;margin-right:10px;"></i>Applied</p>
                <small style="margin-left:26px;color:grey;font-size:15px;"><?php echo date('d-m-Y', strtotime($row['ApplyDate']));?></small>
              </blockquote>
              </div>
            </div>
          </div>
            <?php
        }
      }
      else{
        ?>
        <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
              <img src="images/search_not_found.jpg" alt="No Result" class="img-fluid" style="height: 160px;width: 180px;">
              <h3 class="section-title mb-3">Your Saved Jobs List is Empty</h3>
              <?php
          }
        ?>
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
              <li><a href="#">About Us</a></li>
              <li><a href="#">Career</a></li>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
  <script src="src/plugins/jquery-asColor/dist/jquery-asColor.js"></script>
	<script src="src/plugins/jquery-asGradient/dist/jquery-asGradient.js"></script>
	<script src="src/plugins/jquery-asColorPicker/jquery-asColorPicker.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

  <script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  </script>
  <script>
    function save_job(action,job_id){
    event.preventDefault();
    $(document).ready(function(){
      //summary
      console.log(job_id);
      console.log("save_job");
      var data = {
            action: action,
            job_id: job_id,
        };
        swal({
        title: "Are you sure?",
        text: "",
        icon: "warning",
        buttons: ["No, cancel it!", "Yes, I am sure!"],
        dangerMode: true,
    }).then((result) => {
        if (result) {
            $.ajax({
              url: 'save_job.php',
              type: 'post',
              data: data,
              async: true, 
              success:function(response){
                    console.log(response);
                    swal("Success", "Delete successfully", "success").then(function () {
                      $('#savejob-section').load(location.href + " #savejob-section > *");
                    });
                },
            });
        }
    });
    });
  }</script>

  </body>
</html>