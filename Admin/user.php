<?php
  session_start();
  include("C:/xampp/htdocs/FYP/dataconnection.php");
  require 'VeridationAdminPage/edit_admin_veridate.php';
  $admin_query = "SELECT * FROM job_location";
  $admin_location = mysqli_query($connect,$admin_query);
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
<body>
	<!-- <div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="vendors/images/logo.png" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>70%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div> -->

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
						<span class="user-name"><?php echo $_SESSION['First_Name'];?> <?php echo $_SESSION['Last_Name'];?></span>
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
						<!-- <a href="user.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-user"></span><span class="mtext">User</span>
						</a>
					</li> -->
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
					<!-- <li>
						<a href="company.php" class="dropdown-toggle no-arrow">
						<span class="micon dw dw-apartment"></span><span class="mtext">Company</span>
						</a>
					</li> -->
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
					<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-apartment"></span><span class="mtext"> UI Elements </span>
						</a>
						<ul class="submenu">
							<li><a href="ui-buttons.html">Buttons</a></li>
							<li><a href="ui-cards.html">Cards</a></li>
							<li><a href="ui-cards-hover.html">Cards Hover</a></li>
							<li><a href="ui-modals.html">Modals</a></li>
							<li><a href="ui-tabs.html">Tabs</a></li>
							<li><a href="ui-tooltip-popover.html">Tooltip &amp; Popover</a></li>
							<li><a href="ui-sweet-alert.html">Sweet Alert</a></li>
							<li><a href="ui-notification.html">Notification</a></li>
							<li><a href="ui-timeline.html">Timeline</a></li>
							<li><a href="ui-progressbar.html">Progressbar</a></li>
							<li><a href="ui-typography.html">Typography</a></li>
							<li><a href="ui-list-group.html">List group</a></li>
							<li><a href="ui-range-slider.html">Range slider</a></li>
							<li><a href="ui-carousel.html">Carousel</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-paint-brush"></span><span class="mtext">Icons</span>
						</a>
						<ul class="submenu">
							<li><a href="font-awesome.html">FontAwesome Icons</a></li>
							<li><a href="foundation.html">Foundation Icons</a></li>
							<li><a href="ionicons.html">Ionicons Icons</a></li>
							<li><a href="themify.html">Themify Icons</a></li>
							<li><a href="custom-icon.html">Custom Icons</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-analytics-21"></span><span class="mtext">Charts</span>
						</a>
						<ul class="submenu">
							<li><a href="highchart.html">Highchart</a></li>
							<li><a href="knob-chart.html">jQuery Knob</a></li>
							<li><a href="jvectormap.html">jvectormap</a></li>
							<li><a href="apexcharts.html">Apexcharts</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-right-arrow1"></span><span class="mtext">Additional Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="video-player.html">Video Player</a></li>
							<li><a href="login.html">Login</a></li>
							<li><a href="forgot-password.html">Forgot Password</a></li>
							<li><a href="reset-password.html">Reset Password</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-browser2"></span><span class="mtext">Error Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="400.html">400</a></li>
							<li><a href="403.html">403</a></li>
							<li><a href="404.html">404</a></li>
							<li><a href="500.html">500</a></li>
							<li><a href="503.html">503</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-copy"></span><span class="mtext">Extra Pages</span>
						</a>
						<ul class="submenu">
							<li><a href="blank.html">Blank</a></li>
							<li><a href="contact-directory.html">Contact Directory</a></li>
							<li><a href="blog.html">Blog</a></li>
							<li><a href="blog-detail.html">Blog Detail</a></li>
							<li><a href="product.html">Product</a></li>
							<li><a href="product-detail.html">Product Detail</a></li>
							<li><a href="faq.html">FAQ</a></li>
							<li><a href="profile.html">Profile</a></li>
							<li><a href="gallery.html">Gallery</a></li>
							<li><a href="pricing-table.html">Pricing Tables</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-list3"></span><span class="mtext">Multi Level Menu</span>
						</a>
						<ul class="submenu">
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li class="dropdown">
								<a href="javascript:;" class="dropdown-toggle">
									<span class="micon fa fa-plug"></span><span class="mtext">Level 2</span>
								</a>
								<ul class="submenu child">
									<li><a href="javascript:;">Level 2</a></li>
									<li><a href="javascript:;">Level 2</a></li>
								</ul>
							</li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
							<li><a href="javascript:;">Level 1</a></li>
						</ul>
					</li>
					<li>
						<a href="sitemap.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-diagram"></span><span class="mtext">Sitemap</span>
						</a>
					</li>
					<li>
						<a href="chat.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-chat3"></span><span class="mtext">Chat</span>
						</a>
					</li>
					<li>
						<a href="invoice.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-invoice"></span><span class="mtext">Invoice</span>
						</a>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<div class="sidebar-small-cap">Extra</div>
					</li>
					<li>
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit-2"></span><span class="mtext">Documentation</span>
						</a>
						<ul class="submenu">
							<li><a href="introduction.html">Introduction</a></li>
							<li><a href="getting-started.html">Getting Started</a></li>
							<li><a href="color-settings.html">Color Settings</a></li>
							<li><a href="third-party-plugins.html">Third Party Plugins</a></li>
						</ul>
					</li>
					<li>
						<a href="https://dropways.github.io/deskapp-free-single-page-website-template/" target="_blank" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-paper-plane1"></span>
							<span class="mtext">Landing Page <img src="vendors/images/coming-soon.png" alt="" width="25"></span>
						</a>
					</li> -->
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
								<h4>User List</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">User</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<!-- User table -->
				<div class="card-box mb-30">
					<div class="pd-20">
					</div>
					<div class="pb-20">
						
						<table id="user_table"class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone number</th>
									<th>Registration Date</th>
									<th>User Status</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
									include("C:/xampp/htdocs/FYP/dataconnection.php");
									$query = "SELECT * FROM users WHERE UserStatus IN ('Active', 'Blocked', 'Verify', 'Deleted')";
									$result = mysqli_query($connect,$query);
									$location_query = "SELECT * FROM job_location";
									$location_result = mysqli_query($connect,$location_query);
									if(mysqli_num_rows($result) > 0)
									{
										while($row = mysqli_fetch_assoc($result))
										{
											?>
											<tr>
												<td class="table-plus"><?php echo $row["UserID"]; ?></td>
												<td><?php echo $row["FirstName"]; ?></td>
												<td><?php echo $row["Email"]; ?></td>
												<td><a target="_blank" href="https://api.whatsapp.com/send?phone=60<?php echo $row["Phone"]; ?>"><?php echo $row["Phone"]; ?></a></td>
												<td><?php echo date('d-m-Y', strtotime($row['RegistrationDate'])); ?></td>
												<td>
												<?php
                                                if($row["UserStatus"] == 'Blocked'){
													echo '<button type="button" class="btn btn-danger">Blocked</button>';
												}
												else if($row["UserStatus"] == 'Active'){
													echo '<button type="button" class="btn btn-success">Active</button>';
												}
												else if($row["UserStatus"] == 'Verify'){
													echo '<button type="button" class="btn btn-dark">Verify</button>';
												}
												?>
												</td>
												<td>
													<div class="dropdown">
														<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
															<i class="dw dw-more"></i>
														</a>
														<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
															<a class="viewUserBtn dropdown-item" href="#" data-userid="<?=$row['UserID'];?>"><i class="dw dw-eye"></i> View</a>
															<a class="editUserBtn dropdown-item" href="#" data-userid="<?=$row['UserID'];?>"><i class="dw dw-edit2"></i> Edit</a>
															<a class="recordBtn dropdown-item" href="application_record.php?user_id=<?=$row['UserID'];?>"><i class="icon-copy fi-book-bookmark"></i>Application record</a>
														</div>
													</div>
												</td>
											</tr>
											<?php
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End --> 	
			<!-- <div class="footer-wrap pd-20 mb-20 card-box">
				DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div> -->
		</div>
	</div>
    <!-- View modal -->
    <div class="col-md-4 col-sm-12 mb-30">
            <div class="modal fade bs-example-modal-lg" id="view-user-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="">View user data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                        <div class="row" style="position:center;">
                      <div class="col-md-6 col-sm-12">
                        <h5 style="display: inline-block;">First Name</h5>
                        <div class="form-group">
                        <p id="FirstName" class="form-control"></p>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <h5 style="display: inline-block;">Last Name</h5>
                        <div class="form-group">
                        <p id="LastName" class="form-control"></p>
                        </div>
                      </div>
                    </div>
                    <h5 style="display: inline-block;">Email</h5>
                        <div class="form-group">
                        <p id="Email" class="form-control"></p>
                        </div>
                    <!-- <h5 style="display: inline-block;">Password</h5>
                    <div class="form-group">
                    <p class="form-control">* * * * * * * * *</p>
                    </div> -->
					<h5 style="display: inline-block;">Phone number</h5>
                    <div class="form-group">
                    <p id="Phone" class="form-control"></p>
					</div>
                    <h5 style="display: inline-block;">Location</h5>
                    <div class="form-group">
                    <p id="Location" class="form-control"></p>
					</div>
                    <h5 style="display: inline-block;">Registration Date</h5>
                    <div class="form-group">
                    <p id="RegistrationDate" class="form-control"></p>
                    </div>
                    <h5 style="display: inline-block;">User Status</h5>
                    <div class="form-group">
                    <p id="UserStatus" class="form-control"></p>
                    </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
        <!-- Edit modal -->
        <div class="col-md-4 col-sm-12 mb-30">
            <div class="modal fade bs-example-modal-lg" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="">Edit user data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                        <div class="row" style="position:center;">
                      <div class="col-md-6 col-sm-12">
					  	<input type="hidden" class="form-control" id="edit_userid" style="margin-top:10px;border-color:#787785;">
                        <h5 style="display: inline-block;">First Name</h5>
                        <div class="form-group">
                        <input type="text" class="form-control" id="edit_FirstName" style="margin-top:10px;border-color:#787785;"disabled>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <h5 style="display: inline-block;">Last Name</h5>
                        <div class="form-group">
                        <input type="text" class="form-control" id="edit_LastName" style="margin-top:10px;border-color:#787785;"disabled>
                        </div>
                      </div>
                    </div>
                    <h5 style="display: inline-block;">Email</h5>
                        <div class="form-group">
                        <input type="text" class="form-control" id="edit_Email" style="margin-top:10px;border-color:#787785;" disabled>
                        </div>
                    <!-- <h5 style="display: inline-block;">Password</h5>
                    <div class="form-group">
                    <button type="button" class="btn btn-primary"><i class="icon-copy fa fa-send" aria-hidden="true" style="margin-right:10px;"></i>Request a new password from the user</button>
                    </div> -->
					<h5 style="display: inline-block;">Phone number</h5>
                        <div class="form-group">
                        <input type="text" class="form-control" id="edit_Phone" style="margin-top:10px;border-color:#787785;"disabled>
                    </div>
					<h5 style="display: inline-block;">Location</h5>
					<select class="selectpicker form-control" data-size="5" data-width="100%" name="edit_Location" id="edit_Location"style="max-height:100px;"disabled>
                    <?php
                    if(mysqli_num_rows($location_result) > 0)
                    {
                      while($row = mysqli_fetch_assoc($location_result))
                      {
                    ?>
                     <option value="<?php echo $row["Job_Location_Name"];?>"><?php echo $row["Job_Location_Name"]; ?></option>
                    <?php 
                      }
                    }
                    ?>
                  </select>
                    <h5 style="display: inline-block;margin-top:30px;">Registration Date</h5>
                    <div class="form-group">
                     <input type="text" class="form-control" id="edit_RegistrationDate" style="margin-top:10px;border-color:#787785;" disabled>
                    </div>
                    <h5 style="display: inline-block;">User Status</h5>
                    <div class="form-group">
                    <select class="selectpicker form-control" name="edit_UserStatus" id="edit_UserStatus" style="width: 100%; height: 38px;">
							<option value="Active">Active</option>
							<option value="Blocked" >Blocked</option>
					</select>
                    </div>
                        <div class="modal-footer">
							<a class="updateUserBtn btn btn-primary" href="#" data-userid="<?=$row['UserID'];?>"> Save changes</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>

		<!-- Edit modal -->
		<div class="col-md-4 col-sm-12 mb-30">
            <div class="modal fade bs-example-modal-lg" id="edit-admin-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="">Edit admin data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
							<div class="group-container">
								<hr>
									<h6 class="group-title" style="text-align:center;color:grey;">Basic admin Information</h6>
								<hr>
							</div>
							<form id="edit_admin_form" enctype="multipart/form-data">
							<h5 style="display: inline-block;">Profile picture</h5>
								<div class="form-group">
									<label for="profile_pictur" id="profile_picture_label">
										<img id="profile_picture_preview" src="adminPicture/default.jpeg"style="width: 200px; height: 230px; border-radius: 20px; cursor: pointer;">
									</label>
									<input type="file" id="edit_profile_picture" class="form-control-file form-control height-auto" accept="image/*" style="display: none;">
								</div>
                        	<div class="row" style="position:center;">
                      			<div class="col-md-6 col-sm-12">
                        			<h5 style="display: inline-block;">First Name</h5>
                       					<div class="form-group">
											<input type="hidden" class="form-control" id="AdminID" style="margin-top:10px;border-color:#787785;">
											<input type="text" class="form-control" id="edit_admin_FirstName" style="margin-top:10px;border-color:#787785;">
                        				</div>
                      			</div>
                      			<div class="col-md-6 col-sm-12">
                        			<h5 style="display: inline-block;">Last Name</h5>
                        				<div class="form-group">
                        					<input type="text" class="form-control" id="edit_admin_LastName" style="margin-top:10px;border-color:#787785;">
                        				</div>
                      			</div>
                    		</div>
							<h5 style="display: inline-block;">Phone number</h5>
                    			<div class="form-group">
									<input type="text" class="form-control" id="edit_admin_Phone" style="margin-top:10px;border-color:#787785;">
								</div>
							<h5 style="display: inline-block;">Date of Birth</h5>
                        		<div class="form-group">
									<input class="form-control date-picker"name="edit_DateOfBirth" id="edit_DateOfBirth" placeholder="Select Date" type="button">
                        		</div>
							<h5 style="display: inline-block;">State and City</h5>
                    			<select class="selectpicker form-control" data-size="5" data-width="100%" name="edit_StateAndCity" id="edit_StateAndCity"style="max-height:100px;">
									<?php
									if(mysqli_num_rows($admin_location) > 0)
									{
									while($location_row = mysqli_fetch_assoc($admin_location))
									{
									?>
									<option value="<?php echo $location_row["Job_Location_Name"];?>"><?php echo $location_row["Job_Location_Name"]; ?></option>
									<?php 
									}
									}
									?>
                  				</select>
							<h5 style="display: inline-block;">Street Address</h5>
								<div class="form-group">
									<input type="text" class="form-control" id="edit_StreetAddress" style="margin-top:10px;border-color:#787785;">
								</div>
							<h5 style="display: inline-block;">Postal Code</h5>
								<div class="form-group">
									<input type="text" class="form-control" id="edit_PostalCode" style="margin-top:10px;border-color:#787785;">
								</div>
							<h5 style="display: inline-block;">Registration Date</h5>
								<div class="form-group">
									<input type="text" class="form-control" id="edit_admin_RegistrationDate" style="margin-top:10px;border-color:#787785;"disabled>
								</div>
						<div class="group-container">
							<hr>
								<h6 class="group-title" style="text-align:center;color:grey;">Setting Information</h6>
							<hr>
						</div>
						<h5 style="display: inline-block;">Email</h5>
							<div class="form-group">
								<input type="text" class="form-control" id="edit_admin_Email" style="margin-top:10px;border-color:#787785;" disabled>
							</div>
                    	<h5 style="display: inline-block;">Password</h5>
							<div class="form-group">
								<button type="button" class="btn btn-primary" id="requestPasswordBtn"><i class="icon-copy fa fa-send" aria-hidden="true" style="margin-right:10px;"></i>Request a new password</button>
							</div>
						<!-- <h5 style="display: inline-block;">Admin Status</h5>
							<div class="form-group">
								<select class="selectpicker form-control" name="edit_AdminStatus" id="edit_AdminStatus" style="width: 100%; height: 38px;">
										<option value="Active">Active</option>
										<option value="Blocked" >Blocked</option>
										<option value="Closed" >Closed</option>
								</select>
							</div>
						<h5 style="display: inline-block;">Admin Type</h5>
                    		<div class="form-group">
                    			<select class="selectpicker form-control" name="edit_AdminType" id="edit_AdminType" style="width: 100%; height: 38px;">
									<option value="normal admin">normal admin</option>
								</select>
                    		</div> -->
						</form>
						<div class="modal-footer">
							<a class="updateAdminBtn btn btn-primary" id="editbtn"style="color:white;"> Save changes</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
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
	<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
	<script src="vendors/scripts/datatable-setting.js"></script></body>
    <!-- View User -->
    <script>
        $(document).on('click', '.viewUserBtn', function () {
        console.log("view click");
        var user_id = $(this).data('userid');
        console.log("User ID : "+user_id);
        $.ajax({
            type: "GET",
            url: "view_user.php?user_id=" + user_id,
            success: function (response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if(res.status == 404) {
                    alert(res.message);
                }else if(res.status == 200){
                    var formattedDate = moment(res.data.RegistrationDate).format('DD-MM-YYYY HH:mm:ss');
                    $('#FirstName').text(res.data.FirstName);
                    $('#LastName').text(res.data.LastName);
					var phoneNumber = res.data.Phone;
					if(isNaN(phoneNumber) || phoneNumber === null || phoneNumber === "")
					{
						phoneNumber = "-";
					}
					else{
						phoneNumber = "60 - " + phoneNumber;
					}
                    $('#Phone').text(phoneNumber);
                    $('#Email').text(res.data.Email);
                    $('#Password').text(res.data.Password);
                    $('#UserStatus').text(res.data.UserStatus);
                    $('#Location').text(res.data.Location);
                    $('#RegistrationDate').text(formattedDate);

                    $('#view-user-modal').modal('show');
                }
            }
        });
        });
    </script>
	<!-- edit btn click -->
    <script>
        $(document).on('click', '.editUserBtn', function () {
        console.log("view click");
        var user_id = $(this).data('userid');
        console.log("User ID : "+user_id);
        $.ajax({
            type: "GET",
            url: "view_user.php?user_id=" + user_id,
            success: function (response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if(res.status == 404) {
                    alert(res.message);
                }else if(res.status == 200){
                    var formattedDate = moment(res.data.RegistrationDate).format('DD-MM-YYYY HH:mm:ss');
                    $('#edit_FirstName').prop('value', res.data.FirstName);
                    $('#edit_LastName').prop('value', res.data.LastName);
					var phoneNumber = res.data.Phone;
					if(isNaN(phoneNumber) || phoneNumber === null || phoneNumber === "")
					{
						phoneNumber = "-";
					}
                    $('#edit_Phone').prop('value', phoneNumber);
					$('#edit_userid').prop('value', user_id);
                    $('#edit_Email').prop('value', res.data.Email);
                    $('#edit_Password').prop('value', res.data.Password);

                    var userStatusSelect = $('#edit_UserStatus');
					userStatusSelect.find('option').each(function() {
						if ($(this).val() === res.data.UserStatus) {
							$(this).prop('selected', true);
						} else {
							$(this).prop('selected', false);
						}
					});
					$('#edit_UserStatus').selectpicker('refresh');
                    var locationSelect = $('#edit_Location');
					locationSelect.find('option').each(function() {
						$('#edit_Location').selectpicker('refresh');
						if ($(this).val() === res.data.Location) {
							$(this).prop('selected', true);
						} else {
							$(this).prop('selected', false);
						}
					});
                    $('#edit_admin_RegistrationDate').prop('value', formattedDate);

                    $('#edit-user-modal').modal('show');
                }
            }
        });
        });
    </script>
	<!-- update -->
	<script>
        $(document).on('click', '.updateUserBtn', function () {
        console.log("update click");
        // var user_id = $(this).data('userid');
        var data = {
            action: "updateUser",
			user_id: $("#edit_userid").val(),
            first_name: $("#edit_FirstName").val(),
            last_name: $("#edit_LastName").val(),
            location: $("#edit_Location").val(),
            phone: $("#edit_Phone").val(),
            status: $("#edit_UserStatus").val(),
        };
		console.log(data);
		swal({
        title: "Are you sure?",
        icon: "warning",
        buttons: ["No, cancel it!", "Yes, I am sure!"],
        dangerMode: true,
    	}).then((result) => {
        if (result) {
        $.ajax({
            type: "POST",
            url: "view_user.php",
          	async: true, 
			data: data,
            success: function (response) {
                console.log(response);
				swal("Success", response, "success").then(function() {
					location.replace("user.php");
          });
            }
        });
	}
    });
        });
    </script>
	<!-- Edit -->
<script>
        $(document).on('click', '.editAdminBtn', function () {
        console.log("view click");
        var admin_id = $(this).data('adminid');
        console.log("Admin ID : "+admin_id);
        $.ajax({
            type: "GET",
            url: "view_admin.php?admin_id=" + admin_id,
            success: function (response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if(res.status == 404) {
                    alert(res.message);
                }else if(res.status == 200){
                    var formattedDate = moment(res.data.RegistrationDate).format('DD-MM-YYYY HH:mm:ss');
					$('#AdminID').prop('value',res.data.AdminID);
                    $('#edit_admin_FirstName').prop('value',res.data.FirstName);
                    $('#edit_admin_LastName').prop('value',res.data.LastName);
					var phoneNumber = res.data.AdminPhone;
                    $('#edit_admin_Phone').prop('value',phoneNumber);
                    $('#edit_admin_Email').prop('value',res.data.Email);
                    $('#edit_Password').prop('value',res.data.Password);
                    $('#edit_StreetAddress').prop('value',res.data.StreetAddress);
					var locationSelect = $('#edit_StateAndCity');
					locationSelect.find('option').each(function() {
						if ($(this).val() === res.data.StateAndCity) {
							$(this).prop('selected', true);
						} else {
							$(this).prop('selected', false);
						}
					});
					$('#edit_StateAndCity').selectpicker('refresh');

					$('#edit_PostalCode').prop('value',res.data.PostalCode);
					$('#edit_AdminType').prop('value',res.data.AdminType);
					$('#edit_DateOfBirth').prop('value',res.data.DateOfBirth);
                    $('#edit_RegistrationDate').prop('value',formattedDate);
					var profilePictureUrl = res.data.AdminPicture;
					$('#profile_picture_preview').attr('src', profilePictureUrl);

					var adminTypeSelect = $('#edit_AdminType');
					adminTypeSelect.find('option').each(function() {
						if ($(this).val() === res.data.AdminStatus) {
							$(this).prop('selected', true);
						} else {
							$(this).prop('selected', false);
						}
					});
					$('#edit_AdminType').selectpicker('refresh');

					var adminStatusSelect = $('#edit_AdminStatus');
					adminStatusSelect.find('option').each(function() {
						if ($(this).val() === res.data.AdminStatus) {
							$(this).prop('selected', true);
						} else {
							$(this).prop('selected', false);
						}
					});
					$('#edit_AdminStatus').selectpicker('refresh');

                    $('#edit-admin-modal').modal('show');
                }
            }
        });
        });
    </script>
</html>