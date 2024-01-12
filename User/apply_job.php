<?php
  session_start();
  include("C:/xampp/htdocs/FYP/dataconnection.php");
  require 'script.php';
  require 'handle_applyJob.php';
  require 'validation/delete_edit_function.php';
  require 'validation/veridation_job_apply.php';
  require 'validation/veridationSummary.php';
  require 'validation/veridationProfile.php';
  require 'validation/veridationCareer.php';
  require 'validation/veridationEditCareer.php';
  require 'validation/veridationEducation.php';
  require 'validation/veridationEditEducation.php';
  // require 'userProfile.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <title>GEC Job Fact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="css/multi.css">
    <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <!-- <link rel="stylesheet" href="css/style.css">    -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css"> 
    <!-- <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css"> -->
    <link rel="stylesheet" href="css/quill.snow.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
<style>
        #loading{
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7); /* 半透明白色背景 */
            z-index: 1000; /* 遮罩层在最上层 */
        }

        #loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
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
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">    
  </head>
  <body id="top">

  <!-- <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div> -->
    

  <div id="loading">
        <div id="loading-spinner">
            <img src="images/loading.gif" alt="Loading Spinner">
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
          <div class="site-logo col-6"><a href="index.php">DEC JobFact</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php" class="nav-link">Home</a></li>
              <li><a href="about.php">About</a></li>
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
              <li class="d-lg-none"><a href="post-job.html"><span class="mr-2">+</span> Post a Job</a></li>
              <li class="d-lg-none"><a href="login.php">Log In</a></li>
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
    <?php 
      $locationquery = "SELECT * FROM job_location";
      $locationresult = mysqli_query($connect,$locationquery);

      $jobID = $_GET['jobid'];
      $_SESSION["jobID"] = $jobID;
      $user_id = $_SESSION['User_ID'];
      $query = "SELECT * FROM users WHERE UserID = $user_id";
      $result = mysqli_query($connect,$query);
      $row = mysqli_fetch_assoc($result);

      $job_result = mysqli_query($connect, "SELECT job_post.*, companies.* FROM job_post
            INNER JOIN companies ON job_post.CompanyID = companies.CompanyID
            WHERE job_post.Job_Post_ID = '$jobID'");
      $job_row = mysqli_fetch_assoc($job_result);
      
      $question_query = "SELECT job_question.Job_Question_Name,job_question.Job_Question_ID
      FROM job_post_questions
      JOIN job_question ON job_post_questions.QuestionID = job_question.Job_Question_ID
      WHERE job_post_questions.JobID = $jobID;";
      // $question_query = "SELECT * FROM job_post_questions WHERE JobID = $jobID";
      $question_result = mysqli_query($connect,$question_query);
      
      $career_query = "SELECT * FROM career WHERE UserID = $user_id";
      $career_result = mysqli_query($connect,$career_query);

      $education_query = "SELECT * FROM education WHERE UserID = $user_id";
      $education_result = mysqli_query($connect,$education_query);
    ?>
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Applying for</h1>
          </div>
        </div>
      </div>
    </section>
    
    <div class="container-fluid" style="background-color:#F6F2F1;">
	<div class="row justify-content-center">
		<div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3" style="border-radius:20px;width:1000px;margin-left:-150px;text-align: left;">
                <img src="images/job_logo_5.jpg" alt="Image" style="width:120px;border-radius: 25px;margin-bottom:50px;position:absolute;margin-left:100px;">
                <h2 id="heading" style="margin-left:270px;margin-top:20px;"><?php echo $job_row['Job_Post_Title'];?></h2>
                <p style="margin-left:270px;margin-top:-10px;"><?php echo $job_row['CompanyName'];?></p>
                <div data-toggle="modal" data-target="#job_description">
                <p aria-hidden="true" style="margin-left:270px; text-decoration: underline; margin-top:-20px; cursor: pointer;" onclick="hideOverlay()">View job description</p>
                </div>
                
                <form id="msform" method="post" enctype="multipart/form-data">
                    <!-- progressbar -->
                    <ul id="progressbar" style="margin-top:30px;">
                        <li class="active" id="account"><strong>Choose documents</strong></li>
                        <li id="personal"><strong>Answer employer questions</strong></li>
                        <li id="payment"><strong></strong>Review and submit</li>
                        <li id="confirm"><strong></strong></li>
                    </ul>
                    <div class="progress">
                    	<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                	</div>
                    <br>
                    <!-- fieldsets -->
                    <fieldset>
                    <div class="row">
               <div class="col-lg-12 mb-4"  style="margin-left:100px;"id="profile-section">
                <div class="block__87154 bg-secondary" style="width:700px;">
                <blockquote>
                  <div class="block__91147 d-flex align-items-start" style="margin-bottom:20px;">
                  <div class="edit-container" data-toggle="modal" data-target="#modal-profile">
                  <i class="icon-copy fa fa-edit" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit profile" data-target="#modal-profile"style="position:absolute;margin-left:620px;margin-top:-20px;font-size:26px;cursor: -webkit-grab; cursor: grab;color:white;"onclick="hideOverlay()"></i>
                  </div>
                  <div>
                  
                    <h1 class="text-white"><?php echo $row['FirstName'];?>&nbsp<?php echo $row['LastName'];?></h3>
                  </div>
                </div>
                <div class="block__91147 d-flex align-items-start">
                <span class="text-white" style="size:30px;"><i class="icon-copy dw dw-email"></i><strong style="margin-left:12px;margin-right:28px;"><?php echo $row["Email"]; ?></strong></span>
                </div>
                <div class="block__91147 d-flex align-items-start">
                <span class="text-white"><span class="icon-room"></span><strong style="margin-left:12px;margin-right:28px;"><?php echo $row['Location'];?></strong></span>
                </div>
                <div class="block__91147 d-flex align-items-start">
                <span class="text-white"><i class="icon-copy fa fa-phone" aria-hidden="true"></i><strong style="margin-left:12px;margin-right:28px;">60-<?php echo $row["Phone"]; ?></strong></span>
                </div>
                
                <!-- <p><button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid white;color:white;margin-top:40px;" data-toggle="modal" data-target="#modal-profile" data-toggle-class="modal-open-aside" onclick="hideOverlay()">Edit</button></p> -->
                </blockquote>
              </div>
            </div>
            </div>
            <div class="row" style="margin-top:40px; margin-left:50px;">
              <h3>Resumé</h3>
            </div>
            <div class="row">
              <!--Select resume -->
                <div class="col-md-6 col-sm-12" style="position: relative; margin-left: 50px; margin-top: 20px;text-align: left;">
                    <div class="custom-control custom-radio mb-3" style="font-size: 20px;">
                        <input type="radio" id="resumeSelect" name="resumeRadio" class="custom-control-input" value="selectResume">
                        <label class="custom-control-label" for="resumeSelect">Upload a resumé</label>
                    </div>
                    <div class="custom-file"id="resumeSelectOptions"style="display:none;margin-top:-10px;margin-left:20px;margin-bottom:30px;width: 700px;">
                            <input type="file" class="custom-file-input" id="file_resume_select" name="file_resume_select" accept=".pdf" onchange="updateFileName()" style="">
                            <label class="custom-file-label" for="file_cover_select">Choose file</label>
                        </div>
                    <!-- Default reume -->
                    <?php
                      if(!empty($row['Resume_Path']))
                      {
                        ?>
                        <div class="custom-control custom-radio mb-3" style="font-size: 20px;">
                              <input type="radio" id="resumeDefault" name="resumeRadio" class="custom-control-input" value="defaultResume">
                              <label class="custom-control-label" for="resumeDefault">Default resumé</label>
                          </div>
                        <?php
                      }
                      else{
                        ?>
                        <div class="custom-control custom-radio mb-3" style="font-size: 20px;">
                              <input type="radio" id="resumeDefault" name="resumeRadio" class="custom-control-input" value="defaultResume" disabled>
                              <label class="custom-control-label" for="resumeDefault">Default resumé</label>
                          </div>
                        <?php
                      }
                    ?>
                    <div class="custom-file" id="resumeDefaultOptions" style="display:none;margin-top:-10px;margin-left:20px;margin-bottom:20px;width: 700px;">
                        <input type="file" class="custom-file-input" id="file_resume_select" name="file_resume_select" accept=".pdf" onchange="updateFileName()" disabled>
                        <label class="custom-file-label" for="file_cover_select"><?php echo str_replace('resume/', '', $row['Resume_Path']); ?></label>
                    </div>
                    <div class="custom-control custom-radio mb-3" style="font-size: 20px;">
                        <input type="radio" id="resumeNone" name="resumeRadio" class="custom-control-input" value="noneResume">
                        <label class="custom-control-label" for="resumeNone">Don't include a resumé</label>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:40px; margin-left:50px;">
              <h3>Cover Letter</h3>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12" style="position: relative; margin-left: 50px; margin-top: 20px;text-align: left;">
                    <div class="custom-control custom-radio mb-3" style="font-size: 20px;">
                        <input type="radio" id="coverSelect" name="coverRadio" class="custom-control-input" value="selectCover">
                        <label class="custom-control-label" for="coverSelect">Upload a cover letter</label>
                    </div>
                    <div class="custom-file"id="coverSelectOptions"style="display:none;margin-top:-10px;margin-left:20px;margin-bottom:20px;width: 700px;">
                            <input type="file" class="custom-file-input" id="file_cover_select" name="file_cover_select" accept=".pdf" onchange="updateCoverName()" style="">
                            <label class="custom-file-label" for="file_cover_select">Choose file</label>
                        </div>
                    <div class="custom-control custom-radio mb-3" style="font-size: 20px;">
                        <input type="radio" id="coverNone" name="coverRadio" class="custom-control-input" value="noneCover">
                        <label class="custom-control-label" for="coverNone">Don't include a cover letter</label>
                    </div>
                </div>
            </div>
            <input type="button" name="next" class="next action-button" style="margin-right:20px;border-radius:0.5em;background-color:#4CBF72;" value="Next"/>
             </fieldset>
             <!-- Step 2 : Question -->
                    <fieldset>
                    <div class="form-card" style="margin-top:30px;">
                    <h3 class="h3"style="margin-left:30px;margin-top:-10px;">Employer questions</h3>
                    <?php
                    if(mysqli_num_rows($question_result) > 0) {
                      $questionIDs = [];
                      $questionCount = 1;
                      while ($question_row = mysqli_fetch_assoc($question_result)) {
                        $questionID = $question_row['Job_Question_ID'];
                        $option_query = "SELECT * FROM job_question_option WHERE Job_Question_ID = '$questionID'";
                        $option_result = mysqli_query($connect, $option_query);
                        ?>
                        <label class="fieldlabels" style="margin-left:20px;font-size:20px;margin-top:20px;color:black;">Q<?php echo $questionCount;?>. <?php echo $question_row["Job_Question_Name"];?></label>
                        <?php
                        $questionIDs[] = $questionID;
                        $questionAns[] = 0;
                        while ($option_row = mysqli_fetch_assoc($option_result)) {
                          $optionID = $option_row['Job_Question_Option_ID'];
                          ?>
                          <div class="custom-control custom-radio mb-3" style="font-size: 20px;margin-left:25px;">
                            <!-- 给每个单选框添加class属性和value属性 -->
                            <input type="radio" id="q<?php echo $questionID;?>_option<?php echo $optionID;?>" name="q<?php echo $questionID;?>" class="custom-control-input question-option" value="<?php echo $optionID;?>">
                            <label class="custom-control-label" for="q<?php echo $questionID;?>_option<?php echo $optionID;?>"><?php echo $option_row['Job_Question_Option_Name'];?></label>
                          </div>
                          <?php
                        }
                        $questionCount++;
                        ?>
                        <div class="error_message" id="error_q<?php echo $questionID;?>" style="color:red;font-size:16px;margin-left:38px;margin-top:-15px;position:absolute;"></div>
                        <?php
                      }
                    }
                    ?>
                  </div>
                        <input type="button" name="next" style="margin-right:20px;border-radius:0.5em;background-color:#4CBF72;" class="next action-button" value="Next"/>
                        <input type="button" name="previous" style="margin-right:20px;border-radius:0.5em;" class="previous action-button-previous" value="Previous"/>
                    </fieldset>

                    <fieldset>
                      <div style="size:16px;color:#00008B;">
                        <i class="icon-copy fi-info" style="font-size:20px;margin-right:5px;"></i>Your Profile is part of your application. Make sure it's up-to-date.
                      </div>
          <div class="form-card"> 
            <!-- Summary -->
            <div class="col-lg-12 mb-4" style="margin-top:40px;margin-left:100px;position:relative;"  id="summary-section">
            <h3>Profile Summary</h3>
          <?php
            if(isset($row['Profile_Description']) && !empty($row['Profile_Description']))
            {
              ?>
              <div class="col-lg-8 mb-4" style="margin-top:10px;margin-left:-10px;">
            <div class="block__87154">
              <blockquote>
              <div class="edit-container" data-toggle="modal" data-target="#modal-summary">
              <i class="icon-copy fa fa-edit" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit summary" data-target="#modal-summary"style="position:absolute;margin-left:540px;margin-top:-20px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
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
            <button type="button" class="btn btn-outline-secondary" id="btn" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-dismiss="modal"data-target="#modal-summary" data-toggle-class="modal-open-aside">Add Summary</button>
          </div>
        <?php
        }
        ?>
            <!-- career history -->
    <div class="col-lg-12 mb-4" style="margin-top:40px;margin-left:100px;" id="career-section">
    <h3>Career History</h3>
    <?php
    if (mysqli_num_rows($career_result) > 0) {
        ?>
        <div class="col-lg-8 mb-4" style="margin-top:10px;margin-left:-10px;width:1000px;">
            <?php
            while ($career_row = mysqli_fetch_assoc($career_result)) {
                ?>
                <div class="block__87154">
                    <blockquote>
                    <div class="editCareerBtn delete-container" data-toggle="modal" data-career-id="<?=$career_row['CareerID'];?>" onclick="deleteCareer(event)">
                        <i class="icon-copy fa fa-trash-o" class="deleteCareerBtn" data-toggle="tooltip" title="Delete <?php echo $career_row["JobTitle"]; ?>" aria-hidden="true" style="position:absolute;margin-left:485px;margin-top:-21px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
                   </div>
                    <div class="editCareerBtn edit-container" data-toggle="modal" data-career-id="<?=$career_row['CareerID'];?>" onclick="editCareer(event)">
                        <i class="icon-copy fa fa-edit" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit <?php echo $career_row["JobTitle"]; ?>" style="position:absolute;margin-left:540px;margin-top:-20px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
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
                         <!-- <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-career" data-toggle-class="modal-open-aside" onclick="hideOverlay()">Add role</button> -->
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
          <div class="col-lg-12 mb-4" style="margin-top:40px;margin-left:100px;"id="education-section">
            <h3>Education</h3>
            <?php 
              if (mysqli_num_rows($education_result) > 0) {
                $education_row = mysqli_fetch_assoc($education_result);
                ?>
                <div class="col-lg-8 mb-4" style="margin-top:10px;margin-left:-10px;">
                        <div class="block__87154">
                            <blockquote>
                            <div class="editCareerBtn delete-container" data-toggle="modal" onclick="deleteEducation()">
                                <i class="icon-copy fa fa-trash-o" class="deleteEducationBtn" data-toggle="tooltip" title="Delete" aria-hidden="true" style="position:absolute;margin-left:485px;margin-top:-21px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
                           </div>
                            <div class="editCareerBtn edit-container" data-toggle="modal" data-education-id="<?=$education_row['EducationID'];?>" onclick="editEducation(event)">
                                <i class="icon-copy fa fa-edit" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit" style="position:absolute;margin-left:540px;margin-top:-20px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
                                </div>
                                <h5><?php echo $education_row["Institution"]; ?></h5>
                                <p><?php echo $education_row["Course_or_Qualification"]; ?></p>
                                 <p style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">"<?php echo $education_row["Course_Highlight"]; ?> "</p>
                                 <!-- <button type="button" class="btn btn-outline-secondary" style="font-size: 20px;border: 2px solid" data-toggle="modal" data-target="#modal-career" data-toggle-class="modal-open-aside" onclick="hideOverlay()">Add role</button> -->
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
                        </div>
                        <input type="button" name="submit_application" id="submit_application" style="margin-right:20px;border-radius:0.5em;background-color:#4CBF72;" class="next action-button" value="Submit">
                        <input type="button" name="previous" style="margin-right:20px;border-radius:0.5em;"class="previous action-button-previous" value="Previous"/>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                        	<!-- <div class="row">
                        		<div class="col-7">
                            		<h2 class="fs-title">Finish:</h2>
                            	</div>
                            	<div class="col-5">
                            		<h2 class="steps">Step 4 - 4</h2>
                            	</div>
                            </div> -->
                            <br><br>
                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-3">
                                    <img src="https://i.imgur.com/GwStPmg.png" class="fit-image">
                                </div>
                            </div>
                            <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
	</div>
</div>
    
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
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | GEC JOB FACT
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></small></p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Job Description Modal -->
   <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-sm-6">
          <div id="job_description" class="modal fade" data-backdrop="false" style="backdrop-filter: blur(2px);">
            <div class="modal-dialog modal-right w-xl">
              <div class="modal-content h-100 no-radius">
                <div class="modal-header">
                  <!-- <div class="modal-title text-md">Add personal summary</div> -->
                      <button class="close" data-dismiss="modal"onclick="hideOverlay()">&times;</button>
                  </div>
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <form action="" method="post" id="model-summary" autocomplete="off">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Job Description</h3>
                        <div style="position: relative;">
                          <div class="form-group">
                          <h5 style="margin-top:30px;font-weight: bold;"><?php echo $job_row["Job_Post_Title"]; ?></h5>
                          <h6 style="margin-top:10px;"><?php echo $job_row['CompanyName'];?></h6>
                          <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Job Description</h3>
                          <?php
                            $DescriptionText = $job_row['Job_Post_Description'];
                            $DescriptionArray = explode("\n", $DescriptionText);
                            foreach ($DescriptionArray as $description) {
                                if (!empty(trim($description))) {
                                  echo '<p>' . trim($description) . '</p>';
                                }
                            }
                            ?>
													</div>
                          <div class="form-group">
                          <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-rocket mr-3"></span>Responsibilities</h3>
                          <ul id="responsibilitiesList" class="list-unstyled m-0 p-0">
                              <?php
                              $responsibilitiesText = $job_row['Job_Post_Responsibilities'];
                              $responsibilitiesArray = explode("\n", $responsibilitiesText);
                              foreach ($responsibilitiesArray as $responsibility) {
                                  if (!empty(trim($responsibility))) {
                                    echo '<li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>' . trim($responsibility) . '</span></li>';
                                  }
                              }
                              ?>
                          </ul>
													</div>
                          <div class="form-group">
                          <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-turned_in mr-3"></span>Other Benifits</h3>
                          <ul class="list-unstyled m-0 p-0">
                          <?php
                            $CompanyBenefitsText = $job_row['CompanyBenefits'];
                            $CompanyBenefitsArray = explode("\n", $CompanyBenefitsText);
                            foreach ($CompanyBenefitsArray as $CompanyBenefits) {
                                if (!empty(trim($CompanyBenefits))) {
                                  echo '<li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>' . trim($CompanyBenefits) . '</span></li>';
                                }
                            }
                            ?>
                          </ul>
													</div>
                          </div>
                       </div>
                    </div>
                </form>
                </div>
              </div>          
           </div>
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
    <!-- Handle ajax apply job -->
    <script type="text/javascript">
    document.getElementById('submit_application').onclick = function() {
      var questionIDs = <?php echo json_encode($questionIDs); ?>;
      submitApplication(questionIDs);
    };
    </script>
    <!-- end -->
     <script>
        $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
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
    function updateFileName() {
        var fileInput = document.getElementById("file_resume_select");
        if (fileInput.files.length > 0) {
            // 获取选择的文件名并更新custom-file-label显示文件名
            var fileName = fileInput.files[0].name;
            var customFileLabel = document.querySelector('#resumeSelectOptions .custom-file-label');
            customFileLabel.textContent = fileName;
        } else {
            // 如果没有选择文件，重置custom-file-label文本
            var customFileLabel = document.querySelector('#resumeSelectOptions .custom-file-label');
            customFileLabel.textContent = "Choose file";
        }
    }
</script>
<script>
    function updateCoverName() {
      console.log("cover");
        var fileInput = document.getElementById("file_cover_select");

        if (fileInput.files.length > 0) {
            // 获取选择的文件名并更新custom-file-label显示文件名
            var fileName = fileInput.files[0].name;
            var customFileLabel = document.querySelector('#coverSelectOptions .custom-file-label');
            customFileLabel.textContent = fileName;
        } else {
            // 如果没有选择文件，重置custom-file-label文本
            var customFileLabel = document.querySelector('#coverSelectOptions .custom-file-label');
            customFileLabel.textContent = "Choose file";
        }
    }</script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    // 获取单选按钮和上传选项的引用
    var resumeDefaultRadio = document.getElementById("resumeDefault");
    var resumeSelectRadio = document.getElementById("resumeSelect");
    var resumeNoneRadio = document.getElementById("resumeNone");
    var resumeDefaultOptions = document.getElementById("resumeDefaultOptions");
    var resumeSelectOptions = document.getElementById("resumeSelectOptions");

    var coverNoneRadio = document.getElementById("coverNone");
    var coverSelectRadio = document.getElementById("coverSelect");
    var coverSelectOptions = document.getElementById("coverSelectOptions");

    // event listerner
    resumeDefaultRadio.addEventListener("change", function () {
        // 默认简历单选按钮被选中，则显示上传选项，关闭选择简历的上传选项
        resumeDefaultOptions.style.display = resumeDefaultRadio.checked ? "block" : "none";
        resumeSelectOptions.style.display = "none";
    });

    resumeSelectRadio.addEventListener("change", function () {
        // 选择简历单选按钮被选中，显示上传选项，关闭默认简历的上传选项
        resumeSelectOptions.style.display = resumeSelectRadio.checked ? "block" : "none";
        resumeDefaultOptions.style.display = "none";
    });

    resumeNoneRadio.addEventListener("change", function () {
        // 选择简历单选按钮被选中，显示上传选项，关闭默认简历的上传选项
        resumeDefaultOptions.style.display = "none";
        resumeSelectOptions.style.display = "none";
    });

    coverSelectRadio.addEventListener("change", function () {
        // 选择 cover letter 单选按钮被选中，则显示上传选项
        coverSelectOptions.style.display = coverSelectRadio.checked ? "block" : "none";
    });
    coverNoneRadio.addEventListener("change", function () {
        // 选择 "Don't include a cover letter" 单选按钮被选中，则hide掉 cover letter 的上传选项
        coverSelectOptions.style.display = "none";
    });
});
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
        $(document).ready(function(){
    
        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;
        
        setProgressBar(current);
        // console.log("current : "+current);
        $(".next").click(function(){
          console.log("current "+current);
          var shouldContinue = false;
          if (current === 1) {
            console.log(1);
          shouldContinue = validateStep(current);
          } else if (current === 2) {
            console.log(2);
            var questionIDs = <?php echo json_encode($questionIDs); ?>;
            shouldContinue = validateStepTwo(current, questionIDs);
          }

        if (shouldContinue) {
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            // Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            // Show the next fieldset
            next_fs.show(); 
            // Hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    // For making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({'opacity': opacity});
                }, 
                duration: 500
            });

            setProgressBar(++current);
        }
    });
        
        $(".previous").click(function(){
            
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            
            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            
            //show the previous fieldset
            previous_fs.show();
        
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;
        
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({'opacity': opacity});
                }, 
                duration: 500
            });
            setProgressBar(--current);
        });
        
        function setProgressBar(curStep){
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
            .css("width",percent+"%")   
        }
        
        $(".submit").click(function(){
            return false;
        })
            
        });
</script>
   
     
  </body>
</html>