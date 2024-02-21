<?php
	session_start();
	include("C:/xampp/htdocs/FYP/dataconnection.php");
	require 'VeridationAdminPage/profile_admin_veridate.php';
	
    $admin_id = $_SESSION['Admin_ID'];

	$admin_query = "SELECT * FROM admins WHERE AdminID = '$admin_id'";
	$result = mysqli_query($connect,$admin_query);
    $row = mysqli_fetch_assoc($result);
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
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
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
<?php
		if (!isset($_SESSION['Admin_ID'])) {
			header("Location: admin_login.php");
			exit();
		}
	?>
<body>
<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
			</div>
		</div>
		<div class="header-right">
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="<?php echo $_SESSION['profile'];?>" alt="" style="height:60px;width:60px;margin-top:-10px;">
						</span>
						<span class="user-name"><?php echo $row['FirstName'];?> <?php echo $row['LastName'];?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="admin_profile.php"><i class="dw dw-user1" ></i> Profile</a>
						<a class="dropdown-item" href="logout.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
			<div class="github-link">
			</div>
		</div>
	</div>
	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.php">
				<img src="vendors/images/logo.png" alt="" class="dark-logo">
				<img src="vendors/images/logo.png" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="index.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
						</a>
					</li>
					<?php
					if ($_SESSION['AdminType'] == 'super admin') {
					?>
						<li>
							<a href="admin.php" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-calendar1"></span><span class="mtext">Admin</span>
							</a>
						</li>
					<?php
					}
					?>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-user"></span><span class="mtext">User</span>
						</a>
						<ul class="submenu">
						<li>
							<a href="user.php" class="dropdown-toggle no-arrow">
								<span class="mtext">User list</span>
							</a>
						</li>
						<li>
							<a href="contact_us_user.php" class="dropdown-toggle no-arrow">
								<span class="mtext">User assistance</span>
							</a>
						</li>
						</ul>
					</li>
                    <li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-apartment"></span><span class="mtext">Company</span>
						</a>
						<ul class="submenu">
						<li>
							<a href="company.php" class="dropdown-toggle no-arrow">
								<span class="mtext">Company list</span>
							</a>
						</li>
						<li>
							<a href="contact_us_company.php" class="dropdown-toggle no-arrow">
								<span class="mtext">Company assistance</span>
							</a>
						</li>
						</ul>
					</li>
					<li>
						<a href="joblist.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-edit1"></span><span class="mtext">Job post</span>
						</a>
					</li>
					<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle">
						<i class="icon-copy ion-ios-keypad" style="margin-right:30px;margin-left:-47px;font-size: 20px;"></i><span class="mtext">Category</span>
					</a>
					<ul class="submenu">
						<li>
							<a href="main_category.php" class="dropdown-toggle no-arrow">
								<span class="mtext">Main category</span>
							</a>
						</li>
						<li>
							<a href="sub_category.php" class="dropdown-toggle no-arrow">
								<span class="mtext">Sub category</span>
							</a>
						</li>
					</ul>
				</li>
					<li>
						<a href="payment_record.php" class="dropdown-toggle no-arrow">
                        <i class="icon-copy fa fa-credit-card" aria-hidden="true" style="margin-right:30px;margin-left:-47px;font-size: 20px;"></i><span class="mtext">Payment record</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>DataTable</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<?php 
					$query = "SELECT * FROM admins";
					$result = mysqli_query($connect,$query);
					$location_query = "SELECT * FROM job_location";
					$location_result = mysqli_query($connect,$location_query);
				?>
				<div class="card-box mb-30">
					<div class="pd-20">
						<h1 style="">Profile</h1>
   					 	<div style="margin: 0px 100px 0px 100px;" class="content">
				<form style="margin-top:100px;" id="update_admin_form" enctype="multipart/form-data">
					<div class="group-container">
						<hr style="margin-top:-50px;">
						<h6 class="group-title" style="text-align:center;color:grey;">Admin information</h6>
						<hr>
					</div>
					<h5 style="display: inline-block;">Admin profile picture</h5>
					<div class="form-group">
						<label for="profile_pictur" id="profile_picture_label">
							<img id="profile_picture_preview" src="<?php echo $row['AdminPicture']; ?>"style="width: 200px; height: 230px; border-radius: 20px; cursor: pointer;">
						</label>
						<input type="file" id="profile_picture" class="form-control-file form-control height-auto" accept="image/*" style="display: none;">
					</div>
					<div class="row" style="position:center;">
                      <div class="col-md-6 col-sm-12">
					  	<input type="hidden" class="form-control" id="edit_userid" style="margin-top:10px;border-color:#787785;">
                        	<h5 style="display: inline-block;">First Name</h5>
                        	<div class="form-group">
                        		<input type="text" placeholder="Enter first name" name="Fname" id="Fname" class="form-control" value="<?php echo $row['FirstName']; ?>"/>
                                <input type="hidden"id="AdminID"class="form-control" value="<?php echo $row['AdminID']; ?>"/>
                        	</div>
                      </div>
						<div class="col-md-6 col-sm-12">
							<h5 style="display: inline-block;">Last Name</h5>
							<div class="form-group">
								<input type="text" placeholder="Enter last name" name="Lname" id="Lname"class="form-control" value="<?php echo $row['LastName']; ?>"/>
							</div>
						</div>
                    </div>
					<div class="row" style="position:center;">
                      <div class="col-md-2 col-sm-12">
                        	<h5 style="display: inline-block;">Phone</h5>
                        	<div class="form-group">
                        		<input type="text" placeholder=""class="form-control" value="60"disabled/>
                        	</div>
                      </div>
						<div class="col-md-10 col-sm-12">
							<h5 style="display: inline-block;color:white;">1</h5>
							<div class="form-group">
								<input type="text" placeholder="Enter phone number" name="phone" id="phone"class="form-control" value="<?php echo $row['AdminPhone']; ?>"/>
							</div>
						</div>
                    </div>
					<h5 style="display: inline-block;">Date of birth</h5>
						<div class="form-group">
							<input class="form-control date-picker"name="date_of_birth" id="date_of_birth" placeholder="Select Date" type="button" value="<?php echo $row['DateOfBirth']; ?>">
						</div>
					<h5 style="display: inline-block;">Street Address</h5>
						<div class="form-group">
						<input type="text" placeholder="Enter address"  name="address" id="address"class="form-control" value="<?php echo $row['StreetAddress']; ?>"/>
						</div>
					<h5 style="display: inline-block;">Postcode</h5>
						<div class="form-group">
							<input type="text" placeholder="Enter postcode"  name="postcode" id="postcode"class="form-control" value="<?php echo $row['PostalCode']; ?>"/>
						</div>
                        <h5 style="display: inline-block;">State and City</h5>
                        <select class="selectpicker form-group" data-size="5" data-width="100%" name="state" id="state" style="max-height:100px;">
                            <?php
                            if (mysqli_num_rows($location_result) > 0) {
                                while ($location_row = mysqli_fetch_assoc($location_result)) {
                                    $locationName = $location_row["Job_Location_Name"];
                                    $isSelected = ($location_row["Job_Location_Name"] == $row["StateAndCity"]) ? 'selected' : '';
                            ?>
                                    <option value="<?php echo $locationName; ?>" <?php echo $isSelected; ?>><?php echo $locationName; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
				  <div class="group-container" style="margin-top:50px;">
						<hr>
						<h6 class="group-title" style="text-align:center;color:grey;">Admin setting</h6>
						<hr>
					</div>
					<h5 style="display: inline-block;">Email</h5>
						<div class="form-group">
							<input type="text" placeholder="Enter email" name="email" id="email"class="form-control" value="<?php echo $row['Email']; ?>" disabled/>
						</div>
					<h5 style="display: inline-block;">Password</h5>
						<div class="form-group">
							<button type="button" class="btn btn-primary" id="requestPasswordBtn"><i class="icon-copy fa fa-send" aria-hidden="true" style="margin-right:10px;"></i>Request a new password</button>
						</div>
							<div class="mt-5 text-center">
								<button class="btn btn-primary" name="updatebtn" id="updatebtn">Save</button>
							</div>
							</form>
							</div>
						<?php
						?>
					</div>
					</div>
</body>
<!-- js -->
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
	<!-- Datatable Setting js -->
	<script src="vendors/scripts/datatable-setting.js"></script></body>
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
    $(document).ready(function () {
    // 确保只绑定一次
    $('#profile_picture').off('change').on('change', function () {
        var input = this;
        var url = URL.createObjectURL(input.files[0]);
        $('#profile_picture_preview').attr('src', url);
    });

    $('#profile_picture_label').off('click').on('click', function () {
        $('#profile_picture').click();
    });
});
</script>
<script>
	$(document).ready(function() {
    $("#requestPasswordBtn").click(function() {
		
        var adminID = $("#AdminID").val();
		var email = $("#email").val();
		console.log(adminID);
        $.ajax({
            type: "POST",
            url: "insert_admin.php",
            data: { action: "request_password_reset", adminID: adminID, email: email },
            success: function(response) {
				swal("Success", "Requested successfully", "success");
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
</script>
</html>




