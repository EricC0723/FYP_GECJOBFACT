<?php
  session_start();
  include("C:/xampp/htdocs/FYP/dataconnection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <title>GEC JobFact</title>
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

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">    
    <style>
        ul.list-unstyled.m-0.p-0 li {
    font-size: 1.2em;
  }
    </style>
  </head>
  <body id="top">

  <!-- <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div> -->
    

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
              <li><a href="index.php" class="nav-link ">Home</a></li>
              <li><a href="about.html">About</a></li>
              <li class="has-children">
                <a href="job-listings.php" class="active">Job Listings</a>
                <ul class="dropdown">
                  <li><a href="job-single.php" class="active">Job Single</a></li>
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
              <!-- <li class="d-lg-none"><a href="post-job.html"><span class="mr-2">+</span> Post a Job</a></li>
              <li class="d-lg-none"><a href="login.php">Log In</a></li> -->
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
                    <span class="user-name"><?php echo $_SESSION['First_Name'];?></span>
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
              <!-- <a href="login.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log In</a> -->
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>

    <!-- HOME -->
    <?php 
				if(isset($_GET['view']))
				{
					$jobID = $_GET['jobid'];
          if (isset($_SESSION['User_ID'])) {
            $user_id = $_SESSION['User_ID'];
            $save_job_query = "SELECT * FROM save_job WHERE UserID='$user_id' AND Job_Post_ID='$jobID'";
            
            $save_job_result = mysqli_query($connect,$save_job_query);
          }

					// $result = mysqli_query($connect,"SELECT * FROM job_post WHERE Job_Post_ID = '$jobID'");
					
          // $CompanyName = mysqli_query($connect,"SELECT CompanyName FROM companies WHERE CompanyID = CompanyID");
          $result = mysqli_query($connect, "SELECT job_post.*, companies.* FROM job_post
            INNER JOIN companies ON job_post.CompanyID = companies.CompanyID
            WHERE job_post.Job_Post_ID = '$jobID'");
            $row = mysqli_fetch_assoc($result);
          $question_query = "SELECT * FROM job_post_questions WHERE JobID='$jobID'";
          $question_result = mysqli_query($connect, $question_query);
          $question_row = mysqli_fetch_assoc($question_result);
				}
			?>
      
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"><?php echo $row['Job_Post_Title']; ?></h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong><?php echo $row['Job_Post_Title']; ?></strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="site-section">
      <div class="container">
        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div class="border p-2 d-inline-block mr-3 rounded">
                <img src="../Company/covers/Screenshot (1).png" alt="Image">
              </div>
              <div>
                <h2 style="margin-bottom:30px;"><?php echo $row['Job_Post_Title']; ?></h2>
                <div>
                  <p></p><span class="ml-0 mr-2 mb-2" style="margin-left:1000px;"><span class="icon-briefcase mr-2"></span><?php echo $row['CompanyName']; ?></span>
                  <span class="m-2"><span class="icon-room mr-2"></span><?php echo $row['Job_Post_Location']; ?></span>
                  <?php 
                  $JobType = "";
                    switch($row['Job_Post_Type'])
                    {
                      case "1" :  $JobType = "Part Time";break;
                          case "2" :  $JobType = "Full Time";break;
                          case "3" :  $JobType = "Internship";break;
                          case "4" :  $JobType = "Contract";break;
                          default: $JobType = "";break;
                    }
                  ?>
                  <!-- <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary"><?php echo $JobType;?></span></span> -->
                  <div style="margin-top:8px;position:absolute;">
                    <?php echo $row["Main_Category_Name"];?> ( <?php echo $row["Sub_Category_Name"];?> )
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-6">
              <?php 
              if (isset($_SESSION['User_ID'])) {
                ?>
              <div id="saveButton" class="btn btn-block btn-light btn-md" style="cursor: pointer;" onclick="save_job('<?php echo mysqli_num_rows($save_job_result) > 0 ? 'delete_job' : 'add_job'; ?>', <?php echo $jobID; ?>)">
            <?php if (mysqli_num_rows($save_job_result) > 0) { ?>
                <span class="icon-copy fa fa-heart" aria-hidden="true" style="margin-right:10px;color:red;"></span>Unsave
            <?php } else { ?>
                <span class="icon-heart-o mr-2 text-danger"></span>Save
            <?php }
              }
              else{
                ?>
              <div id="saveButton" class="btn btn-block btn-light btn-md" style="cursor: pointer;">
              <span class="icon-heart-o mr-2 text-danger"></span>Save
            <?php
              }
                ?>
        </div>
                <!-- <a href="#" class="btn btn-block btn-light btn-md"><span class="icon-heart-o mr-2 text-danger"></span></i>Save</a> -->
              </div>
              <div class="col-6">
                <a href="apply_job.php?jobid=<?php echo $jobID; ?>" class="btn btn-block btn-primary btn-md">Quick apply</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <div class="mb-5">
              <figure class="mb-5"><img src="images/job_single_img_1.jpg" alt="Image" class="img-fluid rounded"></figure>
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Job Description</h3>
              <?php
                $DescriptionText = $row['Job_Post_Description'];
                $DescriptionArray = explode("\n", $DescriptionText);
                foreach ($DescriptionArray as $description) {
                    if (!empty(trim($description))) {
                      echo '<p>' . trim($description) . '</p>';
                    }
                }
                ?>
            </div>
            <div class="mb-5">
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-rocket mr-3"></span>Responsibilities</h3>
            <ul id="responsibilitiesList" class="list-unstyled m-0 p-0">
                <?php
                $responsibilitiesText = $row['Job_Post_Responsibilities'];
                $responsibilitiesArray = explode("\n", $responsibilitiesText);
                foreach ($responsibilitiesArray as $responsibility) {
                    if (!empty(trim($responsibility))) {
                      echo '<li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>' . trim($responsibility) . '</span></li>';
                    }
                }
                ?>
            </ul>
            </div>
            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-book mr-3"></span>Education + Experience</h3>
              <ul class="list-unstyled m-0 p-0">
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Necessitatibus quibusdam facilis</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Velit unde aliquam et voluptas reiciendis non sapiente labore</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Commodi quae ipsum quas est itaque</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit</span></li>
                <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>Deleniti asperiores blanditiis nihil quia officiis dolor</span></li>
              </ul>
            </div>
            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><i class="icon-copy fa fa-question-circle" aria-hidden="true" style="margin-right:10px;"></i>Question</h3>
              <ul class="list-unstyled m-0 p-0">
              <?php
                $CompanyBenefitsText = $question_row['CompanyBenefits'];
                $CompanyBenefitsArray = explode("\n", $CompanyBenefitsText);
                foreach ($CompanyBenefitsArray as $CompanyBenefits) {
                    if (!empty(trim($CompanyBenefits))) {
                      echo '<li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>' . trim($CompanyBenefits) . '</span></li>';
                    }
                }
                ?>
              </ul>
            </div>
            
            <div class="mb-5">
              <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-turned_in mr-3"></span>Other Benifits</h3>
              <ul class="list-unstyled m-0 p-0">
              <?php
                $CompanyBenefitsText = $row['CompanyBenefits'];
                $CompanyBenefitsArray = explode("\n", $CompanyBenefitsText);
                foreach ($CompanyBenefitsArray as $CompanyBenefits) {
                    if (!empty(trim($CompanyBenefits))) {
                      echo '<li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>' . trim($CompanyBenefits) . '</span></li>';
                    }
                }
                ?>
              </ul>
            </div>
            <?php
                switch($row["Job_Post_Type"])
                {
                  case "1" :  $JobType = "Part Time";break;
                  case "2" :  $JobType = "Full Time";break;
                  case "3" :  $JobType = "Internship";break;
                  case "4" :  $JobType = "Contract";break;
                  default: $JobType = "";break;
                }
              ?>
          </div>
          <div class="col-lg-4">
            <div class="bg-light p-3 border rounded mb-4">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
              <ul class="list-unstyled pl-3 mb-0">
                <li class="mb-2"><strong class="text-black">Position: </strong> <?php echo $row["Job_Post_Position"];?></li>
                <li class="mb-2"><strong class="text-black">Vacancy: </strong> <?php echo $row["CompanySize"];?></li>
                <li class="mb-2"><strong class="text-black">Employment Status: </strong> <?php echo $JobType;?></li>
                <li class="mb-2"><strong class="text-black">Experience:</strong>&nbsp<?php echo $row["Job_Post_Exp"];?> above</li>
                <li class="mb-2"><strong class="text-black">Job Location:</strong> <?php echo $row["Job_Post_Location"];?></li>
                <li class="mb-2"><strong class="text-black">Salary:</strong> RM<?php echo $row['Job_Post_MinSalary']; ?> - RM<?php echo $row['Job_Post_MaxSalary']; ?></li>
                <li class="mb-2"><strong class="text-black">Gender:</strong> Any</li>
                <li class="mb-2"><strong class="text-black">Application Deadline:</strong> <?php echo date('d-m-Y', strtotime($row['AdEndDate'])); ?></li>
              </ul>
            </div>

            <div class="bg-light p-3 border rounded">
              <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
              <div class="px-3">
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-pinterest"></span></a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">22,392 Related Jobs</h2>
          </div>
        </div>
        
        <ul class="job-listings mb-5">
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php"></a>
            <div class="job-listing-logo">
              <img src="images/job_logo_1.jpg" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Product Designer</h2>
                <strong>Adidas</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> New York, New York
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-danger">Part Time</span>
              </div>
            </div>
            
          </li>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php"></a>
            <div class="job-listing-logo">
              <img src="images/job_logo_2.jpg" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Digital Marketing Director</h2>
                <strong>Sprint</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> Overland Park, Kansas 
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-success">Full Time</span>
              </div>
            </div>
          </li>

          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php"></a>
            <div class="job-listing-logo">
              <img src="images/job_logo_3.jpg" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Back-end Engineer (Python)</h2>
                <strong>Amazon</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> Overland Park, Kansas 
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-success">Full Time</span>
              </div>
            </div>
          </li>

          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php"></a>
            <div class="job-listing-logo">
              <img src="images/job_logo_4.jpg" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Senior Art Director</h2>
                <strong>Microsoft</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> Anywhere 
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-success">Full Time</span>
              </div>
            </div>
          </li>

          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php"></a>
            <div class="job-listing-logo">
              <img src="images/job_logo_5.jpg" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Product Designer</h2>
                <strong>Puma</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> San Mateo, CA 
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-success">Full Time</span>
              </div>
            </div>
          </li>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php"></a>
            <div class="job-listing-logo">
              <img src="images/job_logo_1.jpg" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Product Designer</h2>
                <strong>Adidas</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> New York, New York
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-danger">Part Time</span>
              </div>
            </div>
            
          </li>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="job-single.php"></a>
            <div class="job-listing-logo">
              <img src="images/job_logo_2.jpg" alt="Image" class="img-fluid">
            </div>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2>Digital Marketing Director</h2>
                <strong>Sprint</strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> Overland Park, Kansas 
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-success">Full Time</span>
              </div>
            </div>
          </li>

          

          
        </ul>

        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
            <span>Showing 1-7 Of 22,392 Jobs</span>
          </div>
          <div class="col-md-6 text-center text-md-right">
            <div class="custom-pagination ml-auto">
              <a href="#" class="prev">Prev</a>
              <div class="d-inline-block">
              <a href="#" class="active">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">4</a>
              </div>
              <a href="#" class="next">Next</a>
            </div>
          </div>
        </div>

      </div>
    </section>
    

    <section class="bg-light pt-5 testimony-full">
        
        <div class="owl-carousel single-carousel">

        
          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum repudiandae.&rdquo;</p>
                  <p><cite> &mdash; Corey Woods, @Dribbble</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="images/person_transparent_2.png" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum repudiandae.&rdquo;</p>
                  <p><cite> &mdash; Chris Peters, @Google</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="images/person_transparent.png" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>

      </div>

    </section>

    <section class="pt-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-md-6 align-self-center text-center text-md-left mb-5 mb-md-0">
            <h2 class="text-white">Get The Mobile Apps</h2>
            <p class="mb-5 lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit tempora adipisci impedit.</p>
            <p class="mb-0">
              <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-apple mr-3"></span>App Store</a>
              <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-android mr-3"></span>Play Store</a>
            </p>
          </div>
          <div class="col-md-6 ml-auto align-self-end">
            <img src="images/apps.png" alt="Image" class="img-fluid">
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

    <!-- SCRIPTS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/stickyfill.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    
    <script src="js/bootstrap-select.min.js"></script>
    
    <script src="js/custom.js"></script>
    <!-- <script>
    // 获取 PHP 中的文本内容
    var responsibilitiesText = document.getElementById('responsibilities').textContent.trim();

    // 按照 \r\n 或 \n 分割文本成数组
    var itemsArray = responsibilitiesText.split(/\r?\n/);

    // 创建 ul 元素
    var ulElement = document.getElementById('responsibilitiesList');

    // 将每个数组项添加到 ul 元素中作为 li 元素
    itemsArray.forEach(function(item) {
        if (item.trim() !== '') { // 忽略空项
            var liElement = document.createElement('li');
            liElement.textContent = item.trim();
            ulElement.appendChild(liElement);
        }
    });
</script> -->
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
      $.ajax({
        url: 'save_job.php',
        type: 'post',
        data: data,
        async: true, 
        success:function(response){
          if(response === "failed")
          {
            swal("Oops...", "Please ensure that all information is entered accurately.", "error");
          }
          else{
            var saveButton = $("#saveButton");
                    if (action === "add_job") {
                        saveButton.html('<span class="icon-copy fa fa-heart" aria-hidden="true" style="margin-right:10px;color:red;"></span>Unsave');
                        saveButton.attr("onclick", "save_job('delete_job', " + job_id + ")");
                        swal("Success", "Save successfully", "success")
                    } else if (action === "delete_job") {
                        saveButton.html('<span class="icon-heart-o mr-2 text-danger"></span>Save');
                        saveButton.attr("onclick", "save_job('add_job', " + job_id + ")");
                        swal("Success", "Unsave successfully", "success")
                    }
            console.log("Ajax request successful!");
        //     swal("Success", response, "success").then(function() {

        // });
          }
          
        }
      });

    });
  }</script>
    
     
  </body>
</html>