<?php	
require 'validation/veridation_user.php';
include("C:/xampp/htdocs/FYP/dataconnection.php");
$location_query = "SELECT * FROM job_location";
$location_result = mysqli_query($connect,$location_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Sign Up Form by Colorlib</title>

<!-- Font Icon -->
<link rel="stylesheet"
	href="fonts/material-icon/css/material-design-iconic-font.min.css">

<!-- Main css -->
<link rel="stylesheet" href="css/signup.css">
<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
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
		.input-group-append:hover i {
        cursor: pointer;
    }
</style>
</head>
<body>
<div id="loading">
        <div id="loading-spinner">
            <img src="images/loading.gif" alt="Loading Spinner">
        </div>
    </div>
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
			<a href="index.php"  style="color:black;font-weight: bold;">
					Home
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="Login.php" style="color:green;">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main">

		<!-- Sign up form -->
		<section class="signup">
			<div class="container">
				<div class="signup-content">
					<div class="signup-form">
						<h2 class="form-title">Sign up</h2>
					
						<form method="post" action="insert_dataUser.php" id="form" class="register-form"
							id="register-form">
							<h5 style="display: inline-block;">First Name</h5>
						<div class="form-group">
							<input class="form-control"name="FirstName" id="FirstName" placeholder="Enter first name" type="text">
						</div>
						<h5 style="display: inline-block;">Last Name</h5>
						<div class="form-group">
						<input type="text" placeholder="Enter last name"  name="LastName" id="LastName" class="form-control" value=""/>
						</div>
						<div class="row" style="position:center;">
                      <div class="col-md-3 col-sm-12">
					  	<input type="hidden" class="form-control" id="edit_userid" style="margin-top:10px;border-color:#787785;">
                        	<h5 style="display: inline-block;">Phone</h5>
                        	<div class="form-group">
                        		<input type="text" placeholder=""class="form-control" value="60"disabled/>
                        	</div>
                      </div>
						<div class="col-md-9 col-sm-12">
							<h5 style="display: inline-block;color:white;">1</h5>
							<div class="form-group">
								<input type="text" placeholder="Enter phone number" name="phone" id="phone"class="form-control" value=""/>
							</div>
						</div>
                    </div>
					<h5 style="display: inline-block;margin-top:30px;">Location</h5>
                    <select class="selectpicker form-control" data-size="5" data-width="100%" name="location" id="location"style="max-height:100px;">
                    <?php
                    if(mysqli_num_rows($location_result) > 0)
                    {
                      while($location_row = mysqli_fetch_assoc($location_result))
                      {
                    ?>
                     <option value="<?php echo $location_row["Job_Location_Name"];?>"><?php echo $location_row["Job_Location_Name"]; ?></option>
                    <?php 
                      }
                    }
                    ?>
                  </select>
						<h5 style="display: inline-block;margin-top:25px;">Email</h5>
						<div class="form-group">
						<input type="text" placeholder="Enter email"  name="email" id="email" class="form-control" value=""/>
						</div>
						<h5 style="display: inline-block;">Password</h5>
						<div class="form-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="New Password" name="password" id="password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-eye"></i></span>
								</div>
							</div>
						<h5 style="display: inline-block;">Comfirm password</h5>
						<div class="form-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="New Password" name="c_password" id="c_password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-eye"></i></span>
								</div>
							</div>
							<div class="form-group">
								<input type="checkbox" name="agree-term" id="agree-term"
									class="agree-term" /> <label for="agree-term"
									class="label-agree-term"><span><span></span></span>I
									agree all statements in <a href="term_of_service.php" class="term-service" target="_blank">Terms
										of service</a></label>
							</div>
							<div class="form-group form-button" style="color:green;">
								<input type="submit" name="signup" id="submitbtn"
									class="btn btn-success btn-lg btn-block" value="Register" />
							</div>
						</form>
					</div>
					<div class="signup-image">
						<figure>
							<img src="images/login-img1.avif" alt="sing up image" style="height:500px;width:500px;">
						</figure>
						<h3><a href="login.php" class="signup-image-link" style="color:grey;">Already have account?</a></h3>
					</div>
				</div>
			</div>
		</section>


	</div>
	<!-- JS -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
	<script src="vendors/scripts/datatable-setting.js"></script>
	<script>
    $(document).ready(function () {
        // 监听眼睛图标的点击事件
        $('.input-group-append i').on('click', function () {
            var passwordInput = $(this).closest('.form-group').find('input');
            
            // 切换密码输入框的type属性
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
            } else {
                passwordInput.attr('type', 'password');
            }
        });
    });
</script>
</body>

<!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>