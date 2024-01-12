<?php
	// $sessionTimeout = 30 * 60;
	// session_set_cookie_params($sessionTimeout);
	session_start();
	?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Login</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="index.php"  style="color:black;font-weight: bold;">
					Home
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="RegisterUser.php">Register</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login To GEC JobFact</h2>
						</div>
						<form method="post">
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="options" id="company" value="company">
										<div class="icon"><img src="vendors/images/briefcase.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Employer
									</label>
									<label class="btn">
										<input type="radio" name="options" id="user" value="user">
										<div class="icon"><img src="vendors/images/person.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Employee
									</label>
								</div>
							</div>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Email" name="email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-email"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="**********" name="password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1">
										<label class="custom-control-label" for="customCheck1">Remember</label>
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password"><a href="forgetPassword.php">Forgot Password</a></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In" name="login">
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="RegisterUser.php">Register To Create Account</a>
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>
<?php
    if(isset($_POST["login"])){
	include("C:/xampp/htdocs/FYP/dataconnection.php");
	$email = mysqli_real_escape_string($connect, trim($_POST['email']));
	$password = trim($_POST['password']);
	if(empty($email) || empty($password))
	{
	?>
		<script>
			swal({
			title: "Failed!",
			text: "Please fill your information.",
			icon: "error",
			button: "OK",
		});
		</script>
		<?php
	}
	else if(isset($_POST["options"])) {
	$option = $_POST["options"];
	if($option == "user")
	{
		$sql = mysqli_query($connect, "SELECT * FROM users where Email = '$email'");
		$count = mysqli_num_rows($sql);
		if($count > 0)
		{
			$fetch = mysqli_fetch_assoc($sql);
			$status = $fetch["UserStatus"];
			$hashpassword = $fetch["Password"];
			if($status=="Active" && password_verify($password, $hashpassword)){
				$_SESSION['User_ID'] = $fetch['UserID'];
				$_SESSION['User_email'] = $fetch['Email'];
				$_SESSION['First_Name'] = $fetch['FirstName'];
				?>
				<script>
					console.log("login");
					swal({
					title: "User Login Successful",
					text: "Welcome to GEC Job Fact",
					icon: "success",
					button: "OK!",
					}).then((value) => {
						window.location.href = "index.php";
				});
				</script>
				<?php
			}
			else if($status=="Blocked"){
				?>
				<script>
					console.log("blocked");
					swal({
					title: "Failed",
					text: "Your account has already been blocked because of unlawful activity.",
					icon: "error",
					button: "OK!",
					}).then((value) => {
						window.location.href = "login.php";
				});
				</script>
				<?php
			}
			else if(!password_verify($password, $hashpassword)){
				?>
				<script>
					console.log("fails");
					swal({
					title: "Failed!",
					text: "Incorrect password",
					icon: "error",
					button: "OK",
				});
				</script>
				<?php
			}
		}
		else{
			?>
			<script>
				console.log("email not exist");
				swal({
				title: "Failed!",
				text: "Email no exsist",
				icon: "error",
				button: "OK",
			});
			</script>
			<?php
		}
	}
}
	else{
		?>
		<script>
			swal({
			title: "Failed!",
			text: "Kindly choose the login option.",
			icon: "error",
			button: "OK",
		});
		</script>
		<?php
	}
    }
?>