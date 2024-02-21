<?php
  session_start();
  include("C:/xampp/htdocs/FYP/dataconnection.php");
  $adminid = $_SESSION['Admin_ID'];
$admin_sql = mysqli_query($connect, "SELECT * FROM admins WHERE AdminID = '$adminid'");
$admin_row = mysqli_fetch_assoc($admin_sql);
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
	<style>
        #loading {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.7);
    z-index: 1001; /* Set a higher z-index */
}

#loading-spinner {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    z-index: 1002; /* Set a higher z-index */
}
</style>
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
<?php
		if (!isset($_SESSION['Admin_ID'])) {
			header("Location: admin_login.php");
			exit();
		}
	?>
<div id="loading">
        <div id="loading-spinner">
            <img src="vendors/images/loading.gif" alt="Loading Spinner">
        </div>
    </div>
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
							<img src="<?php echo $admin_row['AdminPicture'];?>" alt="" style="height:60px;width:60px;margin-top:-10px;">
						</span>
						<span class="user-name"><?php echo $admin_row['FirstName'];?> <?php echo $admin_row['LastName'];?></span>
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
					<!-- <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-edit2"></span><span class="mtext">Forms</span>
						</a>
						<ul class="submenu">
							<li><a href="form-basic.html">Form Basic</a></li>
							<li><a href="advanced-components.html">Advanced Components</a></li>
							<li><a href="form-wizard.html">Form Wizard</a></li>
							<li><a href="html5-editor.html">HTML5 Editor</a></li>
							<li><a href="form-pickers.html">Form Pickers</a></li>
							<li><a href="image-cropper.html">Image Cropper</a></li>
							<li><a href="image-dropzone.html">Image Dropzone</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Tables</span>
						</a>
						<ul class="submenu">
							<li><a href="basic-table.html">Basic Tables</a></li>
							<li><a href="datatable.html">DataTables</a></li>
						</ul>
					</li> -->
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
								<h4>User assistance</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">User assistance</li>
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
									<th>User email</th>
									<th>Subject</th>
									<th>Created at</th>
									<th>Response</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
									$query = "SELECT * FROM user_contact_us
									ORDER BY ResponseStatus ASC;";
									$result = mysqli_query($connect, $query);
									if(mysqli_num_rows($result) > 0)
									{
										while($row = mysqli_fetch_assoc($result))
										{
											?>
											<tr>
												<td class="table-plus"><?php echo $row["u_ContactID"]; ?></td>
												<td><?php echo $row["UserEmail"]; ?></td>
												<td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $row["Subject"]; ?></td>
												<td><?php echo date('d-m-Y : H:i', strtotime($row["CreatedAt"])); ?></td>
												<td><?php echo ($row["ResponseStatus"] == 1) ? 'Yes' : 'No'; ?></td>
												<td>
													<div class="dropdown">
														<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
															<i class="dw dw-more"></i>
														</a>
														<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
															<a class="viewContactBtn dropdown-item" href="#" data-contactid="<?=$row['u_ContactID'];?>"><i class="dw dw-eye"></i> View</a>
															<?php
															// Check if ResponseStatus is 0 before rendering "Reply" button
															if ($row["ResponseStatus"] == 0) {
																?>
																<a class="editContactBtn dropdown-item" href="#" data-contactid="<?=$row['u_ContactID'];?>"><i class="icon-copy fa fa-reply"></i> Reply</a>
																<?php
															}
															?>
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
		</div>
	</div>
    <!-- View modal -->
    <div class="col-md-4 col-sm-12 mb-30">
            <div class="modal fade bs-example-modal-lg" id="view-contact-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="">User data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
							<h5 style="display: inline-block;">Contact ID</h5>
								<div class="form-group">
									<p id="ContactID" class="form-control"></p>
								</div>
							<h5 style="display: inline-block;">User Email</h5>
								<div class="form-group">
									<p id="UserEmail" class="form-control"></p>
								</div>
							<h5 style="display: inline-block;">Subject</h5>
								<div class="form-group">
									<textarea id="Subject" class="form-control" rows="2" style="height:100%;" disabled></textarea>
								</div>
							<h5 style="display: inline-block;">Message</h5>
								<div class="form-group">
									<textarea id="Message" class="form-control" rows="3" disabled></textarea>
								</div>
							<h5 style="display: inline-block;">Create at</h5>
								<div class="form-group">
									<p id="CreateAt" class="form-control"></p>
								</div>
								<div id="contact-modal-data"></div>
                    	</div>
                	</div>
            	</div>
            </div>
    	</div>
	<!-- Edit modal -->
    <div class="col-md-4 col-sm-12 mb-30">
            <div class="modal fade bs-example-modal-lg" id="edit-contact-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id=""></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
						<input type="hidden" id="edit_ContactID">
							<h5 style="display: inline-block;">User Email</h5>
							<div class="form-group">
								<input type="text" id="edit_UserEmail" class="form-control">
							</div>
							<h5 style="display: inline-block;">Subject</h5>
							<div class="form-group">
								<textarea id="edit_Subject" class="form-control" rows="2" style="height:100%;"disabled></textarea>
							</div>
							<h5 style="display: inline-block;">Content</h5>
							<div class="form-group">
								<textarea id="edit_Message" class="form-control" rows="3" disabled></textarea>
							</div>
							<h5 style="display: inline-block;">Response to company</h5>
							<div class="form-group">
								<textarea id="edit_Response" class="form-control" rows="3"></textarea>
							</div>
							<div class="modal-footer">
							<a class="updateContactBtn btn btn-primary" href="#" data-contactid="<?=$row['u_ContactID'];?>">Send response</a>
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
	<!-- buttons for Export datatable -->
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
        $(document).on('click', '.viewContactBtn', function () {
        console.log("view click");
        var contactid = $(this).data('contactid');
        console.log("contactid : "+contactid);
        $.ajax({
            type: "GET",
            url: "handle_u_contact.php?contactid=" + contactid,
            success: function (response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if(res.status == 404) {
                    alert(res.message);
                }else if(res.status == 200){
					var modalContent = '';
					$('#view-contact-modal').modal('show');
                    var formattedDate = moment(res.data.CreatedAt).format('DD-MM-YYYY HH:mm:ss');
                    $('#ContactID').text(res.data.u_ContactID);
                    $('#UserID').text(res.data.UserID);

                    $('#UserEmail').text(res.data.UserEmail);
                    $('#Subject').text(res.data.Subject);
                    $('#Message').text(res.data.Message);
					$('#response').text(res.data.Response);
                    $('#CreateAt').text(formattedDate);

					if(res.data.Response !== "")
					{
					modalContent += '<hr>';
					modalContent += '<h6 class="group-title" style="text-align:center;color:grey;">Reponse</h6>';
					modalContent += '<hr>';
                    modalContent += '<h5 style="display: inline-block;">Response</h5>';
					modalContent += '<div class="form-group">';
                    modalContent += '<textarea id="response" class="form-control" rows="3" disabled>'+ res.data.Response +'</textarea>';
                    modalContent += '</div>';
					}
                    $('#contact-modal-data').html(modalContent);
					
                }
            }
        });
        });
    </script>
	<!-- View User -->
    <script>
        $(document).on('click', '.editContactBtn', function () {
        console.log("view click");
        var contactid = $(this).data('contactid');
        console.log("contactid : "+contactid);
        $.ajax({
            type: "GET",
            url: "handle_u_contact.php?contactid=" + contactid,
            success: function (response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if(res.status == 404) {
                    alert(res.message);
                }else if(res.status == 200){
					$('#edit_ContactID').val(res.data.u_ContactID);
                    $('#edit_UserEmail').val(res.data.UserEmail);
                    $('#edit_Subject').val(res.data.Subject);
                    $('#edit_Message').val(res.data.Message);

                    $('#edit-contact-modal').modal('show');
                }
            }
        });
        });
    </script>
	<!-- update -->
	<script>
        $(document).on('click', '.updateContactBtn', function () {
        console.log("update click");
        var data = {
            action: "updateResponse",

			contactid: $("#edit_ContactID").val(),
            user_email: $("#edit_UserEmail").val(),
			subject: $("#edit_Subject").val(),
			message: $("#edit_Message").val(),
			response: $("#edit_Response").val(),
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
            url: "handle_u_contact.php",
          	async: true, 
			data: data,
			beforeSend: function () {
			$('#edit-contact-modal [data-dismiss="modal"]').click();
			showLoading();
			},
			success:function(response){
			hideLoading();
                console.log(response);
				if(response==="Failed")
				{
					swal("Oops...", "Response cannot be empty!", "error");
				}
				else{
					swal("Success", response, "success").then(function() {
					location.replace("contact_us_user.php");
				});
				}
				
            }
        });
	}
    });
        });
		function showLoading() {
			$('#loading').show();
		}

		function hideLoading() {
			$('#loading').hide();
		}
    </script>
</html>