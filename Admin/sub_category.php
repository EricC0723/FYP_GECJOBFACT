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
								<h4>Sub category</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Sub category</li>
								</ol>
							</nav>
						</div>
                        <div class="col-md-6 col-sm-12 text-right">
							<button type="button" class="AddSubBtn btn btn-primary">Add category</button>
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
									<th class="table-plus datatable-nosort">Sub category ID</th>
									<th>Main category</th>
                                    <th>Sub category</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
									$query = "SELECT sub_category.*, main_category.Main_Category_Name 
                                    FROM sub_category
                                    INNER JOIN main_category ON sub_category.Main_Category_ID = main_category.Main_Category_ID
									WHERE SubCategory_isDeleted = 0";
									$result = mysqli_query($connect, $query);

									$main_category_query = "SELECT * FROM main_category WHERE MainCategory_isDeleted = 0";
									$main_result = mysqli_query($connect, $main_category_query);
									if(mysqli_num_rows($result) > 0)
									{
										while($row = mysqli_fetch_assoc($result))
										{
											?>
											<tr>
												<td class="table-plus"><?php echo $row["Sub_Category_ID"]; ?></td>
												<td><?php echo $row["Main_Category_Name"]; ?></td>
                                                <td><?php echo $row["Sub_Category_Name"]; ?></td>
                                                <td>
													<div class="dropdown">
														<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
															<i class="dw dw-more"></i>
														</a>
														<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
															<a class="DeleteSubBtn dropdown-item" href="#" data-categoryid="<?=$row['Sub_Category_ID'];?>"><i class="icon-copy fi-trash"></i>Delete</a>
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

	 <!-- Add modal -->
	 <div class="col-md-4 col-sm-12 mb-30">
            <div class="modal fade bs-example-modal-lg" id="add-sub-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="">Add new sub category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
						<h5 style="display: inline-block;margin-top:30px;">Select main category</h5>
							<div class="form-group" >
							<select class="selectpicker" data-size="5" data-style="btn-black btn-lg"  data-live-search="true" data-width="100%" id="main" style="height: 100px;">
								<?php 
									if(mysqli_num_rows($main_result) > 0)
									{
										while($main_row = mysqli_fetch_assoc($main_result))
										{
										?>
											<option value="<?php echo $main_row["Main_Category_ID"];?>"><?php echo $main_row["Main_Category_Name"]; ?></option>
										<?php 
										}
									}
								?>
								</select>
							</div>
						<h5 style="display: inline-block;margin-top:30px;">Category name</h5>
						<div class="form-group">
							<input type="text" class="form-control" id="sub" style="margin-top:10px;border-color:#787785;">
						</div>
                    </div>
                        <div class="modal-footer">
							<a class="addNewSub btn btn-primary" href="#" id="addbtn"> Save</a>
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
	<!-- update -->
	<script>
        $(document).on('click', '.DeleteSubBtn', function () {
		var categoryid = $(this).data('categoryid');
        console.log("delete click");
        var data = {
            action: "deleteSub",
			categoryid: categoryid,
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
            url: "handle_category.php",
          	async: true, 
			data: data,
			success:function(response){
                console.log(response);
					swal("Success", response, "success").then(function() {
					location.replace("sub_category.php");
				});
            }
        });
	}
    });
        });
    </script>
	<script>
        $(document).on('click', '.AddSubBtn', function () {
			$('#add-sub-modal').modal('show');
        });
    </script>
	<script>
        var hasErrors = false;
		console.log("add_main_category");
		// Input event listener for first_name input
		$('#sub').on('input', function () {
		validateInput($(this));
		});
		$('#addbtn').on('click', function (event) {
		var hasErrors = false;
		validateInput($('#sub'));

		if ($('.error-message').length > 0) {
			hasErrors = true;
			event.preventDefault();
			console.log('got error');
			swal("Oops...", "Please ensure that all information is entered accurately.", "error");
		}
		if (!hasErrors) {
			event.preventDefault();
			console.log('Insert action');
			insertData();
		}
		});
		
		function insertData() {
			console.log("update click");
        // var user_id = $(this).data('userid');
        var data = {
            action: "insert_new_sub",
			main: $("#main").val(),
			sub: $("#sub").val(),
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
            url: "insert_category.php",
          	async: true, 
			data: data,
            success: function (response) {
                console.log(response);
				swal("Success", response, "success").then(function() {
					location.replace("sub_category.php");
          });
            }
        });
	}
    });
		}
		function validateInput(input) {
		var value = input.val();
		if(value ==="")
		{
			displayError(input, 'Required field');
		}
		// else if (!/^[a-zA-Z]+$/.test(value.replace(/\s/g, '')))  {
		// 	displayError(input, 'Only alphabetic characters are allowed.');
		// } 
		else {
			removeError(input);
		}
		}
		function displayError(input, message) {
      // Remove existing error message
		removeError(input);
		
		// Add new error message
		var errorMessageDiv = $('<div class="error-message" style="color: red;position:absolute;font-size: 12px;"></div>').text(message);
		input.closest('.form-group').append(errorMessageDiv);
		}

		// Function to remove error message
		function removeError(input) {
		input.next('.error-message').remove();
		}
    </script>
</html>