<?php
session_start();
include("C:/xampp/htdocs/FYP/dataconnection.php");
$ProfitValues = [];
$MonthValues = [];

$currentYear = date('Y');

$user_sql = mysqli_query($connect, "SELECT * FROM users WHERE DATE(RegistrationDate) = CURDATE()");
$user_count = mysqli_num_rows($user_sql);

$company_sql = mysqli_query($connect, "SELECT * FROM companies WHERE DATE(RegistrationDate) = CURDATE()");
$company_count = mysqli_num_rows($company_sql);

$job_sql = mysqli_query($connect, "SELECT * FROM job_post WHERE DATE(AdStartDate) = CURDATE()");
$job_count = mysqli_num_rows($job_sql);

// 获取今天的开始时间和结束时间
$todayStartDateTime = date('Y-m-d 00:00:00');
$todayEndDateTime = date('Y-m-d 23:59:59');

// 查询今天的所有付款记录
$sqlPayments = mysqli_query($connect, "SELECT * FROM payment WHERE Payment_Date >= '$todayStartDateTime' AND Payment_Date <= '$todayEndDateTime'");

// 计算总收入
$todayProfit = 0;

while ($paymentRow = mysqli_fetch_assoc($sqlPayments)) {
    $paymentAmount = $paymentRow['Payment_Amount'];
    $todayProfit += $paymentAmount;
}

$profit_query = "SELECT YEAR(Payment_Date) AS Payment_Year, MONTH(Payment_Date) AS Payment_Month, SUM(Payment_Amount) 
                AS Monthly_Payment_Total 
                FROM payment 
                WHERE YEAR(Payment_Date) = $currentYear
                GROUP BY YEAR(Payment_Date), MONTH(Payment_Date) 
                ORDER BY YEAR(Payment_Date), MONTH(Payment_Date);";

$profit_result = mysqli_query($connect, $profit_query);

while ($row = mysqli_fetch_assoc($profit_result)) {
    $ProfitValues[] = $row['Monthly_Payment_Total'];
    $MonthValues[] = $row['Payment_Month'];
}
$totalProfit = array_sum($ProfitValues);
$query = "SELECT mc.Main_Category_ID, mc.Main_Category_Name, COUNT(jp.Main_Category_ID) as post_count
          FROM main_category mc
          LEFT JOIN job_post jp ON mc.Main_Category_ID = jp.Main_Category_ID
          GROUP BY mc.Main_Category_ID";

$result = mysqli_query($connect, $query);

$xValues = [];
$yValues = [];

// Fetch data from the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Add Main_Category_Name to xValues
    $xValues[] = $row['Main_Category_Name'];

    // Add post count to yValues
    $yValues[] = $row['post_count'];
}
$totalPosts = array_sum($yValues);
?>
<!DOCTYPE html>
<html>
<head>
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
<body>
	<?php 
		if (!isset($_SESSION['Admin_ID'])) {
			header("Location: admin_login.php");
			exit();
		}
	?>
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

	<!-- <div class="right-sidebar">
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
	</div> -->

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
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="vendors/images/banner-img.png" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-600 font-30 text-blue"><?php echo $_SESSION['First_Name'];?> <?php echo $_SESSION['Last_Name'];?></div>
						</h4>
						<p class="font-18 max-width-600">As you step into the admin page, the world is at your fingertips. Welcome back, <?php echo $_SESSION['First_Name'];?>!
</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
							<i class="icon-copy fa fa-user-o" aria-hidden="true" style="font-size:50px;margin-left:20px;margin-top:10px;"></i>
							</div>
							<div class="widget-data" style="padding-left:40px;padding-top:10px;">
								<div class="h4 mb-0">New user</div>
								<div class="weight-600 font-14"><?php echo $user_count ?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data" style="padding-top:15px;">
								<span class="micon dw dw-apartment" style="font-size:45px;margin-left:20px;padding-top:110px;"></span>
							</div>
							<div class="widget-data" style="padding-top:5px;padding-left:40px;">
								<div class="h4 mb-0">New company</div>
								<div class="weight-600 font-14"><?php echo $company_count ?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1" >
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data" style="padding-top:15px;">
								<span class="micon dw dw-edit1" style="font-size:45px;margin-left:20px;padding-top:110px;"></span>
							</div>
							<div class="widget-data" style="padding-top:5px;padding-left:40px;">
								<div class="h4 mb-0">New job post</div>
								<div class="weight-600 font-14"><?php echo $job_count ?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1" >
						<div class="d-flex flex-wrap align-items-center" >
							<div class="progress-data">
								<i class="icon-copy fa fa-dollar" aria-hidden="true" style="font-size:50px;margin-left:20px;margin-top:10px;"></i>
							</div>
							<div class="widget-data" style="padding-left:40px;padding-top:10px;">
								<div class="h4 mb-0">Profit today</div>
								<div class="weight-600 font-14">RM <?php echo $todayProfit ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="card-box mb-50" style="height: 800px;">
			<div style="text-align:center; font-weight: bold; font-size: 20px;">Profit</div>
			<div class="row justify-content-end" style="padding-top: 20px; padding-right: 15px;">
				<div class="col-md-4 col-sm-6">
				<button type="button" class="btn btn-primary hide-before-print" onclick="downloadProfitPDF()" style="margin-bottom:30px;margin-left:395px;">Print</button>
					<form id="filterForm1">
						<div class="form-group">
							<div class="input-group">
							<input class="form-control" placeholder="Select Month" type="month" min="2023-12"max="<?php echo date('Y-m'); ?>" id="profit">
								<div class="input-group-append">	
									<button type="button" class="btn btn-primary" onclick="filterProfit()">Filter</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
				<canvas id="ProfitChart" style="width:100%;max-width:1000px;max-height:520px;padding-left:100px;"></canvas>
				<div style="text-align: center; font-weight: bold; font-size: 20px; margin-top: 20px;"><span id="totalProfit"></span></div>
			</div>

			<div class="card-box mb-50" style="height: 730px;margin-top:100px;">
			<div style="text-align:center; font-weight: bold; font-size: 20px;">Job post</div>
			<div class="row justify-content-end" style="padding-top: 20px; padding-right: 15px;">
				<div class="col-md-4 col-sm-6">
					<button type="button" class="btn btn-primary hide-before-print" onclick="downloadPDF()" style="margin-bottom:30px;margin-left:395px;">Print</button>
					<form id="filterForm2">
						<div class="form-group">
							<div class="input-group">
								<input class="form-control datetimepicker-range" placeholder="Select Month" type="button" id="job_post">
								<div class="input-group-append">
									<button type="button" class="btn btn-primary" onclick="filterData()">Filter</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
				<canvas id="myChart" style="width:100%;max-width:1000px;max-height:520px;margin-left:130px;"></canvas>
				<div id="totalPosts" style="margin-top:-20px;text-align:center;">Total Posts: <?php echo $totalPosts; ?></div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box" style="margin-top:50px;">
			</div>
		</div>
	</div>

	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard.js"></script>
	
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js" integrity="sha512-t2JWqzirxOmR9MZKu+BMz0TNHe55G5BZ/tfTmXMlxpUY8tsTo3QMD27QGoYKZKFAraIPDhFv56HLdN11ctmiTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
	function filterData() {
    var selectedDateRange = $('#job_post').val();
    console.log(selectedDateRange);
    
    var dateRange = selectedDateRange.split(' - ');
    var startDate = dateRange[0];
    var endDate = dateRange[1];

    var startTimestamp = new Date(startDate).toISOString();
    var endTimestamp = new Date(endDate).toISOString();
    console.log(startTimestamp);
    console.log(endTimestamp);

    $.ajax({
        type: "GET",
        url: "handle_chart.php",
        data: {
            action: "updatePost",
            startDate: startTimestamp,
            endDate: endTimestamp
        },
        success: function(response) {
            var res = JSON.parse(response);
            console.log(res.xValues);
            console.log(res.yValues);
            console.log(res.totalPosts);

            updateChart(res.xValues, res.yValues, res.totalPosts);
        }
    });
}
function updateChart(xValues, yValues,totalPosts) {
    // 假设 myChart 是你的图表变量
    myChart.data.labels = xValues;
    myChart.data.datasets[0].data = yValues;
	$('#totalPosts').text("Total Posts : "+totalPosts);
    myChart.update();
}

function filterProfit() {
var selectedDateRange = $('#profit').val();
console.log(selectedDateRange);

$.ajax({
	type: "GET",
	url: "handle_chart.php",
	data: {
		selectedDateRange: selectedDateRange,
		action : "updateProfit"
	},
	success: function(response) {
		var res = JSON.parse(response);
		console.log(res);
		updateProfitChart(res);
	}
});
}
function updateProfitChart(data) {
	ProfitChart.data.labels = Array.from({ length: data.length }, (_, i) => i + 1);
        ProfitChart.data.datasets[0].data = data;
		ProfitChart.data.datasets[0].label = 'Daily profit';
        ProfitChart.update();

		var totalProfit = data.reduce((sum, value) => {

        var numericValue = parseFloat(value);
        if (!isNaN(numericValue)) {
            return sum + numericValue;
        }
        return sum;
    }, 0).toFixed(2);

    console.log('Total Profit:', totalProfit);
    document.getElementById('totalProfit').innerText = 'Total Profit: RM' + totalProfit;
}
</script>
	<script>
var xValues = <?php echo json_encode($xValues); ?>;
var yValues = <?php echo json_encode($yValues); ?>;
var barColors = [
    "#b91d47", "#00aba9", "#2b5797", "#e8c3b9", "#1e7145",
    "#FF6633", "#FFB399", "#FF33FF", "#FFFF99", "#00B3E6",
    "#E6B333", "#3366E6", "#999966", "#99FF99", "#B34D4D",
    "#80B300", "#809900", "#E6B3B3", "#6680B3", "#66991A",
    "#FF99E6", "#CCFF1A", "#FF1A66", "#E6331A", "#33FFCC",
    "#66994D", "#B366CC", "#4D8000", "#B33300", "#CC80CC"
];
const bgColor = {
        id : 'bgColor',
        beforeDraw: (chart,steps,options) =>{
            const { ctx,width,height} = chart;
            ctx.fillStyle = 'white';
            ctx.fillRect(0,0,width,height)
            ctx.restore();
        }
    }
	
var myChart = new Chart("myChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
			label: 'Job post record',
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        title: {
            display: true,
            text: "Total job post"
        },
        legend: {
            position: "left",
            align: "start"
        },
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 10,
                bottom: 30
            }
        },
		plugins:{
			datalabels:{
				color: 'white',
				formatter: (value) => {
					console.log(value)
					if(value == 0)
					{
						return '';
					}
				}
			}
		}
    },
	plugins: [bgColor,ChartDataLabels]
});
</script>
<script>
	function downloadProfitPDF() {
    const canvas = document.getElementById('ProfitChart');
    canvas.style.backgroundColor = 'white';

    // 获取过滤器的值作为报告名称的一部分
    const filterValue = document.getElementById('profit').value;

    if (filterValue.trim() === '') {
        console.warn('No filter value provided for profit. Using default name "profitchart.pdf".');
        generateProfitPDF(canvas, 'profitchart.pdf');
        return;
    }
    // 生成 PDF
    const reportName = `profitchart_${filterValue}.pdf`;
    generateProfitPDF(canvas, reportName);
}
function downloadPDF() {
    const canvas = document.getElementById('myChart');
    canvas.style.backgroundColor = 'white';

    // 获取过滤器的值作为报告名称的一部分
    const filterValue = document.getElementById('job_post').value;

    // 检查是否存在过滤器值
    if (filterValue.trim() === '') {
        console.warn('No filter value provided. Using default name "job_post_report.pdf".');
        generatePDF(canvas, 'jobpostchart.pdf');
        return;
    }

    const dateRanges = filterValue.split(' - ');

    // 检查是否有足够的值进行 split
    if (dateRanges.length < 2) {
        console.error('Invalid date range format. Cannot generate PDF.');
        return;
    }

    const startDate = new Date(dateRanges[0]);
    const endDate = new Date(dateRanges[1]);

    const formattedStartDate = `${startDate.getDate()}-${startDate.getMonth() + 1}-${startDate.getFullYear()}`;
    const formattedEndDate = `${endDate.getDate()}-${endDate.getMonth() + 1}-${endDate.getFullYear()}`;
    console.log(formattedStartDate);
    console.log(formattedEndDate);

    // 将下划线替换为连字符
    const formattedFilterValue = filterValue.replace(/[_\s]/g, '-');

    // 生成 PDF
    const reportName = `job_post_report_${formattedStartDate} - ${formattedEndDate}.pdf`;
    generatePDF(canvas,reportName);
}
function generateProfitPDF(canvas, reportName) {
    // 创建图像
    const canvasImage = canvas.toDataURL('image/jpeg', 1.0);

    // 图像添加到PDF
    let pdf = new jsPDF('landscape');
    pdf.setFontSize(20);
    pdf.addImage(canvasImage, 'JPEG', 15, 15, 280, 150);
    // pdf.text(15, 15, "We have discovered that");

    // 添加总数信息
    const totalProfit = document.getElementById('totalProfit').innerText;
    pdf.text(15, 180, totalProfit);

    // 保存PDF
    pdf.save(reportName);
}
function generatePDF(canvas, reportName) {
    // 创建图像
    const canvasImage = canvas.toDataURL('image/jpeg', 1.0);

    // 图像添加到PDF
    let pdf = new jsPDF('landscape');
    pdf.setFontSize(20);
    pdf.addImage(canvasImage, 'JPEG', 15, 15, 280, 150);
    // pdf.text(15, 15, "We have discovered that");

    // 添加总数信息
    const totalPosts = document.getElementById('totalPosts').innerText;
    pdf.text(15, 180, totalPosts);

    // 保存PDF
    pdf.save(reportName);
}
</script>
<script>
	const bgColors = {
        id : 'bgColors',
        beforeDraw: (chart,steps,options) =>{
            const { ctx,width,height} = chart;
            ctx.fillStyle = 'white';
            ctx.fillRect(0,0,width,height)
            ctx.restore();
        }
    }
const ProfitValues = <?php echo json_encode($ProfitValues); ?>;
const MonthValues = <?php echo json_encode($MonthValues); ?>;

const monthAbbreviations = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
const monthLabels = MonthValues.map(month => monthAbbreviations[month - 1]);

const maxProfit = Math.max(...ProfitValues);
const roundedMaxProfit = Math.ceil(maxProfit / 1000) * 1000;

var ProfitChart =  new Chart("ProfitChart", {
  type: "bar",
  data: {
    labels: monthLabels,
    datasets: [
      {
        label: 'Monthly profit',
        backgroundColor: "rgba(0,0,255,0.5)",
        data: ProfitValues
      },
    ]
  },
  options: {
    // scales: {
    //   yAxes: [{ticks: {min: 0, max: roundedMaxProfit}}],
    // },
    plugins: {
      datalabels: {
        anchor: 'end',
        align: 'end',
        offset: 4,
        formatter: (value, context) => {
			if (value === 0) {
				return '';
			}
          return 'RM ' + value;
        },
        display: 'value',
        color: 'black'
      }
    }
  },
  plugins: [bgColors,ChartDataLabels]
});
document.getElementById('totalProfit').innerText = 'Total Profit: RM' + <?php echo $totalProfit; ?>;
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
                    $('#edit_FirstName').prop('value',res.data.FirstName);
                    $('#edit_LastName').prop('value',res.data.LastName);
					var phoneNumber = res.data.AdminPhone;
                    $('#edit_Phone').prop('value',phoneNumber);
                    $('#edit_Email').prop('value',res.data.Email);
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
</body>
</html>