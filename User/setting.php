<?php
  session_start();
  require 'validation/veridation_setting.php';
  require 'validation/veridationChangePassword.php';
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
    <link rel="stylesheet" href="css/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" href="css/style.css">   
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css"> 
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
  </head>
  <body id="top">
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
          <div class="site-logo col-6"><a href="index.php">GEC  JOBFACT</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php" class="nav-link">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li>
                <a href="job-listings.php">Job Listings</a>
              </li>
              <li><a href="contact.php">Contact</a></li>
              <!-- <li class="d-lg-none"><a href="post-job.html"><span class="mr-2">+</span> Post a Job</a></li>
              <li class="d-lg-none"><a href="login.php">Log In</a></li> -->
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
            <h1 class="text-white font-weight-bold">Setting</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php">Home</a> <span class="mx-2 slash"></span>
              <span class="text-white"><strong>Setting</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="next-section">
      <div class="container">
      <?php 
      $user_id = $_SESSION['User_ID'];
      $query = "SELECT * FROM users WHERE UserID = $user_id";
      $result = mysqli_query($connect,$query);
      $row = mysqli_fetch_assoc($result);
    ?>
             <!-- Account -->
             <h3>Account details</h3>
            <div class="col-lg-12 mb-4" id="email-section" style="margin-top:40px;">
              <div class="col-lg-8 mb-4" style="margin-top:10px;margin-left:-10px;">
            <div class="block__87154">
              <blockquote>
              <div class="edit-container" data-toggle="modal" data-target="#modal-email">
              <i class="icon-copy fa fa-edit" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Change email" data-target="#modal-email"style="position:absolute;margin-left:580px;margin-top:-20px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
              </div>
              <h3>Email</h3>
              <p style="white-space: pre-line;margin-top:30px;"><?php echo $row["Email"]; ?></p>
              </blockquote>
            </div>
          </div>
          </div>
            <div class="col-lg-12 mb-4" id="email-section" style="margin-top:40px;">
              <div class="col-lg-8 mb-4" style="margin-top:10px;margin-left:-10px;">
            <div class="block__87154">
              <blockquote>
              <div class="edit-container" data-toggle="modal" data-target="#modal-password">
              <i class="icon-copy fa fa-edit" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Change email" data-target="#modal-password"style="position:absolute;margin-left:580px;margin-top:-20px;font-size:26px;cursor: -webkit-grab; cursor: grab;"></i>
              </div>
              <h3>Password</h3>
              </blockquote>
            </div>
          </div>
          </div>
    <!-- Password Modal -->
   <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-sm-6">
          <div id="modal-password" class="modal fade" data-backdrop="false" style="backdrop-filter: blur(2px);">
            <div class="modal-dialog modal-right w-xl">
              <div class="modal-content h-100 no-radius">
                <div class="modal-header">
                      <button class="close" data-dismiss="modal">&times;</button>
                  </div>
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <form  method="post" id="modal-password">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Change password</h3>
                          <h5 style="margin-top:30px;display: inline-block;">Current password</h5>
                          <div class="input-group custom">
                          <input type="password" class="form-control form-control-lg" id="current_password">
                          <div class="input-group-append custom">
                        <span class="input-group-text" ><i class="dw dw-eye"style="cursor:pointer;"></i></span>
                      </div>
                    </div>
                      <h5 style="margin-top:30px;display: inline-block;">Enter new password</h5>
                      <div class="input-group custom">
                          <input type="password" class="form-control form-control-lg" id="new_password">
                          <div class="input-group-append custom">
                        <span class="input-group-text" ><i class="dw dw-eye"style="cursor:pointer;"></i></span>
                      </div>
                      </div>
                        <h5 style="margin-top:30px;display: inline-block;">Confirm password</h5>
                        <div class="input-group custom">
                          <input type="password" class="form-control form-control-lg" id="cf_password">
                          <div class="input-group-append custom">
                        <span class="input-group-text" ><i class="dw dw-eye"style="cursor:pointer;"></i></span>
                      </div>
                    </div>
                    <div class="modal-footer" style="margin-top:100px;">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save" id="password_submitbtns" name="password_submitbtns">
                  </form>
                 </div>
                 </div>
                </div>
              </div>          
           </div>
          </div>
         </div>
        </div>
          <!-- Modal End-->
          <!-- Email Modal -->
   <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-sm-6">
          <div id="modal-email" class="modal fade" data-backdrop="false" style="backdrop-filter: blur(2px);">
            <div class="modal-dialog modal-right w-xl">
              <div class="modal-content h-100 no-radius">
                <div class="modal-header">
                      <button class="close" data-dismiss="modal">&times;</button>
                  </div>
                    <div class="modal-body" style="text-align:left;">
                       <div class="p-4 text-left">
                        <form  method="post" id="modal-email">
                        <h3 style="margin-top:-45px;margin-bottom:70px;">Change email</h3>
                          <p>Email is used to sign in to Jobstreet and to be contacted by employers.</p>
                        <h5 style="margin-top:30px;display: inline-block;">Email address</h5>
                        <div class="form-group">
                          <input type="text" class="form-control" id="new_email" style="margin-top:10px;border-color:#787785;">
                        </div>
                        <h5 style="margin-top:30px;display: inline-block;">Confirm email address</h5>
                        <div class="form-group">
                          <input type="text" class="form-control"  id="c_new_email" style="margin-top:10px;border-color:#787785;">
                        </div>
                        <h5 style="margin-top:30px;display: inline-block;">Password</h5>
                        <div class="input-group custom">
                          <input type="password" class="form-control form-control-lg" id="cf_ps">
                          <div class="input-group-append custom">
                        <span class="input-group-text" ><i class="dw dw-eye"style="cursor:pointer;"></i></span>
                      </div>
                    </div>
                    <div class="modal-footer" style="margin-top:60px;">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save" id="email_submitbtns" name="email_submitbtns">
                  </form>
                 </div>
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
    $(document).ready(function () {
        // 监听眼睛图标的点击事件
        $('.input-group-append i').on('click', function () {
            var passwordInput = $(this).closest('.input-group').find('input');
            
            // 切换密码输入框的type属性
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
            } else {
                passwordInput.attr('type', 'password');
            }
        });
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
  </body>
</html>