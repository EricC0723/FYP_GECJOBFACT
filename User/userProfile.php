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
          <div class="site-logo col-6"><a href="index.php">GEC  JOBFACT</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php" class="nav-link">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li>
                <a href="job-listings.php">Job Listings</a>
              </li>
              <li><a href="contact.php" class="active">Contact</a></li>
            </ul>
          </nav>
          
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
          
    <a href="../Company/company_login.php"><button type="button" class="btn btn-success" style="margin-left: 560px; color: white; margin-top: 5px; max-width: 150px; white-space: nowrap;">Employer site</button></a>
          <div class="ml-auto">
          <?php 
              if (isset($_SESSION['User_ID'])) {
                ?>
                <!-- <a href="login.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span><?php echo $_SESSION['First_Name'];?></a> -->
                <!-- <a href="#" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Eric Ching Khai Jie</a> -->
                <div class="user-info-dropdown">
                <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" style="color:white;border: 2px solid #787785;border-radius: 4px;padding: 5px;background-color:#787785;margin-left:30px;">
                    <span class="user-name" style="color:white;"><?php echo $_SESSION['First_Name'];?></span>
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
            <h1 class="text-white font-weight-bold">Profile</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Home</a> <span class="mx-2 slash"></span>
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
      $row = mysqli_fetch_assoc($result);

      $career_query = "SELECT * FROM career WHERE UserID = $user_id";
      $career_result = mysqli_query($connect,$career_query);

      $education_query = "SELECT * FROM education WHERE UserID = $user_id";
      $education_result = mysqli_query($connect,$education_query);
    ?>
        <div class="row">
        <!-- Profile -->
        <div class="col-lg-12 mb-4" id="profile-section">
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
                <?php 
                if(!empty($row["Phone"]))
                {
                  ?>
                  <span class="text-white"><i class="icon-copy fa fa-phone" aria-hidden="true"></i><strong style="margin-left:12px;margin-right:28px;">60-<?php echo $row["Phone"]; ?></strong></span>
                <?php
                }
                  ?>
                <p><button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid white;color:white;margin-top:40px;" data-toggle="modal" data-target="#modal-profile" data-toggle-class="modal-open-aside">Edit</button></p>
                </blockquote>
              </div>
            </div>
            <!-- Summary -->
            <div class="col-lg-12 mb-4" id="summary-section" style="margin-top:40px;">
            <h3>Profile Summary</h3>
          <?php
            if(isset($row['Profile_Description']) && !empty($row['Profile_Description']))
            {
              ?>
              <div class="col-lg-8 mb-4" style="margin-top:10px;margin-left:-10px;">
            <div class="block__87154">
              <blockquote>
              <div class="edit-container" data-toggle="modal" data-target="#modal-summary">
              <i class="icon-copy fa fa-edit" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit summary" data-target="#modal-summary"style="position:absolute;margin-left:620px;margin-top:-20px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
              </div>
              <p style="white-space: pre-line;">"<?php echo $row["Profile_Description"]; ?>"</p>
              </blockquote>
            </div>
          </div>
          </div>
              <?php
            }
            else{
            ?>
            <p>Add a personal summary to your profile as a way to introduce who you are.</p>
            <button type="button" class="btn btn-outline-secondary" id="btn" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-summary" data-toggle-class="modal-open-aside">Add Summary</button>
          </div>
        <?php
        }
        ?>
            <!-- career history -->
<div class="col-lg-12 mb-4" id="career-section"style="margin-top:40px;">
<div class="row" style="margin-left:0px;">
    <h3>Career History </h3>&nbsp;&nbsp;<h6 style="color:grey;">(Up to 3 Entries Allowed)</h6>
</div>
  
    <?php
    if (mysqli_num_rows($career_result) > 0) {
        ?>
        <div class="col-lg-8 mb-4" style="margin-top:10px;margin-left:-10px;">
            <?php
            while ($career_row = mysqli_fetch_assoc($career_result)) {
                ?>
                <div class="block__87154">
                    <blockquote>
                    <div class="editCareerBtn delete-container" data-toggle="modal" data-career-id="<?=$career_row['CareerID'];?>" onclick="deleteCareer(event)">
                        <i class="icon-copy fa fa-trash-o" class="deleteCareerBtn" data-toggle="tooltip" title="Delete <?php echo $career_row["JobTitle"]; ?>" aria-hidden="true" style="position:absolute;margin-left:580px;margin-top:-21px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
                   </div>
                    <div class="editCareerBtn edit-container" data-toggle="modal" data-career-id="<?=$career_row['CareerID'];?>" onclick="editCareer(event)">
                        <i class="icon-copy fa fa-edit" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit <?php echo $career_row["JobTitle"]; ?>" style="position:absolute;margin-left:620px;margin-top:-20px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
                        </div>
                        <h5><?php echo $career_row["JobTitle"]; ?></h5>
                        <p><?php echo $career_row["CompanyName"]; ?></p>
                        <?php
                          if($career_row["StillInRole"] == 1)
                          { ?>
                            <p><?php echo $career_row["StartDate"]; ?> - Present</p>
                            <?php
                          }
                          else{
                            ?>
                            <p><?php echo $career_row["StartDate"]; ?> - <?php echo $career_row["EndDate"]; ?></p>
                            <?php
                          }
                        ?>
                         <p style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">"<?php echo $career_row["Description"]; ?> "</p>
                         <!-- <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-career" data-toggle-class="modal-open-aside">Add role</button> -->
                    </blockquote>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        if(mysqli_num_rows($career_result) < 3)
        { ?>
          <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-career" data-toggle-class="modal-open-aside">Add role</button>
          <?php
        }
        } else {
            ?>
            <p>The more you let employers know about your experience, the more you can stand out.</p>
            <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-career" data-toggle-class="modal-open-aside">Add role</button>
            <?php
        }
        ?>
        </div>
          <!-- Education -->
          <div class="col-lg-12 mb-4" id="education-section"style="margin-top:40px;">
            <h3>Education</h3>
            <?php 
              if (mysqli_num_rows($education_result) > 0) {
                $education_row = mysqli_fetch_assoc($education_result);
                ?>
                <div class="col-lg-8 mb-4" style="margin-top:10px;margin-left:-10px;">
                        <div class="block__87154">
                            <blockquote>
                            <div class="editCareerBtn delete-container" data-toggle="modal" onclick="deleteEducation()">
                                <i class="icon-copy fa fa-trash-o" class="deleteEducationBtn" data-toggle="tooltip" title="Delete" aria-hidden="true" style="position:absolute;margin-left:580px;margin-top:-21px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
                           </div>
                            <div class="editCareerBtn edit-container" data-toggle="modal" data-education-id="<?=$education_row['EducationID'];?>" onclick="editEducation(event)">
                                <i class="icon-copy fa fa-edit" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit" style="position:absolute;margin-left:620px;margin-top:-20px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
                                </div>
                                <h5><?php echo $education_row["Institution"]; ?></h5>
                                <p><?php echo $education_row["Course_or_Qualification"]; ?></p>
                                 <p style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">"<?php echo $education_row["Course_Highlight"]; ?> "</p>
                                 <!-- <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-career" data-toggle-class="modal-open-aside">Add role</button> -->
                            </blockquote>
                        </div>
                </div>
                <?php
                }
                else{
                  ?>
                  <p>Tell employers about your education</p>
            <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-education" data-toggle-class="modal-open-aside">Add education</button>
          <?php      
          }
            ?>
          </div>
          <!-- Resume -->
          <div class="col-lg-12 mb-4" id="resume-section"style="margin-top:40px;">
            <h3>Resumé</h3>
          <?php 
            if(!empty($row['Resume_Path']))
            {
              ?>
              <embed src="<?php echo $row['Resume_Path']; ?>" type="application/pdf" width="100%" height="600px" style="margin-top: 20px; margin-bottom: 20px;">   
              <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-resume" data-toggle-class="modal-open-aside">Edit resumé</button>
              <button type="button" class="btn btn-outline-danger" style="margin-left:10px;font-size: 20px;border: 2px solid"  onclick="deleteResume()">Delete</button>
              <?php
            }
          else{
            ?>
            <p>Upload a resumé for easy applying and access no matter where you are.</p>
            <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-resume" data-toggle-class="modal-open-aside">Add resumé</button>
          <?php
            }
            ?>
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
                      <button class="close" data-dismiss="modal">&times;</button>
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
                  <div class="row">
                  <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                          <input type="text" class="form-control" style="border-color:#787785;display: inline-block;text-align:center;" value="Malaysia (+60)" disabled>
                        </div>
                      </div>
                      <div class="col-md-5 col-sm-12"style="position: relative;">
                        <div class="form-group">
                          <input type="text" class="form-control" style="border-color:#787785;display: inline-block;" value="<?php echo $row["Phone"]; ?>" id="phone">
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
                      <button class="close" data-dismiss="modal">&times;</button>
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
                    <input type="submit"  data-dismiss="modal"class="btn btn-primary" value="Save Summary" id="summary_submitbtn" name="submit_summary" onclick="submitData('summary_model');">
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
                  <button class="close" data-dismiss="modal">&times;</button>
                  </div>
                    <form action="editProfile.php" method="post" id="model-career">
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Role</h3>
                        <h5 style="margin-top:30px;">Job title</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" id="job_title" style="margin-top:10px;border-color:#787785;" placeholder="Exp : Software Engineer">
                        </div>
                        <h5 style="margin-top:30px;">Company name</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" id="company_name" style="margin-top:10px;border-color:#787785;" placeholder="Exp : IndelFe Sdn Bhd">
                        </div>
                        <h5 style="margin-top:30px;">Started</h5>
                        <div class="form-group">
                          <input type="month" class="form-control" id="start_date" name="start_date"style="margin-top:10px;border-color:#787785;">
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
																<textarea class="form-control" name="description" id="description" placeholder="I once made contributions to this business. . . ."></textarea>
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
          <!-- Edit Career Modal -->
   <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-sm-6">
          <div id="modal-career-edit" class="modal fade" data-backdrop="false" style="backdrop-filter: blur(2px);">
            <div class="modal-dialog modal-right w-xl">
              <div class="modal-content h-100 no-radius">
                <div class="modal-header">
                      <button class="close" data-dismiss="modal">&times;</button>
                  </div>
                    <form action="editProfile.php" method="post" id="model-career">
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Edit Role</h3>
                        <h5 style="margin-top:30px;">Job title</h5>
                        <div class="form-group">
                        <input type="hidden" name="edit_career_id" id="edit_career_id" >
                          <input type="text" class="form-control" id="edit_job_title" style="margin-top:10px;border-color:#787785;" placeholder="Exp : Software Engineer">
                        </div>
                        <h5 style="margin-top:30px;">Company name</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" id="edit_company_name" style="margin-top:10px;border-color:#787785;" placeholder="Exp : IndelFe Sdn Bhd">
                        </div>
                        <h5 style="margin-top:30px;">Started</h5>
                        <div class="form-group">
                          <input type="month" class="form-control" id="edit_start_date" name="start_date" style="margin-top:10px;border-color:#787785;" required>
                        </div>
                        <h5 style="margin-top:30px;">Ended</h5>
                        <div class="form-group">
                          <input type="month" class="form-control" id="edit_end_date" name="end_date" style="margin-top:10px;border-color:#787785;">
                          <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="edit_customCheck1">
                          <label class="custom-control-label" for="edit_customCheck1" style="margin-top:10px;">Still in role</label>
                        </div>
                        </div>
                        <div class="form-group">
                            <h5 style="margin-top:30px; display: inline-block;">Description</h5>
                            <p style="margin-top:10px; display: inline-block;margin-left:5px;color:grey;">(recommended)</p>
                            <p style="margin-top:-15px;"> Summarise your responsibilities, skills and achievements.</p>
                        </div>
                          <div class="form-group">
																<textarea class="form-control" id="edit_description" name="edit_description" placeholder="I once made contributions to this business. . . ."></textarea>
															</div>
                       </div>
                    </div>
                  <div class="modal-footer" style="margin-bottom:-20px;">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Update" id="edit_career_submitbtn" name="submit_career" onclick="submitData('edit_career_model');">
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
                      <button class="close" data-dismiss="modal">&times;</button>
                  </div>
                    <form action="editProfile.php" method="post" id="model-education">
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Education</h3>
                        <h5 style="margin-top:30px;">Institution</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" name="institution" id="institution" style="margin-top:10px;border-color:#787785;" placeholder="Exp : Multimedia University">
                        </div>
                        <h5 style="margin-top:30px;">Course or qualification</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" name="qualification" id="qualification"style="margin-top:10px;border-color:#787785;" placeholder="Exp : Diploma in Information Technology">
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
													  	<textarea class="form-control" name="education_description" id="education_description"></textarea>
													</div>
                       </div>
                    </div>
                  <div class="modal-footer" style="margin-bottom:-20px;">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save Details" id="education_submitbtn" name="submit_education" onclick="submitData('education_model');">
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
           <!--Edit Education Modal -->
   <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-sm-6">
          <div id="modal-education-edit" class="modal fade" data-backdrop="false" style="backdrop-filter: blur(2px);">
            <div class="modal-dialog modal-right w-xl">
              <div class="modal-content h-100 no-radius">
                <div class="modal-header">
                      <button class="close" data-dismiss="modal">&times;</button>
                  </div>
                    <form action="editProfile.php" method="post" id="model-education">
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Education</h3>
                        <h5 style="margin-top:30px;">Institution</h5>
                        <div class="form-group">
                        <input type="hidden" name="edit_education_id" id="edit_education_id" >
                          <input type="text" class="form-control" name="institution" id="edit_institution" style="margin-top:10px;border-color:#787785;" placeholder="Exp : Multimedia University">
                        </div>
                        <h5 style="margin-top:30px;">Course or qualification</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" name="qualification" id="edit_qualification"style="margin-top:10px;border-color:#787785;" placeholder="Exp : Diploma in Information Technology">
                        </div>
                        <!-- <div class="col-auto my-1"> -->
                          <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="edit_customControlAutosizing">
                            <label class="custom-control-label" for="edit_customControlAutosizing">Qualification complete</label>
                          <!-- </div> -->
                        </div>
                        <div class="form-group">
                            <h5 style="margin-top:30px; display: inline-block;">Course Highlight</h5>
                            <p style="margin-top:10px; display: inline-block;margin-left:5px;color:grey;">(optional)</p>
                            <p style="margin-top:-15px;"> Add activities, projects, awards or achievements during your study</p>
                        </div>
                          <div class="form-group">
													  	<textarea class="form-control" name="edit_education_description" id="edit_education_description"></textarea>
													</div>
                       </div>
                    </div>
                  <div class="modal-footer" style="margin-bottom:-20px;">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save Details" id="edit_education_submitbtn" name="submit_education" onclick="submitData('edit_education_model');">
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
                      <button class="close" data-dismiss="modal">&times;</button>
                  </div>
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <form action="editProfile.php" method="post" id="model-resume" enctype="multipart/form-data">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Resumé</h3>
                          <p style="margin-top:30px;">Accepted file types: pdf (2MB limit).</p>
                          <div class="form-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_resume" name="file_resume" accept=".pdf">
                            <label class="custom-file-label" for="file_resume">Choose file</label>
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
                    <input type="submit" class="btn btn-primary" value="Save Details" id="resume_submitbtn" name="submit_resume" onclick="submitData('resume_model');">
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
    //Edit Career
function editCareer() {
  var career_id = $(event.currentTarget).data('career-id');
    console.log('Career ID:', career_id);
$.ajax({
    type: "GET",
    url: "editProfile.php?career_id=" + career_id,
    success: function (response) {
      console.log(response);
        var res = jQuery.parseJSON(response);
        if(res.status == 404) {

            alert(res.message);
        }else if(res.status == 200){

            $('#edit_career_id').val(res.data.CareerID);
            $('#edit_job_title').val(res.data.JobTitle);
            $('#edit_company_name').val(res.data.CompanyName);
            $('#edit_start_date').val(res.data.StartDate);
            if (res.data.StillInRole == 1) {
                    $('#edit_end_date').val('');
                } else {
                    $('#edit_end_date').val(res.data.EndDate);
                }
            $('#edit_customCheck1').prop('checked', res.data.StillInRole == 1);
            $('#edit_description').val(res.data.Description);

            $('#modal-career-edit').modal('show');
        }
    }
});
}
</script>
<script>
//Edit Education
function editEducation() {
  var education_id = $(event.currentTarget).data('education-id');
    console.log('Career ID:', education_id);
$.ajax({
    type: "GET",
    url: "editProfile.php?education_id=" + education_id,
    success: function (response) {
      console.log(response);
        var res = jQuery.parseJSON(response);
        if(res.status == 404) {

            alert(res.message);
        }else if(res.status == 200){

            $('#edit_education_id').val(res.data.EducationID);
            $('#edit_institution').val(res.data.Institution);
            $('#edit_qualification').val(res.data.Course_or_Qualification);
            $('#edit_education_description').val(res.data.Course_Highlight);
            $('#edit_customControlAutosizing').prop('checked', res.data.Qualification_complete == 1);

            $('#modal-education-edit').modal('show');
        }
    }
});
}
</script>
  <script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  </script>
  <script>
    //Delete Career
    function deleteCareer() {
    var career_id = $(event.currentTarget).data('career-id');
    var data = {
        action: "delete_career_model",
        career_id: career_id,
    };
    console.log("delete");

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this career history",
        icon: "warning",
        buttons: ["No, cancel it!", "Yes, I am sure!"],
        dangerMode: true,
    }).then((result) => {
        if (result) {
            $.ajax({
                type: "POST",
                url: "editProfile.php?career_id=" + career_id,
                data: data,
                async: true,
                success: function (response) {
                    console.log(response);
                    swal("Success", response, "success").then(function () {
                      $('#career-section').load(location.href + " #career-section > *");
                    });
                },
            });
        }
    });
}
function deleteResume() {
    var data = {
        action: "delete_resume_model",
    };
    console.log("delete");

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this career history",
        icon: "warning",
        buttons: ["No, cancel it!", "Yes, I am sure!"],
        dangerMode: true,
    }).then((result) => {
        if (result) {
            $.ajax({
                type: "POST",
                url: "editProfile.php",
                data: data,
                async: true,
                success: function (response) {
                    console.log(response);
                    swal("Success", response, "success").then(function () {
                      $('#resume-section').load(location.href + " #resume-section > *");
                    });
                },
            });
        }
    });
}
  </script>
    <script>
      //Delete Education
    function deleteEducation() {
    var data = {
        action: "delete_education_model",
    };
    console.log("delete");

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover your education history",
        icon: "warning",
        buttons: ["No, cancel it!", "Yes, I am sure!"],
        dangerMode: true,
    }).then((result) => {
        if (result) {
            $.ajax({
                type: "POST",
                url: "editProfile.php",
                data: data,
                async: true,
                success: function (response) {
                    console.log(response);
                    swal("Success", response, "success").then(function () {
                      $('#education-section').load(location.href + " #education-section > *");
                    });
                },
            });
        }
    });
}
  </script>
  <script>
$('#modal-career-edit').on('shown.bs.modal', function () {
    var isChecked = $('#edit_customCheck1').prop('checked');
    var endDateInput = $('#edit_end_date');

    if (isChecked) {
        endDateInput.hide();
    } else {
        endDateInput.show();
    }

    $('#edit_customCheck1').change(function () {
        toggleEndDateVisibility();
    });

    function toggleEndDateVisibility() {
        var isChecked = $('#edit_customCheck1').prop('checked');

        if (isChecked) {
            endDateInput.hide();
        } else {
            endDateInput.show();
        }
    }
});
</script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // 获取当前日期
    var currentDate = new Date();
    
    // 获取年月的字符串，例如：YYYY-MM
    var currentMonth = currentDate.toISOString().slice(0, 7);

    // 设置 start_date 的最大值为当前日期
    document.getElementById('start_date').setAttribute('max', currentMonth);
    document.getElementById('edit_start_date').setAttribute('max', currentMonth);

    // 设置 end_date 的最大值为当前日期，但添加一个月的余地
    var nextMonth = new Date(currentDate);
    nextMonth.setMonth(nextMonth.getMonth());
    var nextMonthString = nextMonth.toISOString().slice(0, 7);
    document.getElementById('end_date').setAttribute('max', nextMonthString);
    document.getElementById('edit_end_date').setAttribute('max', currentMonth);
});
  </script>
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