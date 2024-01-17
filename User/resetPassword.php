<?php 
	session_start();
	include("C:/xampp/htdocs/FYP/dataconnection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	<style>
    .input-group-append:hover i {
        cursor: pointer;
    }
</style>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	<!-- <div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="vendors/images/logo.png" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="login.html" style="color:green;">Login</a></li>
				</ul>
			</div>
		</div>
	</div> -->
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="images/forget3.webp" alt="" style="margin-left:100px;">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-success">Reset Password</h2>
						</div>
						<h6 class="mb-20">Enter your new password, confirm and submit</h6>
						<form method="post">
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="New Password" name="newpw">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-eye"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="Confirm New Password" name="comfirmpw">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-eye"></i></span>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<input class="btn btn-success btn-lg btn-block" type="submit" value="Reset" name="reset">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
		function displayError(input, message) {
      // Remove existing error message
      removeError(input);
      console.log("error");
      // Add new error message
      var errorMessageDiv = $('<div class="error-message" style="color: red;position:absolute;font-size: 12px;margin-top:50px;"></div>').text(message);
      input.closest('.input-group').append(errorMessageDiv);
    }

    // Function to remove error message
    function removeError(input) {
      input.next('.input-message').remove();
    }
	</script>
</body>
</html>
<?php
    if(isset($_POST["reset"])){
        $psw = $_POST["newpw"];
        $c_psw = $_POST["comfirmpw"];
		if (empty($psw) || empty($c_psw)) {
			?>
			<script>
				// displayError($('input[name="newpw"]'), 'Please enter both passwords.');
				displayError($('input[name="comfirmpw"]'), 'Please enter both passwords.');
			</script>
			<?php
		} elseif (strlen($psw) < 8 || strlen($psw) > 16) {
			?>
			<script>
				displayError($('input[name="comfirmpw"]'), 'Password must be between 8 and 16 characters long');
			</script>
			<?php
		} elseif (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z])/', $psw)) {
			?>
			<script>
				displayError($('input[name="comfirmpw"]'), 'Password must contain at least one number and one letter');
			</script>
			<?php
		} elseif ($psw != $c_psw) {
			?>
			<script>
				displayError($('input[name="comfirmpw"]'), 'Passwords do not match');
			</script>
			<?php
        }
        else{
        // $token = $_SESSION['token'];
        $Email = $_SESSION['email'];

        $hash = password_hash( $psw , PASSWORD_DEFAULT );
		$new_pass = $hash;
        $result = mysqli_query($connect, "UPDATE users SET Password='$new_pass' WHERE Email='$Email'");
		
        if($result){
			?>
			<script>
				location.replace("success_page.html");
			</script>
			<?php
        }else {
			echo "error : " . mysqli_error($connect);
		}
    }
    }

?>