<?php session_start() ;
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
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="vendors/images/logo.png" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="#">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="vendors/images/forgot-password.png" alt="">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Forgot Password</h2>
						</div>
						<h6 class="mb-20">Enter your email address to reset your password</h6>
						<form method="post">
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Email" name="email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" type="submit" value="Recover" name="recover">
										<!-- <a class="btn btn-primary btn-lg btn-block" href="index.php">Submit</a> -->
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373">OR</div>
								</div>
								<div class="col-5">
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="login.php">Login</a>
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>
<?php 

if(isset($_POST["recover"])){
	include("C:/xampp/htdocs/FYP/dataconnection.php");
	$email = $_POST["email"];

	$sql = mysqli_query($connect, "SELECT * FROM users WHERE Email='$email'");
	$query = mysqli_num_rows($sql);
	$fetch = mysqli_fetch_assoc($sql);
	if($query <= 0){
		?>
		<!-- 
			swal({
            title: "Oops..",
            text: "Sorry, no emails exists",
            icon: "error",
            button: "OK",
          }); -->
		  <script>
			alert("<?php  echo "Sorry, no emails exists "?>");
		</script>
		<?php
	}else{
		// generate token by binaryhexa 
		$token = bin2hex(random_bytes(50));

		$_SESSION['token'] = $token;
		$_SESSION['email'] = $email;
		require "phpmailer/PHPMailerAutoload.php";
		$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->Host='smtp.gmail.com';
		$mail->Port=587;
		$mail->SMTPAuth=true;
		$mail->SMTPSecure='tls';

		// h-hotel account
		$mail->Username='gecjobfacts888@gmail.com';
		$mail->Password='atteeyliyxloitmo';

		// send by h-hotel email
		$mail->setFrom('gecjobfacts888@gmail.com', 'Password Reset');
		// get email from input
		$mail->addAddress($_POST["email"]);
		$mail->addReplyTo('gecjobfacts888@gmail.com');

		// HTML body
		$mail->isHTML(true);
		$mail->Subject="Recover your password";
		$mail->Body="<b>Dear User</b>
		<h3>We received a request to reset your password.</h3>
		<p>Kindly click the below link to reset your password</p>
		http://localhost/final_fyp/FYP/User/resetPassword.php
		<br><br>
		<p>With regrads,</p>
		<b>GEC Job Facts</b>";
		if(!$mail->send()){
			?>
				<script>
					alert("<?php echo " Invalid Email "?>");
				</script>
			<?php
		}else{
			?>
				<script>
					window.location.replace("login.php");
				</script>
			<?php
		}
	}
}
?>
