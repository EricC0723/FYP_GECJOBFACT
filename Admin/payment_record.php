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
								<h4>Payment Record</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Payment Record</li>
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
									<th>Company name</th>
									<th>Contact Person</th>
									<th>Phone number</th>
									<th>Payment Amount</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
									include("C:/xampp/htdocs/FYP/dataconnection.php");
									$query = "SELECT * FROM payment";
									$result = mysqli_query($connect,$query);
									$location_query = "SELECT * FROM job_location";
									$location_result = mysqli_query($connect,$location_query);
									if(mysqli_num_rows($result) > 0)
									{
										while($row = mysqli_fetch_assoc($result))
										{
											?>
											<tr>
												<td class="table-plus"><?php echo $row["PaymentID"]; ?></td>
												<td><?php echo $row["CompanyName"]; ?></td>
												<td><?php echo $row["ContactPerson"]; ?></td>
												<td><a target="_blank" href="https://api.whatsapp.com/send?phone=60<?php echo $row["CompanyPhone"]; ?>"><?php echo $row["CompanyPhone"]; ?></a></td>
												<td><?php echo "RM". " ".$row["Payment_Amount"]; ?></td>
												<td>
													<div class="dropdown">
														<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
															<i class="dw dw-more"></i>
														</a>
														<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
															<a class="viewPaymentBtn dropdown-item" href="#" data-paymentid="<?=$row['PaymentID'];?>"><i class="dw dw-eye"></i> View</a>
															<a class="printPaymentBtn dropdown-item" href="#" data-paymentid="<?=$row['PaymentID'];?>"><i class="icon-copy fa fa-file-pdf-o" aria-hidden="true"></i> Print to PDF</a>
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
            <div class="modal fade bs-example-modal-lg" id="view-payment-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 830px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="">Company data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                        <div id="payment-modal-data"></div>
                        
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
	<script>
        $(document).on('click', '.printPaymentBtn', function () {
        console.log("print click");
        var paymentid = $(this).data('paymentid');
        console.log("paymentid : "+paymentid);
        $.ajax({
            type: "GET",
            url: "view_payment.php?paymentid=" + paymentid,
            success: function (response) {
                console.log(response);
				swal("Success", "PDF generated and saved successfully! You can find it in the C drive.", "success");
            }
        });
        });
    </script>
    <!-- View payment -->
    <script>
        $(document).on('click', '.viewPaymentBtn', function () {
        console.log("view click");
        var payment_id = $(this).data('paymentid');
        console.log("Payment ID : "+payment_id);
        $.ajax({
            type: "GET",
            url: "view_payment.php?payment_id=" + payment_id,
            success: function (response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if(res.status == 404) {
                    alert(res.message);
                }else if(res.status == 200){
                    $('#view-payment-modal').modal('show');
					var paymentAmount = res.data.payment.Payment_Amount; // 获取 Payment_Amount

					// 计算 Subtotal，假设 SST 税率为6%
					var sstRate = 0.06;
					var subtotal = paymentAmount / (1 + sstRate);
					subtotal = Math.ceil(subtotal);
					// 计算 SST
					var sst = paymentAmount - subtotal;
					sst = sst.toFixed(2);
                    var modalContent = '';

					var paymentDate = new Date(res.data.payment.Payment_Date);
					var day = paymentDate.getDate();
					var month = paymentDate.toLocaleString('en-us', { month: 'short' });
					var year = paymentDate.getFullYear();
					var hours = paymentDate.getHours();
					var minutes = paymentDate.getMinutes();
					var seconds = paymentDate.getSeconds();
					var $paymentDate = day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ':' + seconds;

					var adStartDate = new Date(res.data.job.AdStartDate);
					var day = adStartDate.getDate();
					var month = adStartDate.toLocaleString('en-us', { month: 'short' });
					var year = adStartDate.getFullYear();
					var $formattedAdStartDate =day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ':' + seconds;

					var adEndDate = new Date(res.data.job.AdEndDate);
					var day = adEndDate.getDate();
					var month = adEndDate.toLocaleString('en-us', { month: 'short' });
					var year = adEndDate.getFullYear();
					var $formattedAdEndDate = day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ':' + seconds;

                    modalContent += '<div class="invoice-box">';
                    modalContent += '<div class="invoice-header">';
                    modalContent += '<div class="logo text-center">';
                    modalContent += '<img src="vendors/images/logo.png" alt="" style="height:50px;">';
                    modalContent += '</div>';
                    modalContent += '</div>';
                    modalContent += '<h4 class="text-center mb-30 weight-600">INVOICE</h4>';
                    modalContent += '<div class="row pb-30">';
                    modalContent += '<div class="col-md-6">';
                    modalContent += '<h5 class="mb-15">'+ res.data.payment.CompanyName +'</h5>';
                    modalContent += '<p class="font-14 mb-5">Date Issued: <strong class="weight-600">' + $paymentDate + '</strong></p>';
                    modalContent += '<p class="font-14 mb-5">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <strong class="weight-600">' +  res.data.company.CompanyEmail + '</strong></p>';
					modalContent += '<p class="font-14 mb-5">Duration&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <strong class="weight-600">' +  $formattedAdStartDate +' - '+$formattedAdEndDate + '</strong></p>';
					
                    modalContent += '</div>';
                    modalContent += '<div class="col-md-6">';
                    modalContent += '<div class="text-right">';
                    modalContent += '<p class="font-14 mb-5">GEC JOB FACT</p>';
                    modalContent += '<p class="font-14 mb-5">Jalan Ayer Keroh Lama</p>';
                    modalContent += '<p class="font-14 mb-5">Bukit Beruang</p>';
                    modalContent += '<p class="font-14 mb-5">75450, Melaka</p>';
                    modalContent += '</div>';
                    modalContent += '</div>';
                    modalContent += '</div>';
                    modalContent += '<div class="invoice-desc pb-30">';
                    modalContent += '<div class="invoice-desc-head clearfix">';
					modalContent += '<div class="invoice-sub">Description</div>';
					modalContent += '<div class="invoice-rate">Price (per month)</div>';
					modalContent += '<div class="invoice-rate">Quantity</div>';
					modalContent += '<div class="invoice-subtotal">Subtotal</div>';
                    modalContent += '</div>';
                    modalContent += '<div class="invoice-desc-body">';
                    modalContent += '<ul>';
					modalContent += '<li class="clearfix">';
                    modalContent += '<div class="invoice-sub">'+ res.data.job.Job_Post_Title +'</div>';
					modalContent += '<div class="invoice-rate">RM 98.00</div>';
					modalContent += '<div class="invoice-hours">'+ res.data.payment.Payment_Duration +'</div>';
					modalContent += '<div class="invoice-subtotal"><span class="weight-600"> RM '+ subtotal +'</span></div>';
					modalContent += '</li>';
					modalContent += '<li class="clearfix" style="margin-top:280px;">';
                    modalContent += '<div class="invoice-sub"></div>';
					modalContent += '<div class="invoice-rate"></div>';
					modalContent += '<div class="invoice-hours">sst (6%)</div>';
					modalContent += '<div class="invoice-subtotal"><span class="weight-600"> RM '+ sst +'</span></div>';
					modalContent += '</li>';
					modalContent += '</ul>';

					modalContent += '</div>';
					modalContent += '<div class="invoice-desc-footer">';
					modalContent += '<div class="invoice-desc-head clearfix">';
					modalContent += '<div class="invoice-sub">Card Info</div>';
					modalContent += '<div class="invoice-rate">Pay By</div>';
					modalContent += '<div class="invoice-subtotal">Total Price</div>';
					modalContent += '</div>';
					modalContent += '<div class="invoice-desc-body">';
					modalContent += '<ul>';
					modalContent += '<li class="clearfix">';
					modalContent += '<div class="invoice-sub">';
					var cardNumber = res.data.payment.CreditCard_Number;

					// 取得前四位和后四位
					var firstFourDigits = cardNumber.slice(0, 4);
					var lastFourDigits = cardNumber.slice(-4);

					// 生成隐藏中间数字的字符串
					var hiddenDigits = '*'.repeat(cardNumber.length - 8);

					var formattedCardNumber = firstFourDigits + ' ' + hiddenDigits + ' ' + lastFourDigits;
					modalContent += '<p class="font-14 mb-5">Account No: <strong class="weight-600">' + formattedCardNumber  + '</strong></p>';
					modalContent += '</div>';
					modalContent += '<div class="invoice-rate font-20 weight-600">' + res.data.company.ContactPerson  + '</div>';
					modalContent += '<div class="invoice-subtotal"><span class="weight-600 font-24 text-danger">RM' + paymentAmount  + '</span></div>';
					modalContent += '</li>';
					modalContent += '</ul>';
					modalContent += '</div>';
					modalContent += '</div>';
					modalContent += '</div>';
					modalContent += '<h4 class="text-center pb-20">Thank You</h4>';
					modalContent += '</div>';
					modalContent += '</div>';
                    $('#payment-modal-data').html(modalContent);
                }
            }
        });
        });
    </script>
</html>