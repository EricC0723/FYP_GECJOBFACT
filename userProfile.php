<?php
  session_start();
  include("C:/xampp/htdocs/FYP/dataconnection.php");
  require 'script.php';
  require 'validation/veridationProfile.php';
  require 'validation/veridationSummary.php';
  require 'validation/veridationCareer.php';
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
  
    <!-- MAIN CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	  <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css"> -->
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
              <li><a href="blog.html" class="active">Blog</a></li>
              <li><a href="contact.html">Contact</a></li>
              <li class="d-lg-none"><a href="post-job.html"><span class="mr-2">+</span> Post a Job</a></li>
              <li class="d-lg-none"><a href="login.php">Log In</a></li>
            </ul>
          </nav>
          
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
          <div class="ml-auto">
           <?php 
              if (isset($_SESSION['User_ID'])) {
                ?>
                <!-- <a href="#" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Eric Ching Khai Jie</a> -->
                <div class="user-info-dropdown">
                <div class="dropdown">
                  <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" style="color:white;border: 2px solid #787785;border-radius: 4px;padding: 5px;background-color:#787785; z-index: 1">
                    <span class="user-name"  style="color:white;"><?php echo $_SESSION['First_Name'];?></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="profile.php?view&userid=<?php echo $_SESSION['User_ID'];?>"><i class="dw dw-user1" style="margin-right: 10px;"></i> Profile</a>
                    <a class="dropdown-item" href="profile.html"><i class="dw dw-settings2" style="margin-right: 10px;"></i> Setting</a>
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
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Profile</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Profile</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">
      <?php 
      $locationquery = "SELECT * FROM job_location";
      $locationresult = mysqli_query($connect,$locationquery);

      $user_id = $_SESSION['User_ID'];
      $query = "SELECT * FROM users WHERE UserID = $user_id";
      $result = mysqli_query($connect,$query);
      $row = mysqli_fetch_assoc($result)
    ?>
        <div class="row">
        <!-- Profile -->
        <div class="col-lg-12 mb-4">
              <!-- <div class="block__87154 bg-primary"> -->
              <div class="block__87154 bg-secondary">
                <blockquote>
                  <div class="block__91147 d-flex align-items-center" style="margin-bottom:20px;">
                  <div>
                    <h1 class="text-white"><?php echo $row['FirstName'];?>&nbsp<?php echo $row['LastName'];?></h3>
                  </div>
                </div>
                <span class="text-white" style="size:30px;"><i class="icon-copy dw dw-email"></i><strong style="margin-left:12px;margin-right:28px;"><?php echo $row["Email"]; ?></strong></span>
                <span class="text-white"><span class="icon-room"></span><strong style="margin-left:12px;margin-right:28px;"><?php echo $row['Location'];?></strong></span>
                <span class="text-white"><i class="icon-copy fa fa-phone" aria-hidden="true"></i><strong style="margin-left:12px;margin-right:28px;"><?php echo $row["Phone"]; ?></strong></span>
                <p><button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid white;color:white;margin-top:40px;" data-toggle="modal" data-target="#modal-profile" data-toggle-class="modal-open-aside" onclick="hideOverlay()">Edit</button></p>
                </blockquote>
              </div>
            </div>
          <!-- Summary -->
          <div class="col-lg-12 mb-4" style="margin-top:40px;">
            <h3>Profile Summary</h3>
            <p>Add a personal summary to your profile as a way to introduce who you are.</p>
            <button type="button" class="btn btn-outline-secondary" id="btn" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-summary" data-toggle-class="modal-open-aside" onclick="hideOverlay()">Add Summary</button>
          </div>
          <!-- career history -->
          <div class="col-lg-12 mb-4" style="margin-top:40px;">
            <h3>Career history</h3>
            <p>The more you let employers konw about your experience, the more you can stand out.</p>
            <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-career" data-toggle-class="modal-open-aside" onclick="hideOverlay()">Add role</button>
          </div>
          <!-- Education -->
          <div class="col-lg-12 mb-4" style="margin-top:40px;">
            <h3>Education</h3>
            <p>Tell employers about your education</p>
            <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-education" data-toggle-class="modal-open-aside" onclick="hideOverlay()">Add education</button>
          </div>
          <!-- Resume -->
          <div class="col-lg-12 mb-4" style="margin-top:40px;">
            <h3>Resumé</h3>
            <p>Upload a resumé for easy applying and access no matter where you are.</p>
            <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-resume" data-toggle-class="modal-open-aside" onclick="hideOverlay()">Add resumé</button>
          </div>
            
          
          <!-- <div class="col-lg-12 mb-4">
            <div class="block__87154 bg-primary">
              <blockquote>
                <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_4.jpg" alt="Image" class="img-fluid"></figure>
                <div>
                  <h3 class="text-white">Pippa Cooper</h3>
                  <span class="position position-2">Web Designer</span>
                </div>
              </div>
                <p class="text-white">&ldquo;Ipsum harum assumenda in eum vel eveniet numquam, cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
                <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search" name="searchbtn"><span class="icon-search icon mr-2"></span>Search Job</button>
              </blockquote>
            </div>
          </div> -->

          <div class="col-lg-6 mb-4">
            <div class="block__87154">
              <blockquote>
                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam cumque vero vitae enim cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex asperiores quisquam optio nostrum sit&rdquo;</p>
              </blockquote>
              <div class="block__91147 d-flex align-items-center">
                <figure class="mr-4"><img src="images/person_1.jpg" alt="Image" class="img-fluid"></figure>
                <div>
                  <h3>Elisabeth Smith</h3>
                  <span class="position">Creative Director</span>
                </div>
              </div>
            </div>
          </div>
          <!-- Profile Modal -->
   <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-sm-6">
          <div id="modal-profile" class="modal fade" data-backdrop="false" style="backdrop-filter: blur(2px);">
            <div class="modal-dialog modal-right w-xl">
              <div class="modal-content h-100 no-radius">
                <div class="modal-header">
                  <!-- <div class="modal-title text-md">Add personal summary</div> -->
                      <button class="close" data-dismiss="modal" onclick="hideOverlay()">&times;</button>
                  </div>
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <form action="editProfile.php" method="post" id="model-profile">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Edit personal details</h3>
                        <div class="row">
                      <div class="col-md-5 col-sm-12">
                        <h5 style="margin-top:30px;display: inline-block;">First Name</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" id="first_name" style="margin-top:10px;border-color:#787785;" value="<?php echo $row['FirstName'];?>">
                        </div>
                      </div>
                      <div class="col-md-5 col-sm-12">
                        <h5 style="margin-top:30px;display: inline-block;">Last Name</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" id="last_name" style="margin-top:10px;border-color:#787785;" value="<?php echo $row['LastName'];?>">
                        </div>
                      </div>
                    </div>
                    <h5 style="margin-top:30px;">Email</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" name="email" style="margin-top:10px;border-color:#787785;" value="<?php echo $row['Email'];?>" disabled>
                        </div>
                        <h5 style="margin-top:30px;">Home location</h5>
                        <div class="form-group">
                            <select class="selectpicker" data-size="5" data-style="btn-black btn-lg" data-width="100%" title="Select location" id="location" style="height: auto;">
                                <?php 
                                if(mysqli_num_rows($locationresult) > 0)
                                {
                                    $selectedLocation = $row['Location']; // Assuming $row['Location'] contains the default location

                                    while($locationrow = mysqli_fetch_assoc($locationresult))
                                    {
                                        $optionValue = $locationrow["Job_Location_Name"];
                                ?>
                                <option value="<?php echo $optionValue; ?>" <?php echo ($optionValue == $selectedLocation) ? 'selected' : ''; ?>><?php echo $optionValue; ?></option>
                                <?php 
                                    }
                                }
                                ?>
                            </select>                 
                  <h5 style="margin-top:30px;display: inline-block;">Phone number</h5>
                  <p style="display: inline-block;margin-left:5px;color:grey;">(recommended)</p>
                  <div class="row">
                  <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <input type="text" class="form-control" style="border-color:#787785;display: inline-block;text-align:center;" value="Malaysia (+60)" disabled>
                        </div>
                      </div>
                      <div class="col-md-5 col-sm-12"style="position: relative;">
                        <div class="form-group">
                          <input type="text" class="form-control" style="border-color:#787785;display: inline-block;" value="<?php echo $row["Phone"]; ?>" id="phone">
                          <div class="error-container" style="color:red;font-size:12px;display:inline-block;position: absolute;top: 100%; left: 0;"> </div>
                        </div>
                      </div>
                    </div>
                        </div>
                       </div>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" data-dismiss="modal" value="Save Profile" id="profile_submitbtn" name="submit_profile" onclick="submitData('profile_model');">
                  </form>
                 </div>
                </div>
              </div>          
           </div>
          </div>
         </div>
        </div>
          <!-- Modal End-->
          <!-- Summary Modal -->
   <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-sm-6">
          <div id="modal-summary" class="modal fade" data-backdrop="false" style="backdrop-filter: blur(2px);">
            <div class="modal-dialog modal-right w-xl">
              <div class="modal-content h-100 no-radius">
                <div class="modal-header">
                  <!-- <div class="modal-title text-md">Add personal summary</div> -->
                      <button class="close" data-dismiss="modal" onclick="hideOverlay()">&times;</button>
                  </div>
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <form action="" method="post" id="model-summary" autocomplete="off">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Edit personal summary</h3>
                        <div style="position: relative;">
                        <h5 style="margin-top:30px;">Summary</h5>
                          <p style="margin-top:10px;">Highlight your unique experiences, ambitions and strengths.</p>
                          <div class="form-group">
																<textarea class="form-control" name="summary" id="summary"><?php echo $row["Profile_Description"]; ?></textarea>
													</div>
                          </div>
                       </div>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save Summary" id="summary_submitbtn" name="submit_summary" onclick="submitData('summary_model');">
                 </div>
                </form>
                </div>
              </div>          
           </div>
          </div>
         </div>
        </div>
          <!-- Modal End-->
          <!-- Career Modal -->
   <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-sm-6">
          <div id="modal-career" class="modal fade" data-backdrop="false" style="backdrop-filter: blur(2px);">
            <div class="modal-dialog modal-right w-xl">
              <div class="modal-content h-100 no-radius">
                <div class="modal-header">
                      <button class="close" data-dismiss="modal" onclick="hideOverlay()">&times;</button>
                  </div>
                    <form action="editProfile.php" method="post" id="model-career">
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Role</h3>
                        <h5 style="margin-top:30px;">Job title</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" id="job_title" style="margin-top:10px;border-color:#787785;" required>
                        </div>
                        <h5 style="margin-top:30px;">Company name</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" id="company_name" style="margin-top:10px;border-color:#787785;" required>
                        </div>
                        <h5 style="margin-top:30px;">Started</h5>
                        <div class="form-group">
                          <input type="month" class="form-control" id="start_date" name="start_date"style="margin-top:10px;border-color:#787785;" required>
                        </div>
                        <h5 style="margin-top:30px;">Ended</h5>
                        <div class="form-group">
                          <input type="month" class="form-control" id="end_date" name="end_date"style="margin-top:10px;border-color:#787785;">
                          <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                          <label class="custom-control-label" for="customCheck1" style="margin-top:10px;">Still in role</label>
                        </div>
                        </div>
                        <div class="form-group">
                            <h5 style="margin-top:30px; display: inline-block;">Description</h5>
                            <p style="margin-top:10px; display: inline-block;margin-left:5px;color:grey;">(recommended)</p>
                            <p style="margin-top:-15px;"> Summarise your responsibilities, skills and achievements.</p>
                        </div>
                          <div class="form-group">
																<textarea class="form-control" name="description"></textarea>
															</div>
                       </div>
                    </div>
                  <div class="modal-footer" style="margin-bottom:-20px;">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save Carrer" id="career_submitbtn" name="submit_career" onclick="submitData('career_model');">
                  </div>
                </form>
                 </div>
                </div>
              </div>
           </div>
          </div>
         </div>
        </div>
          <!-- Modal End-->
          <!-- Education Modal -->
   <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-sm-6">
          <div id="modal-education" class="modal fade" data-backdrop="false" style="backdrop-filter: blur(2px);">
            <div class="modal-dialog modal-right w-xl">
              <div class="modal-content h-100 no-radius">
                <div class="modal-header">
                      <button class="close" data-dismiss="modal" onclick="hideOverlay()">&times;</button>
                  </div>
                    <form action="editProfile.php" method="post" id="model-education">
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Education</h3>
                        <h5 style="margin-top:30px;">Institution</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" name="institution" style="margin-top:10px;border-color:#787785;">
                        </div>
                        <h5 style="margin-top:30px;">Course or qualification</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" name="qualification" style="margin-top:10px;border-color:#787785;">
                        </div>
                        <!-- <div class="col-auto my-1"> -->
                          <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                            <label class="custom-control-label" for="customControlAutosizing">Qualification complete</label>
                          <!-- </div> -->
                        </div>
                        <div class="form-group">
                            <h5 style="margin-top:30px; display: inline-block;">Course Highlight</h5>
                            <p style="margin-top:10px; display: inline-block;margin-left:5px;color:grey;">(optional)</p>
                            <p style="margin-top:-15px;"> Add activities, projects, awards or achievements during your study</p>
                        </div>
                          <div class="form-group">
													  	<textarea class="form-control" name="description"></textarea>
													</div>
                       </div>
                    </div>
                  <div class="modal-footer" style="margin-bottom:-20px;">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" data-dismiss="modal" value="Save Details" id="education_submitbtn" name="submit_education" onclick="submitData('education_model');">
                  </div>
                </form>
                 </div>
                </div>
              </div>          
           </div>
          </div>
         </div>
        </div>
          <!-- Modal End-->
          <!-- Resume Modal -->
   <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-sm-6">
          <div id="modal-resume" class="modal fade" data-backdrop="false" style="backdrop-filter: blur(2px);">
            <div class="modal-dialog modal-right w-xl">
              <div class="modal-content h-100 no-radius">
                <div class="modal-header">
                  <!-- <div class="modal-title text-md">Add personal summary</div> -->
                      <button class="close" data-dismiss="modal" onclick="hideOverlay()">&times;</button>
                  </div>
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <form action="editProfile.php" method="post" id="model-resume">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Resumé</h3>
                          <p style="margin-top:30px;">Accepted file types: pdf (2MB limit).</p>
                          <div class="form-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="file_resume" accept=".pdf">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
													</div>
                       </div>
                       <h6 style="margin-top:60px;">Protect your privacy</h3>
                       <p style="font-size:16px;margin-top:10px;">Only share necessary information.  Don't include the content of identity documents, financial information or other sensitive information such as your religion or race.</p>
                       <h6 style="margin-top:20px;">How we uses your data</h3>
                       <p style="font-size:16px;margin-top:10px;">The resumé you use in an application becomes your default resumé.  we will predict when you may be a strong candidate based on your default resumé.</p>
                       <p style="font-size:16px;margin-top:10px;">Using data based on employers' past behaviour, your default resume and other factors, we predicts when you're likely to be a strong candidate for a role and may display this information to you and employers.</p>
                      </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" data-dismiss="modal" value="Save Details" id="resume_submitbtn" name="submit_resume" onclick="submitData('resume_model');">
                  </form>
                 </div>
                </div>
              </div>          
           </div>
          </div>
         </div>
        </div>
          <!-- Modal End-->
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
  function hideOverlay() {
    var elements = document.getElementsByClassName('user-info-dropdown');
  for (var i = 0; i < elements.length; i++) {
    elements[i].style.display = (elements[i].style.display === 'flex' || elements[i].style.display === '') ? 'none' : 'flex';
  }
  }
   </script>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

  </body>
</html>