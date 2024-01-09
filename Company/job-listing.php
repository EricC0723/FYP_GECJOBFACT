<!DOCTYPE html>

<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning

if (!isset($_SESSION['companyData'])) {
    echo '<script>alert("You haven\'t logged in"); window.location.href = "company_login.php";</script>';
    exit;
}
?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="job-listing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
</head>

<body class="postjob_body">
    <header class="postjob_header">
        <div class="container">
            <div class="logo">
                <a href="company_landing.php" class="postjob_link"><img src="logo.png" alt="Logo"></a>
            </div>
            <div class="logo-nav">
                <nav style="display:flex">
                    <span class="header-link"><a href="company_landing.php" class="company_nav_active">Home</a></span>
                    <span class="header-link"><a href="job-listing.php">Jobs</a></span>
                    <span class="header-link"><a href="#products">Products</a></span>
                </nav>
            </div>
            <div style="flex:1 1 auto;"></div>

            <div style="padding:0 20px">
                <div class="flex-container">
                    <div class="dropdown">
                        <div style="display: flex; align-items: center;">
                            <a href="#profile" onclick="toggleDropdown(event)" class="dropdown-title">
                                <?php echo isset($_SESSION['companyData']['CompanyName']) ? $_SESSION['companyData']['CompanyName'] : 'User Profile'; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    id="dropdown-icon"
                                    style="width:24px;height:24px;padding-left:10px;transform-origin:65% 50%;transition: transform .3s ease;">
                                    <path
                                        d="M20.7 7.3c-.4-.4-1-.4-1.4 0L12 14.6 4.7 7.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l8 8c.2.2.5.3.7.3s.5-.1.7-.3l8-8c.4-.4.4-1 0-1.4z">
                                    </path>
                                </svg>
                            </a>

                        </div>
                        <div class="dropdown-content" id="dropdownContent">
                            <span class="companyName">
                                <?php echo isset($_SESSION['companyData']['CompanyName']) ? $_SESSION['companyData']['CompanyName'] : 'User Profile'; ?>
                            </span>
                            <div style="padding-top:10px;">
                                <span class="contactPerson">
                                    <?php echo isset($_SESSION['companyData']['ContactPerson']) ? $_SESSION['companyData']['ContactPerson'] : ''; ?>
                                </span>
                            </div>
                            <div style="padding-top: 10px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="#accounts" class="dropdown-link">Accounts
                                    details</a></div>
                            <div style="padding-top: 12px;"><a href="#team" class="dropdown-link">Your team</a></div>
                            <div style="padding-top: 12px;"><a href="#invoicehistory" class="dropdown-link">Invoice
                                    history</a></div>
                            <div style="padding-top: 12px;"><a href="#logos" class="dropdown-link">Logos & Brands</a>
                            </div>
                            <div style="padding-top: 12px;"><a href="#adprice" class="dropdown-link">Ad price lookup</a>
                            </div>
                            <div style="padding-top: 20px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="#contact" class="dropdown-link">Contact us</a>
                            </div>
                            <div style="padding-top: 12px;"><a href="company_signout.php" class="dropdown-link">Sign
                                    out</a></div>
                        </div>
                    </div>
                    <div class="add_button">
                        <a href="post-job-classify.php" class="create_job_link">Create a job ad</a>
                    </div>
                </div>
            </div>

    </header>
    <div style="width:100%;background:white;">
        <div style="max-width:1280px; margin:0 auto;flex-direction:row;display:flex;position:relative;">
            <div>
                <button type="button" class="joblistbtn active" id="activeButton"><span
                        class="joblisttitle">Active</span></button>
            </div>
            <div>
                <button type="button" class="joblistbtn" id="closedButton"><span
                        class="joblisttitle">Closed</span></button>
            </div>
            <div>
                <button type="button" class="joblistbtn" id="draftButton"><span
                        class="joblisttitle">Draft</span></button>
            </div>
            <div class="underline"></div>
        </div>
    </div>

    <div class="content-div" id="active">
        <div style="width:100%;padding-top:32px;">
            <div style="flex-direction:row;display:flex;justify-content:space-between;align-items:center;">
                <?php
                $CompanyID = null;
                if (isset($_SESSION['companyData']['CompanyID'])) {
                    $CompanyID = $_SESSION['companyData']['CompanyID'];
                }

                $searchTerm = '';
                if (isset($_GET['activesearch'])) {
                    $searchTerm = mysqli_real_escape_string($connect, $_GET['activesearch']);
                }

                // Prepare the SQL statement to count the total number of jobs
                $sql = "SELECT COUNT(*) as total FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Active' AND Job_Post_Title LIKE '%$searchTerm%'";
                $result = mysqli_query($connect, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalJobs = $row['total'];
                ?>
                <h2 class="landing_sentence3" style="width:500px">
                    <?php echo $totalJobs; ?> job
                    <?php echo $totalJobs == 1 ? 'ad' : 'ads'; ?>
                </h2>
                <div>
                    <form id="activeForm" method="GET" action="">
                        <div style="position:relative">
                            <div class="divsearchicon">
                                <span class="spansearchicon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        xml:space="preserve" focusable="false" fill="currentColor" width="16"
                                        height="16" style="width:20px;height:20px;" aria-hidden="true">
                                        <path
                                            d="M21.7 20.3 18 16.6c1.2-1.5 2-3.5 2-5.6 0-5-4-9-9-9s-9 4-9 9 4 9 9 9c2.1 0 4.1-.7 5.6-2l3.7 3.7c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4zM4 11c0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.9-.8 3.7-2 4.9-1.3 1.3-3 2-4.9 2-4 .1-7.1-3-7.1-6.9z">
                                        </path>
                                    </svg></span>
                            </div>
                            <?php
                            // Get the search term from the URL parameters
                            $searchTerm = isset($_GET['activesearch']) ? $_GET['activesearch'] : '';
                            ?>
                            <input id="activeInput" type="text" class="input-box" name="activesearch"
                                style="padding-left:44px;padding-right:44px;width:512px;"
                                placeholder="Search job title or reference number"
                                value="<?php echo htmlspecialchars($searchTerm); ?>">
                            <button id="clearactive" class="clear-button" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="width:20px;height:20px;">
                                    <path
                                        d="m13.4 12 5.3-5.3c.4-.4.4-1 0-1.4s-1-.4-1.4 0L12 10.6 6.7 5.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l5.3 5.3-5.3 5.3c-.4.4-.4 1 0 1.4.2.2.4.3.7.3s.5-.1.7-.3l5.3-5.3 5.3 5.3c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4L13.4 12z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <input type="submit" value="Search" style="display: none;">
                    </form>
                </div>
                <div style="align-items:center;display:flex;width:147px;">
                    <a href="post-job-classify.php" class="create_btn">Create a job ad</a>
                </div>
            </div>
        </div>

        <div style="width: 100%;margin: auto;height: 100%;padding-top:12px;">
            <table style="background-color: #fff;border-collapse: collapse;width: 100%;">
                <thead>
                    <tr>
                        <th style="width:97.05px">
                            <div class="th_title">Status</div>
                        </th>
                        <th>
                            <div class="th_title">Job</div>
                        </th>
                        <th style="width:146px;">
                            <div class="th_title">Candidates</div>
                        </th>
                        <th style="width:156px;">
                            <div class="th_title" style="text-align:right;">Draft Actions</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $CompanyID = null;
                    if (isset($_SESSION['companyData']['CompanyID'])) {
                        $CompanyID = $_SESSION['companyData']['CompanyID'];
                    }

                    $searchTerm = '';
                    if (isset($_GET['activesearch'])) {
                        $searchTerm = mysqli_real_escape_string($connect, $_GET['activesearch']);
                    }

                    // Prepare the SQL statement
                    $sql = "SELECT * FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Active' AND Job_Post_Title LIKE '%$searchTerm%' ORDER BY AdStartDate DESC";

                    // Execute the SQL statement
                    $result = mysqli_query($connect, $sql);

                    // Fetch all the rows
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr style="border-top: 4px solid #f5f6f8;height: 80px">
                                <td>
                                    <div class="td_title"><span class="active-box">
                                        <span class="active-text">' . htmlspecialchars($row['job_status']) . '</span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="td_title">
                                        <div>
                                            <div><a href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '" class="td_job_link">' . htmlspecialchars($row['Job_Post_Title']) . '</a></div>
                                            <div style="font-size:16px;line-height:24px;">' . htmlspecialchars($row['Job_Post_Location']) . '</div>
                                            <div style="font-size:16px;line-height:24px;">Created ' . date('j F Y', strtotime($row['AdStartDate'])) . ' by ' . htmlspecialchars($_SESSION['companyData']['ContactPerson']) . ' .</div>
                                            </div>
                                    </div>
                                </td>
                                <td>
                                <div class="td_title">-</div>
                                </td>
                                <td>
                                <div class="td_title" style="width:160px;">
                                    <div style="flex-direction:row;display:flex;justify-content:end;">
                                        <div style="display:flex;justify-content:center;align-items:center;width:44px;">
                                            <a class="listlink" href=""><svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="e41a2bdd-71ff-4371-9193-37aee43f4338-delete"  role="img">
                                            <title>Delete</title><path d="M10 17c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1zm4 0c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1z"></path><path d="M20 4h-4V3c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v1H4c-.6 0-1 .4-1 1s.4 1 1 1v13c0 1.7 1.3 3 3 3h10c1.7 0 3-1.3 3-3V6c.6 0 1-.4 1-1s-.4-1-1-1zM10 3h4v1h-4V3zm8 16c0 .6-.4 1-1 1H7c-.6 0-1-.4-1-1V6h12v13z"></path></svg>
                                            </a>
                                        </div>
                                        <div style="display:flex;justify-content:center;align-items:center;width:44px;">
                                            <a class="listlink" href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '">
                                            <svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="b33ee29c-5454-4dc1-a348-be2854231b73-edit"  role="img"><title>Edit</title><path d="M20.7 4.1c-1.4-1.4-4-1.4-5.4 0l-11 11c-.1.1-.2.3-.3.5l-1 5c-.1.3 0 .7.3.9.2.2.4.3.7.3h.2l5-1c.2 0 .4-.1.5-.3l11-11c1.5-1.5 1.5-3.9 0-5.4zM8.5 18.9l-3.2.6.6-3.2 8.6-8.6 2.6 2.6-8.6 8.6zM19.3 8.1l-.8.8-2.6-2.6.8-.8c.7-.7 1.9-.7 2.6 0 .7.7.7 1.9 0 2.6z"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="continuedraft_button" style="display:none">
                                        <a href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '" class="continue_job_link">Continue draft</a>
                                    </div>
                                </div>
                            </tr>';

                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="content-div" id="closed">
        <div style="width:100%;padding-top:32px;">
            <div style="flex-direction:row;display:flex;justify-content:space-between;align-items:center;">
                <?php
                $CompanyID = null;
                if (isset($_SESSION['companyData']['CompanyID'])) {
                    $CompanyID = $_SESSION['companyData']['CompanyID'];
                }

                $searchTerm = '';
                if (isset($_GET['closedsearch'])) {
                    $searchTerm = mysqli_real_escape_string($connect, $_GET['closedsearch']);
                }

                // Prepare the SQL statement to count the total number of jobs
                $sql = "SELECT COUNT(*) as total FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Closed' AND Job_Post_Title LIKE '%$searchTerm%' ";
                $result = mysqli_query($connect, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalJobs = $row['total'];
                ?>
                <h2 class="landing_sentence3" style="width:500px">
                    <?php echo $totalJobs; ?> job
                    <?php echo $totalJobs == 1 ? 'ad' : 'ads'; ?>
                </h2>
                <div>
                    <form id="closedForm" method="GET" action="">
                        <div style="position:relative">
                            <div class="divsearchicon">
                                <span class="spansearchicon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        xml:space="preserve" focusable="false" fill="currentColor" width="16"
                                        height="16" style="width:20px;height:20px;" aria-hidden="true">
                                        <path
                                            d="M21.7 20.3 18 16.6c1.2-1.5 2-3.5 2-5.6 0-5-4-9-9-9s-9 4-9 9 4 9 9 9c2.1 0 4.1-.7 5.6-2l3.7 3.7c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4zM4 11c0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.9-.8 3.7-2 4.9-1.3 1.3-3 2-4.9 2-4 .1-7.1-3-7.1-6.9z">
                                        </path>
                                    </svg></span>
                            </div>
                            <?php
                            // Get the search term from the URL parameters
                            $searchTerm = isset($_GET['closedsearch']) ? $_GET['closedsearch'] : '';
                            ?>
                            <input id="closedInput" type="text" class="input-box" name="closedsearch"
                                style="padding-left:44px;padding-right:44px;width:512px;"
                                placeholder="Search job title or reference number"
                                value="<?php echo htmlspecialchars($searchTerm); ?>">
                            <button id="clearclosed" class="clear-button" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="width:20px;height:20px;">
                                    <path
                                        d="m13.4 12 5.3-5.3c.4-.4.4-1 0-1.4s-1-.4-1.4 0L12 10.6 6.7 5.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l5.3 5.3-5.3 5.3c-.4.4-.4 1 0 1.4.2.2.4.3.7.3s.5-.1.7-.3l5.3-5.3 5.3 5.3c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4L13.4 12z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <input type="submit" value="Search" style="display: none;">
                    </form>
                </div>
                <div style="align-items:center;display:flex;width:147px;">
                    <a href="post-job-classify.php" class="create_btn">Create a job ad</a>
                </div>
            </div>
        </div>

        <div style="width: 100%;margin: auto;height: 100%;padding-top:12px;">
            <table style="background-color: #fff;border-collapse: collapse;width: 100%;">
                <thead>
                    <tr>
                        <th style="width:97.05px">
                            <div class="th_title">Status</div>
                        </th>
                        <th>
                            <div class="th_title">Job</div>
                        </th>
                        <th style="width:146px;">
                            <div class="th_title">Candidates</div>
                        </th>
                        <th style="width:156px;">
                            <div class="th_title" style="text-align:right;">Draft Actions</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $CompanyID = null;
                    if (isset($_SESSION['companyData']['CompanyID'])) {
                        $CompanyID = $_SESSION['companyData']['CompanyID'];
                    }

                    $searchTerm = '';
                    if (isset($_GET['closedsearch'])) {
                        $searchTerm = mysqli_real_escape_string($connect, $_GET['closedsearch']);
                    }

                    // Prepare the SQL statement
                    $sql = "SELECT * FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Closed' AND Job_Post_Title LIKE '%$searchTerm%' ORDER BY AdStartDate DESC";

                    // Execute the SQL statement
                    $result = mysqli_query($connect, $sql);

                    // Fetch all the rows
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr style="border-top: 4px solid #f5f6f8;height: 80px">
                                <td>
                                    <div class="td_title"><span class="closed-box">
                                        <span class="closed-text">' . htmlspecialchars($row['job_status']) . '</span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="td_title">
                                        <div>
                                            <div><a href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '" class="td_job_link">' . htmlspecialchars($row['Job_Post_Title']) . '</a></div>
                                            <div style="font-size:16px;line-height:24px;">' . htmlspecialchars($row['Job_Post_Location']) . '</div>
                                            <div style="font-size:16px;line-height:24px;">Created ' . date('j F Y', strtotime($row['AdStartDate'])) . ' by ' . htmlspecialchars($_SESSION['companyData']['ContactPerson']) . ' .</div>
                                            </div>
                                    </div>
                                </td>
                                <td>
                                <div class="td_title">-</div>
                                </td>
                                <td>
                                <div class="td_title" style="width:160px;">
                                    <div style="flex-direction:row;display:flex;justify-content:end;">
                                        <div style="display:flex;justify-content:center;align-items:center;width:44px;">
                                            <a class="listlink" href=""><svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="e41a2bdd-71ff-4371-9193-37aee43f4338-delete"  role="img">
                                            <title>Delete</title><path d="M10 17c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1zm4 0c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1z"></path><path d="M20 4h-4V3c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v1H4c-.6 0-1 .4-1 1s.4 1 1 1v13c0 1.7 1.3 3 3 3h10c1.7 0 3-1.3 3-3V6c.6 0 1-.4 1-1s-.4-1-1-1zM10 3h4v1h-4V3zm8 16c0 .6-.4 1-1 1H7c-.6 0-1-.4-1-1V6h12v13z"></path></svg>
                                            </a>
                                        </div>
                                        <div style="display:flex;justify-content:center;align-items:center;width:44px;">
                                            <a class="listlink" href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '">
                                            <svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="b33ee29c-5454-4dc1-a348-be2854231b73-edit"  role="img"><title>Edit</title><path d="M20.7 4.1c-1.4-1.4-4-1.4-5.4 0l-11 11c-.1.1-.2.3-.3.5l-1 5c-.1.3 0 .7.3.9.2.2.4.3.7.3h.2l5-1c.2 0 .4-.1.5-.3l11-11c1.5-1.5 1.5-3.9 0-5.4zM8.5 18.9l-3.2.6.6-3.2 8.6-8.6 2.6 2.6-8.6 8.6zM19.3 8.1l-.8.8-2.6-2.6.8-.8c.7-.7 1.9-.7 2.6 0 .7.7.7 1.9 0 2.6z"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="continuedraft_button" style="display:none">
                                        <a href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '" class="continue_job_link">Continue draft</a>
                                    </div>
                                </div>
                            </tr>';

                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="content-div" id="draft">
        <div style="width:100%;padding-top:32px;">
            <div style="flex-direction:row;display:flex;justify-content:space-between;align-items:center;">
                <?php
                $CompanyID = null;
                if (isset($_SESSION['companyData']['CompanyID'])) {
                    $CompanyID = $_SESSION['companyData']['CompanyID'];
                }

                $searchTerm = '';
                if (isset($_GET['draftsearch'])) {
                    $searchTerm = mysqli_real_escape_string($connect, $_GET['draftsearch']);
                }

                // Prepare the SQL statement to count the total number of jobs
                $sql = "SELECT COUNT(*) as total FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Draft' AND Job_Post_Title LIKE '%$searchTerm%'";
                $result = mysqli_query($connect, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalJobs = $row['total'];
                ?>
                <h2 class="landing_sentence3" style="width:500px">
                    <?php echo $totalJobs; ?> draft
                    <?php echo $totalJobs == 1 ? 'ad' : 'ads'; ?>
                </h2>
                <div>
                    <form id="draftForm" method="GET" action="">
                        <div style="position:relative">
                            <div class="divsearchicon">
                                <span class="spansearchicon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        xml:space="preserve" focusable="false" fill="currentColor" width="16"
                                        height="16" style="width:20px;height:20px;" aria-hidden="true">
                                        <path
                                            d="M21.7 20.3 18 16.6c1.2-1.5 2-3.5 2-5.6 0-5-4-9-9-9s-9 4-9 9 4 9 9 9c2.1 0 4.1-.7 5.6-2l3.7 3.7c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4zM4 11c0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.9-.8 3.7-2 4.9-1.3 1.3-3 2-4.9 2-4 .1-7.1-3-7.1-6.9z">
                                        </path>
                                    </svg></span>
                            </div>
                            <?php
                            // Get the search term from the URL parameters
                            $searchTerm = isset($_GET['draftsearch']) ? $_GET['draftsearch'] : '';
                            ?>
                            <input id="draftInput" type="text" class="input-box" name="draftsearch"
                                style="padding-left:44px;padding-right:44px;width:512px;"
                                placeholder="Search job title or reference number"
                                value="<?php echo htmlspecialchars($searchTerm); ?>">
                            <button id="draftclosed" class="clear-button" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="width:20px;height:20px;">
                                    <path
                                        d="m13.4 12 5.3-5.3c.4-.4.4-1 0-1.4s-1-.4-1.4 0L12 10.6 6.7 5.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l5.3 5.3-5.3 5.3c-.4.4-.4 1 0 1.4.2.2.4.3.7.3s.5-.1.7-.3l5.3-5.3 5.3 5.3c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4L13.4 12z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <input type="submit" value="Search" style="display: none;">
                    </form>
                </div>
                <div style="align-items:center;display:flex;width:147px;">
                    <a href="post-job-classify.php" class="create_btn">Create a job ad</a>
                </div>
            </div>
        </div>

        <div style="width: 100%;margin: auto;height: 100%;padding-top:12px;">
            <table style="background-color: #fff;border-collapse: collapse;width: 100%;">
                <thead>
                    <tr>
                        <th style="width:97.05px">
                            <div class="th_title">Status</div>
                        </th>
                        <th>
                            <div class="th_title">Job</div>
                        </th>
                        <th style="width:156px;">
                            <div class="th_title" style="text-align:right;">Draft Actions</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $CompanyID = null;
                    if (isset($_SESSION['companyData']['CompanyID'])) {
                        $CompanyID = $_SESSION['companyData']['CompanyID'];
                    }

                    $searchTerm = '';
                    if (isset($_GET['draftsearch'])) {
                        $searchTerm = mysqli_real_escape_string($connect, $_GET['draftsearch']);
                    }

                    // Prepare the SQL statement
                    $sql = "SELECT * FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Draft' AND Job_Post_Title LIKE '%$searchTerm%' ORDER BY AdStartDate DESC";

                    // Execute the SQL statement
                    $result = mysqli_query($connect, $sql);

                    // Fetch all the rows
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr style="border-top: 4px solid #f5f6f8;height: 80px" >
                                <td>
                                    <div class="td_title"><span class="draft-box">
                                        <span class="draft-text">' . htmlspecialchars($row['job_status']) . '</span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="td_title">
                                        <div>
                                            <div><a href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '" class="td_job_link">' . htmlspecialchars($row['Job_Post_Title']) . '</a></div>
                                            <div style="font-size:16px;line-height:24px;">' . htmlspecialchars($row['Job_Post_Location']) . '</div>
                                            <div style="font-size:16px;line-height:24px;">Created ' . date('j F Y', strtotime($row['AdStartDate'])) . ' by ' . htmlspecialchars($_SESSION['companyData']['ContactPerson']) . ' .</div>
                                            </div>
                                    </div>
                                </td>
                                <td>
                                <div class="td_title" style="width:160px;">
                                    <div style="flex-direction:row;display:flex;justify-content:end;">
                                        <div style="display:flex;justify-content:center;align-items:center;width:44px;">
                                            <a class="listlink" href=""><svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="e41a2bdd-71ff-4371-9193-37aee43f4338-delete"  role="img">
                                            <title>Delete</title><path d="M10 17c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1zm4 0c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1z"></path><path d="M20 4h-4V3c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v1H4c-.6 0-1 .4-1 1s.4 1 1 1v13c0 1.7 1.3 3 3 3h10c1.7 0 3-1.3 3-3V6c.6 0 1-.4 1-1s-.4-1-1-1zM10 3h4v1h-4V3zm8 16c0 .6-.4 1-1 1H7c-.6 0-1-.4-1-1V6h12v13z"></path></svg>
                                            </a>
                                        </div>
                                        <div style="display:flex;justify-content:center;align-items:center;width:44px;">
                                            <a class="listlink" href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '">
                                            <svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="b33ee29c-5454-4dc1-a348-be2854231b73-edit"  role="img"><title>Edit</title><path d="M20.7 4.1c-1.4-1.4-4-1.4-5.4 0l-11 11c-.1.1-.2.3-.3.5l-1 5c-.1.3 0 .7.3.9.2.2.4.3.7.3h.2l5-1c.2 0 .4-.1.5-.3l11-11c1.5-1.5 1.5-3.9 0-5.4zM8.5 18.9l-3.2.6.6-3.2 8.6-8.6 2.6 2.6-8.6 8.6zM19.3 8.1l-.8.8-2.6-2.6.8-.8c.7-.7 1.9-.7 2.6 0 .7.7.7 1.9 0 2.6z"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="continuedraft_button" style="display:none">
                                        <a href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '" class="continue_job_link">Continue draft</a>
                                    </div>
                                </div>
                            </tr>';

                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    // Free the result set and close the connection
    mysqli_free_result($result);
    mysqli_close($connect);
    ?>

    </div>

    <script src="post-job.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var buttons = document.querySelectorAll('.joblistbtn');
            var underline = document.querySelector('.underline');
            var divs = [document.getElementById('active'), document.getElementById('closed'), document.getElementById('draft')];

            // Function to update the visibility of the divs based on the id in the URL
            function updateDivVisibility() {
                // Hide all divs
                divs.forEach(function (div) {
                    div.style.display = 'none';
                });

                // Remove the 'active' class from all buttons
                buttons.forEach(function (btn) {
                    btn.classList.remove('active');
                });

                // Get the id from the URL
                var id = window.location.href.split('#')[1];

                // If there's no id in the URL, default to 'active'
                if (!id) {
                    id = 'active';
                }

                // Show the div that matches the id in the URL and add the 'active' class to the associated button
                if (id) {
                    document.getElementById(id).style.display = 'block';
                    document.getElementById(id + 'Button').classList.add('active');

                    // Update the underline
                    var activeButton = document.getElementById(id + 'Button');
                    underline.style.width = activeButton.offsetWidth + 'px';
                    underline.style.left = activeButton.offsetLeft + 'px';
                }
            }

            // Update the visibility of the divs when the DOM content is loaded
            updateDivVisibility();

            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    // Add the button id to the URL
                    var id = this.id.replace('Button', '');
                    window.history.pushState(null, null, '#' + id);

                    // Update the visibility of the divs, the underline, and the 'active' class
                    updateDivVisibility();
                });
            });
        });
    </script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            // Get the elements
            var clearactive = document.getElementById('clearactive');
            var activeInput = document.getElementById('activeInput');

            // Hide the clear button initially
            clearactive.style.display = 'none';

            // Show/hide the clear button when the input box content changes
            activeInput.addEventListener('input', function () {
                if (this.value) {
                    clearactive.style.display = 'flex';
                } else {
                    clearactive.style.display = 'none';
                }
            });

            // Clear the input box when the clear button is clicked
            clearactive.addEventListener('click', function (e) {
                e.preventDefault();
                activeInput.value = '';
                // Manually trigger the input event
                var event = new Event('input', {
                    bubbles: true,
                    cancelable: true,
                });
                activeInput.dispatchEvent(event);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Get the elements
            var clearclosed = document.getElementById('clearclosed');
            var closedInput = document.getElementById('closedInput');

            // Hide the clear button initially
            clearclosed.style.display = 'none';

            // Show/hide the clear button when the input box content changes
            closedInput.addEventListener('input', function () {
                if (this.value) {
                    clearclosed.style.display = 'inline';
                } else {
                    clearclosed.style.display = 'none';
                }
            });

            // Clear the input box when the clear button is clicked
            clearclosed.addEventListener('click', function (e) {
                e.preventDefault();
                closedInput.value = '';
                // Manually trigger the input event
                var event = new Event('input', {
                    bubbles: true,
                    cancelable: true,
                });
                closedInput.dispatchEvent(event);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Get the elements
            var clearButton = document.getElementById('draftclosed');
            var draftInput = document.getElementById('draftInput');

            // Hide the clear button initially
            clearButton.style.display = 'none';

            // Show/hide the clear button when the input box content changes
            draftInput.addEventListener('input', function () {
                if (this.value) {
                    clearButton.style.display = 'inline';
                } else {
                    clearButton.style.display = 'none';
                }
            });

            // Clear the input box when the clear button is clicked
            clearButton.addEventListener('click', function (e) {
                e.preventDefault();
                draftInput.value = '';
                // Manually trigger the input event
                var event = new Event('input', {
                    bubbles: true,
                    cancelable: true,
                });
                draftInput.dispatchEvent(event);
            });
        });
    </script>

</body>

</html>