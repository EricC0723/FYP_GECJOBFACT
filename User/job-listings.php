<?php
  session_start();
  include("C:/xampp/htdocs/FYP/dataconnection.php");
  if (isset($_GET["searchbtn"])) {
    // 从表单中获取搜索条件，并保存到会话变量中
    $_SESSION["searchjob"] = $_GET["searchjob"];
    $_SESSION["searchlocation"] = $_GET["searchlocation"];
    $_SESSION["searchtype"] = $_GET["searchtype"];
    $_SESSION["searchcategory"] = $_GET["searchcategory"];
    $_SESSION["searchminimum"] = $_GET["searchminimum"];
    $searchJob = $_SESSION["searchjob"];
    $searchLocation = $_SESSION["searchlocation"];
    $searchType = $_SESSION["searchtype"] ;
    $searchcategory = $_SESSION["searchcategory"];
    $searchminimum = $_SESSION["searchminimum"] ;
  }
?>
<!doctype html>
<html lang="en">
  <head>
<title>GEC JOB FACTS</title>    <meta charset="utf-8">
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
    <link rel="stylesheet" href="css/style.css">    
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
          <div class="site-logo col-6"><a href="index.php">GEC  JOBFACT</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php" class="nav-link">Home</a></li>
              <li><a href="about.php">About</a></li>
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
                  <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" style="color:white;border: 2px solid #787785;border-radius: 4px;padding: 5px;background-color:#787785;margin-left:30px;">
                    <span class="user-name"><?php echo $_SESSION['First_Name'];?></span>
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
                <a href="login.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block" style="margin-left: 30px; color: white; margin-top: -5px; max-width: 150px; white-space: nowrap;"><span class="mr-2 icon-lock_outline" ></span>Log In</a>
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
      $query = "SELECT * FROM job_location";
      $result = mysqli_query($connect,$query);
      $category_query = "SELECT * FROM main_category";
      $category_result = mysqli_query($connect,$category_query);
    ?>
  <section class="section-hero home-section overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
              <h1 class="text-white font-weight-bold">The Easiest Way To Get Your Dream Job</h1>
            </div>
            <form method="get" class="search-jobs-form" action="job-listings.php">
              <div class="row mb-5">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <input type="text" class="form-control form-control-lg" placeholder="Job title, Company..." name="searchjob" value="<?php echo isset($_SESSION['searchjob']) ? $_SESSION['searchjob'] : ''; ?>">
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <select class="selectpicker" data-size="3" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Region" name="searchlocation" id="searchlocation">
                  <?php 
                    $selectedRegion = isset($_SESSION['searchlocation']) ? $_SESSION['searchlocation'] : '';
                    if(mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        $optionValue = $row["Job_Location_Name"];
                        $selected = ($optionValue == $selectedRegion) ? 'selected' : ''; // 如果是保存的区域，设置为选中状态
                        echo "<option value='$optionValue' $selected>$optionValue</option>";
                      }
                    }
                  ?>
                  </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <?php 
                    $selectedType = isset($_SESSION['searchtype']) ? $_SESSION['searchtype'] : '';
                    $jobTypes = array("Part Time", "Full Time", "Internship", "Contract");

                    echo '<select class="selectpicker" data-size="3" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Job Type" name="searchtype" id="searchtype">';

                    foreach($jobTypes as $value => $type) {
                      $selected = ($value + 1 == $selectedType) ? 'selected' : '';
                      echo "<option value='" . ($value + 1) . "' $selected>$type</option>";
                    }

                    echo '</select>';
                  ?>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search" name="searchbtn"><span class="icon-search icon mr-2"></span>Search Job</button>
                </div>
              </div>
              <div class="row mb-5">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
              <select class="selectpicker" data-size="3" data-style="btn-white btn-lg" data-width="100%" title="Minimum salary" name="searchminimum">
                <?php
                $selectedMinimum = isset($_SESSION['searchminimum']) ? $_SESSION['searchminimum'] : '';
                $salaryOptions = array(1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000);

                foreach ($salaryOptions as $salary) {
                  $selected = ($salary == $selectedMinimum) ? 'selected' : '';
                  echo "<option value='$salary' $selected>$salary</option>";
                }
                ?>
              </select>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
              <select class="selectpicker" data-size="3" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Category" name="searchcategory">
                <?php
                $selectedcategory = isset($_SESSION['searchcategory']) ? $_SESSION['searchcategory'] : '';
                if (mysqli_num_rows($category_result) > 0) {
                  while ($category_row = mysqli_fetch_assoc($category_result)) {
                    $categoryValue = $category_row["Main_Category_Name"];
                    $selected = ($categoryValue == $selectedcategory) ? 'selected' : '';
                    echo "<option value='$categoryValue' $selected>{$category_row["Main_Category_Name"]}</option>";
                  }
                }
                ?>
              </select>
            </div>
            <button type="button" style="margin-top:50px;"class="btn btn-primary btn-lg btn-block text-white btn-search" onclick="resetFilters()">Reset Filters</button>
          </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <?php 
      if (!isset($_SESSION['User_ID'])) {
        ?>
        <section class="py-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
              <div class="container">
                <div class="row align-items-center">
                  <div class="col-md-8">
                    <h2 class="text-white">Not possess an account?</h2>
                    <p class="mb-0 text-white lead">Your dream job is just a click away.  Sign up now!</p>
                  </div>
                  <div class="col-md-3 ml-auto">
                    <a href="RegisterUser.php" class="btn btn-warning btn-block btn-lg">Sign Up</a>
                  </div>
                </div>
              </div>
            </section>
            <?php }?>
    
    
    <section class="site-section" id="next">
      <div class="container">
        <h2 class="section-title mb-2" style="text-align:center;">Search Result</h2>
        <ul class="job-listings mb-5">
          <?php
          include("C:/xampp/htdocs/FYP/dataconnection.php");
          
          if (isset($_GET["page"])) {
            if (isset($_SESSION["searchjob"])) {
              // exist
              $searchJob = $_SESSION["searchjob"];
          } else {
              $searchJob = ""; // no exist , set default
          }
          
          if (isset($_SESSION["searchlocation"])) {
              $searchLocation = $_SESSION["searchlocation"];
          } else {
              $searchLocation = "";
          }
          if (isset($_SESSION["searchtype"])) {
              $searchType = $_SESSION["searchtype"];
          } else {
              $searchType = "";
          }
          if (isset($_SESSION["searchcategory"])) {
            $searchcategory = $_SESSION["searchcategory"];
        } else {
            $searchcategory = "";
        }
        if (isset($_SESSION["searchminimum"])) {
            $searchminimum = $_SESSION["searchminimum"];
        } else {
            $searchminimum = "";
        }
            }
            $query = "SELECT * FROM job_post WHERE job_status IN ('Active')";

            // search logic
            if (!empty($searchJob)) {
                $query .= " AND Job_Post_Title LIKE '%$searchJob%'";
            }
            if (!empty($searchLocation)) {
                $query .= " AND Job_Post_Location LIKE '%$searchLocation%'";
            }
            if (!empty($searchType)) {
                $query .= " AND Job_Post_Type LIKE '%$searchType%'";
            }
            if (!empty($searchcategory)) {
                $query .= " AND Main_Category_Name = '$searchcategory'";
            }
            if (!empty($searchminimum)) {
                $query .= " AND Job_Post_MinSalary >= $searchminimum";
            }
            
            $query .= " ORDER BY AdStartDate DESC";
            
            if (!isset ($_GET['page']) ) {
                $page = 1;  
            } else {  
                $page = $_GET['page'];  
            }
            $results_per_page = 10;
            // 获取总的结果数量
            $all_result = mysqli_query($connect,$query);
            // echo(mysqli_num_rows($all_result));
            $total_records = mysqli_num_rows($all_result);
            // 计算总的页面数量
            $total_pages = ceil($total_records / $results_per_page);
            $results_per_page = 10;  
            $page_first_result = ($page - 1) * $results_per_page;

            $query .= " LIMIT " . $page_first_result . "," . $results_per_page;

            $result = mysqli_query($connect, $query);
            $JobType = "";
          
              while($row = mysqli_fetch_assoc($result))
              {
              ?>	
                <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                <a href="job-single.php?view&jobid=<?php echo $row["Job_Post_ID"];?>" class="job-link"></a>
                  <div class="job-listing-logo">
                  <img src="<?php echo $row["Job_Logo_Url"];?>" alt="compny logo" class="img-fluid" style="width:100px;height:auto;margin-left:25px;">
                  </div>

                  <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                    <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                      <h2><?php echo $row["Job_Post_Title"];?></h2>
                      <strong style="margin-top:10px;margin-bottom:100px;"><?php echo $row["Main_Category_Name"];?> ( <?php echo $row["Sub_Category_Name"];?> )</strong>
                    </div>
                    <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                      <span class="icon-room"></span> <?php echo $row["Job_Post_Location"];?><br>
                      <span class="icon-money"></span> RM<?php echo $row["Job_Post_MinSalary"];?> - RM<?php echo $row["Job_Post_MaxSalary"];?>
                    </div>
                    <div class="job-listing-meta">
                    <?php
                        switch($row["Job_Post_Type"])
                        {
                          case "1" :  $badgeClass = "badge-danger";$JobType = "Part Time";break;
                          case "2" :  $badgeClass = "badge-primary";$JobType = "Full Time";break;
                          case "3" :  $badgeClass = "badge-info";$JobType = "Internship";break;
                          case "4" :  $badgeClass = "badge-secondary";$JobType = "Contract";break;
                          default: $badgeClass = "badge-secondary";$JobType = "";break;
                        }
                      ?>
                      <span class="badge <?php echo $badgeClass; ?>"><?php echo $JobType; ?></span><br>
                      <?php
                      date_default_timezone_set('Asia/Kuala_Lumpur');

                      $adStartDate = $row["AdStartDate"];
                      $timestamp = strtotime($adStartDate);
                      $currentTimestamp = time();
                      $timeDifference = $currentTimestamp - $timestamp;

                      $minutesAgo = round($timeDifference / 60);
                      $hoursAgo = round($timeDifference / 3600);
                      $daysAgo = round($timeDifference / (3600 * 24));

                      if ($minutesAgo < 60) {
                          echo $minutesAgo . 'm ago';
                      } elseif ($hoursAgo < 24) {
                          echo $hoursAgo . 'h ago';
                      } else {
                          echo $daysAgo . 'd ago';
                      }
                      ?>
                    </div>
                  </div>
                </li>
              <?php
              }
              ?>
        </ul>
        <div class="row mb-5 justify-content-center">
        <div class="col-md-7 text-center">
        <?php 
          if($total_records == 0)
          {   ?>
              <img src="images/searchNoFound.jpg" alt="No Result" class="img-fluid" style="height: 130px;width: 180px;">
              <h2 class="section-title mb-2">No matching search results</h2>
              <h6 class="section-title mb-2" style="font-size: 16px;margin-top:40px;">We couldn't find anything that matched your search.
              Try adjusting the filters or check for spelling errors.</h6>
              <?php
          }
          else{
        ?>
          </div>
        </div>
        <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
          <span>Showing <?php echo $page_first_result + 1; ?>-<?php echo min($page_first_result + $results_per_page, $total_records); ?> Of <?php echo $total_records; ?> Jobs</span>
          </div>
          <div class="col-md-6 text-center text-md-right">
            <div class="custom-pagination ml-auto">
            <?php
            $number_of_page = ceil($total_records / $results_per_page);
            // Check if $number_of_page is defined
            if (!isset($number_of_page)) {
                $number_of_page = 1; // Set a default value if not defined
            }
            $visible_pages = 3; //page number
            // count the number page show
            $start_page = max(1, $page - floor($visible_pages / 2));
            $end_page = min($number_of_page, $start_page + $visible_pages - 1);
            if ($page > 1) {
              echo "<a href='job-listings.php?page=" . ($page - 1) . "#joblist' class='prev'>Prev</a>";
            }
            ?>
              <!-- <a href="#" class="prev">Prev</a> -->
              <div class="d-inline-block">
                <?php
              for ($i = $start_page; $i <= $end_page; $i++) {
                if ($i == $page) {
                    echo "<a href='job-listings.php?page=" . $i . "#joblist' class='active'>" . $i . "</a>";
                } else {
                    echo "<a href='job-listings.php?page=" . $i . "#joblist'>" . $i . "</a>";
                }
            }
            ?>
              </div>
              <?php
              if ($page < $number_of_page) {
                echo "<a href='job-listings.php?page=" . ($page + 1) . "#joblist' class='next'>Next</a>";
            }
          }
            ?>

            </div>
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
    <script src="js/quill.min.js"></script>
    
    
    <script src="js/bootstrap-select.min.js"></script>
    
    <script src="js/custom.js"></script>
    <script>
function resetFilters() {
    // 清除文本框的值
    document.querySelector('input[name="searchjob"]').value = '';

    // 获取所有 select 元素
    var selectElements = document.querySelectorAll('.selectpicker');

    // 将所有选择框重置为默认选项
    selectElements.forEach(function(selectElement) {
        selectElement.selectedIndex = -1;
    });

    // 刷新 Bootstrap Select 插件
    $('.selectpicker').val('').selectpicker('refresh');
}
</script>
    <script>
  function checkLoginAndRedirect() {
    var isLoggedIn = <?php echo isset($_SESSION['User_ID']) ? 'true' : 'false'; ?>;

    if (!isLoggedIn) {
      // 用户未登录，显示警告并阻止链接跳转
      swal({
        title: "Access Restricted",
        text: "You need to login to view this content. Do you want to login now?",
        icon: "warning",
        buttons: ["No, cancel it!", "Yes, I want to login"],
        dangerMode: true,
    	}).then((result) => {
          if (!result) {
            return false;
          } else {
            location.replace("login.php");
          }
      });
    }
    else{
       return true;
    }
  }
  // 获取所有带有 class="job-link" 的链接元素
  var jobLinks = document.querySelectorAll('.job-link');

  // 为每个链接添加点击事件监听器
  jobLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
      // 在链接点击时执行检查登录函数
      if (!checkLoginAndRedirect()) {
        // 阻止默认的链接跳转行为
        event.preventDefault();
      }
    });
  });
</script>
   
     
  </body>
</html>