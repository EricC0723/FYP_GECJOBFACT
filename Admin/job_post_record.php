<?php	
session_start();
include("C:/xampp/htdocs/FYP/dataconnection.php");
if (isset($_GET['company_id'])) {
    $company_id = $_GET['company_id'];
    $query = "SELECT * FROM  job_post WHERE CompanyID=$company_id ORDER BY AdStartDate DESC";
    $result = mysqli_query($connect,$query);
}
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
	<head>
    <style>
.bordered-section {
    border: 1px solid #e0e0e0; /* 浅色边框颜色 */
    padding: 10px; /* 可选，用于增加内边距 */
	.bordered-section table {
    width: 100%;
    border-collapse: collapse; /* 合并单元格边框 */
}

.bordered-section table td {
    padding: 8px;
    border: 1px solid #e0e0e0; /* 单元格边框颜色 */
}

.bordered-section table td:first-child {
    text-align: right;
    padding-right: 8px;
}

.bordered-section table td:last-child {
    padding-left: 8px; /* 可选，增加最后一个单元格的左内边距 */
}

}
    </style>
</head>
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
	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Search Here">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			<div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo1.jpg" alt="">
										<h3>Lea R. Frith</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo2.jpg" alt="">
										<h3>Erik L. Richards</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo3.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo4.jpg" alt="">
										<h3>Renee I. Hansen</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="">
										<h3>Vicki M. Coleman</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="vendors/images/photo1.jpg" alt="">
						</span>
						<span class="user-name">Ross C. Lopez</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
						<a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
			<div class="github-link">
				<a href="https://github.com/dropways/deskapp" target="_blank"><img src="vendors/images/github.svg" alt=""></a>
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
					<li>
						<a href="admin.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Admin</span>
						</a>
					</li>
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
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Job post record</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item"><a href="index.php">Company</a></li>
									<li class="breadcrumb-item active" aria-current="page">Job post record</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="faq-wrap">
					<h4 class="mb-30 h4 text-blue padding-top-30"># Compnay id :  <?php echo $company_id;?></h4><div class="padding-bottom-30">
                    <?php 
					if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $job_post_id = $row['Job_Post_ID'];
                            ?>
                            <div class="card">
							<div class="card-header">
                            <button class="btn btn-block" data-toggle="collapse" data-target="#faq-<?php echo $job_post_id; ?>">
                            Job post ID #<?php echo $job_post_id; ?>
								</button>
							</div>
                            <div id="faq-<?php echo $job_post_id; ?>" class="collapse">
								<div class="card-body">
									<div class="card-body">
									<div class="row">
											<div class="col-md-12 bordered-section">
											<p style="text-align: center; font-weight: bold; position: relative;">Job information
												<a class="viewJobBtn btn btn-link font-24 p-0 line-height-1 no-arrow" data-jobid="<?=$row['Job_Post_ID'];?>" href="#" role="button" data-toggle="tooltip" data-placement="top" title="more details"style="position: absolute; right: 0;">
													<i class="dw dw-more"></i>
												</a>
											</p>
													<table style="width:100%">
													<tr>
														<td>Job post id</td>
														<td>:</td>	
														<td><?php echo $row["Job_Post_ID"];?></td>
													</tr>
													<tr>
														<td>Job post title</td>
														<td>:</td>
														<td><?php echo $row["Job_Post_Title"];?></td>
													</tr>
													<tr>
														<td>Job post position</td>
														<td>:</td>
														<td><?php echo $row["Job_Post_Position"]; ?></td>
													</tr>
													<tr>
														<td>Job post date</td>
														<td>:</td>
														<td><?php echo date('d-m-y', strtotime($row["AdStartDate"])) . ' - ' . date('d-m-y', strtotime($row["AdEndDate"])); ?></td>
													</tr>
													<tr>
														<td>Job post status</td>
														<td>:</td>
														<td><?php echo $row["job_status"]; ?></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
                        <?php
                        }
					}
					else{
						echo "<p>No job post records available for this company.</p>";
					}
                    ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- View modal -->
    <div class="col-md-4 col-sm-12 mb-30">
    <div class="modal fade bs-example-modal-lg" id="view-job-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title">Job ID -</h4><h4 class="modal-title" id="Job_Post_ID"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
				<div class="group-container">
					<hr>
					<h6 class="group-title" style="text-align:center;color:grey;">Basic Post Information</h6>
					<hr>
				</div>
				<div class="row" style="position:center;">
                      <div class="col-md-6 col-sm-12">
					  <h5 style="display: inline-block;">Job Logo</h5>
						<div class="form-group">
							<img id="Job_Logo_Url" class="img-fluid" alt="Job Logo" style="width:120px;height:100px;">
						</div>
                      </div>
                      <div class="col-md-6 col-sm-12">
					  <h5 style="display: inline-block;">Job Cover</h5>
					<div class="form-group">
						<img id="Job_Cover_Url" class="img-fluid" alt="Job Cover" style="width:120px;height:100px;">
					</div>
                      </div>
                    </div>
                    <h5 style="display: inline-block;">Job Post Title</h5>
                    <div class="form-group">
                        <p id="Job_Post_Title" class="form-control"></p>
                    </div>

                    <h5 style="display: inline-block;">Job Post Position</h5>
                    <div class="form-group">
                        <p id="Job_Post_Position" class="form-control"></p>
                    </div>
					<div class="row" style="position:center;">
                      <div class="col-md-6 col-sm-12">
					  <h5 style="display: inline-block;">Main Category Name</h5>
						<div class="form-group">
						<p id="Main_Category_Name" class="form-control"></p>
						</div>
                      </div>
                      <div class="col-md-6 col-sm-12">
					  <h5 style="display: inline-block;">Sub Category Name</h5>
					<div class="form-group">
					<p id="Sub_Category_Name" class="form-control"></p>
					</div>
                      </div>
                    </div>
					<h5 style="display: inline-block;">Job Type</h5>
					<div class="form-group">
						<p id="Job_Post_Type" class="form-control"></p>
					</div>
					<h5 style="display: inline-block;">Job Location</h5>
					<div class="form-group">
						<p id="Job_Post_Location" class="form-control"></p>
					</div>
					<h5 style="display: inline-block;">Job Status</h5>
                    <div class="form-group">
                        <p id="job_status" class="form-control"></p>
                    </div>
				<div class="group-container"style="text-align:center;color:grey;margin-top:50px;">
					<hr>
					<h6 class="group-title"style="color:grey;" >Salary and deadline information</h6>
					<hr>
				</div>
                    <!-- Add other job-related fields here -->
					<div class="row" style="position:center;">
                      <div class="col-md-6 col-sm-12">
					  <h5 style="display: inline-block;">Ad Start Date</h5>
						<div class="form-group">
						<p id="AdStartDate" class="form-control"></p>
						</div>
                      </div>
                      <div class="col-md-6 col-sm-12">
					  <h5 style="display: inline-block;">Ad End Date</h5>
					<div class="form-group">
					<p id="AdEndDate" class="form-control"></p>
					</div>
                      </div>
                    </div>
					<div class="row" style="position:center;">
                      <div class="col-md-6 col-sm-12">
					  <h5 style="display: inline-block;">Minimum Salary</h5>
						<div class="form-group">
						<p id="Job_Post_MinSalary" class="form-control"></p>
						</div>
                      </div>
                      <div class="col-md-6 col-sm-12">
					  <h5 style="display: inline-block;">Maximum Salary</h5>
					<div class="form-group">
					<p id="Job_Post_MaxSalary" class="form-control"></p>
					</div>
                      </div>
                    </div>
					<div class="group-container"style="text-align:center;color:grey;margin-top:50px;">
					<hr>
					<h6 class="group-title"style="color:grey;" >Job description and requirements</h6>
					<hr>
					</div>
					<h5 style="display: inline-block;">Experience Required</h5>
					<div class="form-group">
						<p id="Job_Post_Exp" class="form-control"></p>
					</div>
					<h5 style="display: inline-block;">Job Description</h5>
					<div class="form-group">
						<textarea id="Job_Post_Description" class="form-control" rows="5" disabled></textarea>
					</div>
					<h5 style="display: inline-block;">Responsibilities</h5>
					<div class="form-group">
						<textarea id="Job_Post_Responsibilities" class="form-control" rows="5" disabled></textarea>
					</div>
					<h5 style="display: inline-block;">Benefits</h5>
					<div class="form-group">
						<textarea id="Job_Post_Benefits" class="form-control" rows="5" disabled></textarea>
					</div>
                    <div id="job-modal-data"></div>
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
	<!-- View job -->
	<script>
        $(document).on('click', '.viewJobBtn', function () {
        console.log("view click");
        var job_id = $(this).data('jobid');
        console.log("Job ID : "+job_id);
        $.ajax({
            type: "GET",
            url: "view_job.php?job_id=" + job_id,
            success: function (response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if(res.status == 404) {
                    alert(res.message);
                }else if(res.status == 200){
                    $('#view-job-modal').modal('show');
                    var startDate = moment(res.data.job.AdStartDate).format('DD-MM-YYYY HH:mm:ss');
					var endDate = moment(res.data.job.AdEndDate).format('DD-MM-YYYY HH:mm:ss');
					$('#CompanyID ').text(res.data.job.CompanyID );
					$('#Job_Post_ID ').text(job_id);
                    $('#Job_Post_Title').text(res.data.job.Job_Post_Title);
                    $('#Job_Post_Position').text(res.data.job.Job_Post_Position);
					$('#Job_Post_Exp').text(res.data.job.Job_Post_Exp);
					$('#Job_Post_MinSalary').text(res.data.job.Job_Post_MinSalary);
					$('#Job_Post_MaxSalary').text(res.data.job.Job_Post_MaxSalary);
					$('#Job_Post_Description').text(res.data.job.Job_Post_Description);
					$('#AdStartDate').text(startDate);
					$('#AdEndDate').text(endDate);
					$('#Job_Post_Type').text(res.data.job.Job_Post_Type);
					$('#job_status').text(res.data.job.job_status);
					$('#Job_Post_Location').text(res.data.job.Job_Post_Location);
					$('#Job_Post_Responsibilities').text(res.data.job.Job_Post_Responsibilities	);
					$('#Job_Post_Benefits').text(res.data.job.Job_Post_Benefits);
					$('#Main_Category_Name').text(res.data.job.Main_Category_Name);
					$('#Sub_Category_Name').text(res.data.job.Sub_Category_Name);

					var jobLogoUrl = res.data.job.Job_Logo_Url;
					var jobCoverUrl = res.data.job.Job_Cover_Url;
					$('#Job_Cover_Url').attr('src', jobCoverUrl);
					$('#Job_Logo_Url').attr('src', jobLogoUrl);

                    console.log(res.data.questions);
                    var questionsTable = "<h4>Job post questions</h4>";
                    questionsTable += "<table class='table table-bordered'>";
                    questionsTable += "<tr><th>Question</th></tr>";

                    for (var i = 0; i < res.data.questions.length; i++) {
                        var question = res.data.questions[i];
                        questionsTable += "<tr>";
                        questionsTable += "<td>" + question.Job_Question_Name + "</td>";
                        questionsTable += "</tr>";
                    }

                    questionsTable += "</table>";
                    console.log(questionsTable);

                    $('#job-modal-data').html(questionsTable);
                }
            }
        });
        });
    </script>
</body>
</html>