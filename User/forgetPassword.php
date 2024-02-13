<?php session_start() ;
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>GEC JOB FACTS</title>

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
					<li><a href="login.php" style="color:green;">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="images/forget3.webp" alt=""style="margin-left:100px;">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-success">Forgot Password</h2>
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
										<input class="btn btn-success btn-lg btn-block" type="submit" value="Recover" name="recover">
										<!-- <a class="btn btn-primary btn-lg btn-block" href="index.php">Submit</a> -->
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373">OR</div>
								</div>
								<div class="col-5">
									<div class="input-group mb-0">
										<a class="btn btn-outline-success btn-lg btn-block" href="login.php">Login</a>
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
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
function showLoading() {
    $('#loading').show();
}

function hideLoading() {
    $('#loading').hide();
}
	</script>
</body>

</html>
<?php 

if(isset($_POST["recover"])){
	include("C:/xampp/htdocs/FYP/dataconnection.php");
	$email = $_POST["email"];
	$_SESSION['email'] = $email;
	?>
	<script>
		var data = {
            email: "<?php echo $email; ?>"
        };
			$.ajax({
				type: "POST",
				url: "send_user_pw.php",
				data: {
					email: "<?php echo $_SESSION['email'] ?>",
				},
				beforeSend: function () {
				showLoading();
				},
				success: function (response) {
					console.log(response);
					hideLoading();
					if(response === "no_exist")
					{
						swal({
						title: "Failed!",
						text: "Email not exist",
						icon: "error",
						button: "OK",
				});
					}
					else{
						swal({
					title: "Success",
					text: "Reset password link send to your email",
					icon: "success",
					button: "OK!",
					}).then((value) => {
						window.location.href = "login.php";
				});
					}
				},
				error: function (error) {
					console.error("Error:", error);
				}
			});
	</script>
	<?php
}
?>
