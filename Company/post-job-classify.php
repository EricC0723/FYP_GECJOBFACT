<!DOCTYPE html>

<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
?>

<?php
session_start();
if (isset($_SESSION['job_post_ID'])) {
    // Check if the job_post_ID is not already in the URL
    $job_post_ID = $_SESSION['job_post_ID'];

    if (!isset($_GET['jobPostID'])) {
        // Redirect to the current page with the job_post_ID in the URL
        header("Location: post-job-classify.php?jobPostID=$job_post_ID");
        exit;
    }
}

$CompanyID = null;
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST["submitbtn"])) {
    // Retrieve the form data
    $jobTitle = $_POST['jobTitle'];
    $jobLocationID = $_POST['jobLocationId'];
    $jobLocation = $_POST['jobLocation'];
    $jobSpecialisationID = $_POST['jobSpecialisationId'];
    $jobSpecialisation = $_POST['jobSpecialisation'];
    $jobRoleID = $_POST['jobRoleId'];
    $jobRole = $_POST['jobRole'];
    $jobType = $_POST['jobType'];
    $jobPosition = $_POST['Jobposition'];
    $jobRequiredyears = $_POST['requiredexperience'];
    $jobSalaryMin = $_POST['jobSalaryMin'];
    $jobSalaryMax = $_POST['jobSalaryMax'];

    if (isset($_GET['jobPostID'])) {
        // Update the existing job post
        $postid = $_GET["jobPostID"];
        $sql = "UPDATE job_post SET Job_Post_Title = '$jobTitle', Job_Location_ID = '$jobLocationID', Job_Post_Location = '$jobLocation', Main_Category_ID = '$jobSpecialisationID', Main_Category_Name = '$jobSpecialisation', Sub_Category_ID = '$jobRoleID', Sub_Category_Name = '$jobRole', Job_Post_Type = '$jobType', Job_Post_Position = '$jobPosition', Job_Post_Exp = '$jobRequiredyears', Job_Post_MinSalary = '$jobSalaryMin', Job_Post_MaxSalary = '$jobSalaryMax', CompanyID = '$CompanyID' WHERE Job_Post_ID = '$postid'";
        $result = mysqli_query($connect, $sql);
        if ($result) {

            // Store the job_post_ID in the session
            $_SESSION['job_post_ID'] = $postid;

            if ($_POST['isQSubmit'] === '1') {
                // Redirect to 'post-job-classify.php' if the form was submitted via JavaScript
                echo "<script type='text/javascript'>window.location.href = 'post-job-question.php?jobPostID=" . $job_post_ID . "';</script>";
            } else {
                // Normal redirect
                echo "<script type='text/javascript'>window.location.href = 'post-job-write.php?jobPostID=$postid';</script>";
            }
            exit;
            // Redirect to the next page

        }
    } else {
        // Insert a new job post
        $sql = "INSERT INTO job_post (Job_Post_Title, Job_Location_ID, Job_Post_Location, Main_Category_ID, Main_Category_Name, Sub_Category_ID, Sub_Category_Name, Job_Post_Type, Job_Post_Position, Job_Post_Exp, Job_Post_MinSalary, Job_Post_MaxSalary, CompanyID) VALUES ('$jobTitle', '$jobLocationID', '$jobLocation', '$jobSpecialisationID', '$jobSpecialisation', '$jobRoleID', '$jobRole', '$jobType', '$jobPosition', '$jobRequiredyears', '$jobSalaryMin', '$jobSalaryMax', '$CompanyID')";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            // Get the ID of the new job post
            $job_post_ID = mysqli_insert_id($connect);
            // Store the job_post_ID in the session
            $_SESSION['job_post_ID'] = $job_post_ID;
            // Redirect to the next page
            echo "<script type='text/javascript'>window.location.href = 'post-job-write.php';</script>";
            exit;
        }
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classify</title>
    <link rel="stylesheet" type="text/css" href="post-job.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
</head>

<body class="postjob_body">
    <header class="postjob_header">
        <div class="container">
            <div class="logo">
                <a href="company_landing.php" class="postjob_link"><img style="width:150px;" src="logo.png"
                        alt="Logo"></a>
            </div>
            <div class="logo-nav">
                <nav style="display:flex">
                    <span class="header-link"><a href="company_landing.php">Home</a></span>
                    <span class="header-link"><a href="job-listing.php">Jobs</a></span>
                </nav>
            </div>
            <div style="flex:1 1 auto;"></div>

            <div style="padding:0 20px">
                <div class="flex-container">
                    <div class="dropdown">
                        <div style="display: flex; align-items: center;">
                            <a href="#profile" onclick="toggleDropdown(event)" class="dropdown-title">
                                <?php echo isset($row['CompanyName']) ? $row['CompanyName'] : 'User Profile'; ?> <svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16"
                                    class="uatjxz0 bpnsn50 t0qjk721 chw1r94y ygcmz4c _140w0y32" aria-hidden="true"
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
                                <?php echo isset($row['CompanyName']) ? $row['CompanyName'] : 'User Profile'; ?>
                            </span>
                            <div style="padding-top:10px;">
                                <span class="contactPerson">
                                    <?php echo isset($row['ContactPerson']) ? $row['ContactPerson'] : 'Contact Person'; ?>
                                </span>
                            </div>
                            <div style="padding-top: 10px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="company_profile.php" class="dropdown-link">Accounts
                                    details</a></div>
                            <div style="padding-top: 12px;"><a href="company_creditcard.php" class="dropdown-link">Card
                                    Payment</a></div>

                            <div style="padding-top: 12px;"><a href="payment_history.php" class="dropdown-link">Payment
                                    History</a>
                            </div>
                            <div style="padding-top: 20px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="company_contactus.php"
                                    class="dropdown-link">Contact us</a>
                            </div>
                            <div style="padding-top: 12px;"><a id="signout-link" href="company_signout.php"
                                    class="dropdown-link">Sign out</a></div>
                        </div>
                    </div>
                    <div class="add_button">
                        <a href="post-job-classify.php" class="create_job_link">Create a job ad</a>
                    </div>
                </div>
            </div>

    </header>

    <div
        style="width:100%;height:155px;background:white;box-shadow:rgba(28, 35, 48, 0.1) 0px 2px 4px 0px, rgba(28, 35, 48, 0.1) 0px 2px 2px -2px, rgba(28, 35, 48, 0.2) 0px 4px 4px -4px;">
        <div class="container">
            <div style="max-width:687px;width:100%;margin:0 auto;padding-bottom:20px">
                <div style="width:100%;padding:24px 0;">
                    <div>
                        <h3 class="landing_sentence1">Create a job ad
                        </h3>
                    </div>
                    <div style="padding-top:20px;">
                        <div style="padding:0 32px;display:flex;">
                            <div style="position:relative;">
                                <div style="width:24px"><svg width="24px" height="24px" viewBox="0 0 24 24"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <g id="Beta-CAJA--—-EDITS/-HELP/-ERRORS.-LW" stroke="none" stroke-width="1"
                                            fill="none" fill-rule="evenodd">
                                            <g id="Beta--Classify-VD" transform="translate(-193.000000, -131.000000)">ß
                                                <g id="Header-">
                                                    <g id="Progress-bar-" transform="translate(0.000000, 68.000000)">
                                                        <g id="Group-2-Copy"
                                                            transform="translate(176.000000, 62.000000)">
                                                            <g id="plus" transform="translate(0.000000, 1.000000)">
                                                                <g id="now" transform="translate(17.000000, 0.000000)">
                                                                    <g id="Group-7">
                                                                        <circle id="Oval-Copy-135" stroke="#2765CF"
                                                                            stroke-width="3" fill="#FFFFFF" cx="12"
                                                                            cy="12" r="10.5"></circle>
                                                                        <circle id="Oval-Copy-135" fill="#2765CF"
                                                                            cx="12" cy="12" r="6"></circle>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg></div>
                                <div class="page_title"><span class="landing_sentence2"
                                        style="font-weight:600">Classify</span>
                                </div>
                            </div>
                            <?php
                            if (isset($_SESSION['job_post_ID']) || isset($_GET['jobPostID'])) {
                                if (isset($_SESSION['job_post_ID'])) {
                                    $job_post_ID = $_SESSION['job_post_ID'];
                                    // Set session variable
                                } else {
                                    $job_post_ID = $_GET['jobPostID'];
                                }
                                $sqlcheck = "SELECT * FROM job_post WHERE Job_Post_ID = $job_post_ID";
                                $resultcheck = mysqli_query($connect, $sqlcheck);
                                $rowc = mysqli_fetch_assoc($resultcheck);
                                // Assuming you have a $row variable that contains the data from the database
                            
                                if ($rowc['Job_Post_Description'] !== null && $rowc['Job_Post_Responsibilities'] !== null && $rowc['Job_Post_Benefits'] !== null && $rowc['Job_Logo_Url'] !== null) {
                                    // Print the code if none of the columns are null
                                    $_SESSION['job_post_ID'] = $job_post_ID;

                                    ?>
                                    <div style="flex-grow:1;">
                                        <div class="solid-line"></div>
                                    </div>
                                    <script>
                                        function writedirect() {
                                            document.getElementById('submitbtn').click();
                                        }
                                    </script>
                                    <div style="position:relative;cursor:pointer;" onclick="writedirect()">
                                        <div style="width:24px"><svg width="24px" height="24px" viewBox="0 0 24 24"
                                                version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <desc>Created with Sketch.</desc>
                                                <g id="Beta-CAJA--—-EDITS/-HELP/-ERRORS.-LW" stroke="none" stroke-width="1"
                                                    fill="none" fill-rule="evenodd">
                                                    <g id="Beta--guided-VD" transform="translate(-193.000000, -130.000000)">
                                                        <g id="Header-">
                                                            <g id="Progress-bar-" transform="translate(0.000000, 68.000000)">
                                                                <g id="Group-2-Copy"
                                                                    transform="translate(176.000000, 62.000000)">
                                                                    <g id="plus">
                                                                        <g id="done" transform="translate(17.000000, 0.000000)">
                                                                            <g id="Group-3">
                                                                                <circle id="Oval" fill="#FFFFFF" cx="12" cy="12"
                                                                                    r="10"></circle>
                                                                                <path
                                                                                    d="M12,0 C5.36374948,0 0,5.36374948 0,12 C0,18.6362505 5.36374948,24 12,24 C18.6362505,24 24,18.6362505 24,12 C24,5.36374948 18.6362505,0 12,0 Z M10.3128439,17.4201576 C10.0914199,17.6415816 9.81490391,17.7517489 9.53839347,17.7517489 C9.26188304,17.7517489 8.9853726,17.6415761 8.76394304,17.4201576 L4.45093322,13.1060418 L6.02682151,11.5301535 L9.51140606,15.0697636 L17.4201576,7.16101203 L18.9960459,8.73690032 L10.3128439,17.4201576 Z"
                                                                                    id="Shape" fill="#747474"
                                                                                    fill-rule="nonzero"></path>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg></div>
                                        <div class="page_title"><span class="landing_sentence2">Write</span>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    // Print other code if any of the columns are null
                                    ?>
                                    <div style="flex-grow:1;">
                                        <div class="dotted-line"></div>
                                    </div>
                                    <div style="position:relative;">
                                        <div style="width:24px"><svg width="24px" height="25px" viewBox="0 0 24 25"
                                                version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <g id="Beta-CAJA--—-EDITS/-HELP/-ERRORS.-LW" stroke="none" stroke-width="1"
                                                    fill="none" fill-rule="evenodd">
                                                    <g id="Beta--Classify-VD" transform="translate(-486.000000, -130.000000)"
                                                        fill="#FFFFFF" stroke="#D6D6D6" stroke-width="4">
                                                        <g id="Header-">
                                                            <g id="Progress-bar-" transform="translate(0.000000, 68.000000)">
                                                                <g id="Group-2-Copy"
                                                                    transform="translate(176.000000, 62.000000)">
                                                                    <g id="plus-copy"
                                                                        transform="translate(303.000000, 0.000000)">
                                                                        <g id="emty" transform="translate(7.000000, 0.000000)">
                                                                            <ellipse id="Oval-Copy-135" cx="12" cy="12.5"
                                                                                rx="10" ry="10.5"></ellipse>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg></div>
                                        <div class="page_title"><span class="landing_sentence2">Write</span>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div style="flex-grow:1;">
                                    <div class="dotted-line"></div>
                                </div>
                                <div style="position:relative;">
                                    <div style="width:24px"><svg width="24px" height="25px" viewBox="0 0 24 25"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Beta-CAJA--—-EDITS/-HELP/-ERRORS.-LW" stroke="none" stroke-width="1"
                                                fill="none" fill-rule="evenodd">
                                                <g id="Beta--Classify-VD" transform="translate(-486.000000, -130.000000)"
                                                    fill="#FFFFFF" stroke="#D6D6D6" stroke-width="4">
                                                    <g id="Header-">
                                                        <g id="Progress-bar-" transform="translate(0.000000, 68.000000)">
                                                            <g id="Group-2-Copy"
                                                                transform="translate(176.000000, 62.000000)">
                                                                <g id="plus-copy"
                                                                    transform="translate(303.000000, 0.000000)">
                                                                    <g id="emty" transform="translate(7.000000, 0.000000)">
                                                                        <ellipse id="Oval-Copy-135" cx="12" cy="12.5"
                                                                            rx="10" ry="10.5"></ellipse>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg></div>
                                    <div class="page_title"><span class="landing_sentence2">Write</span>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            if (isset($_SESSION['job_post_ID']) || isset($_GET['jobPostID'])) {
                                if (isset($_SESSION['job_post_ID'])) {
                                    $job_post_ID = $_SESSION['job_post_ID'];
                                } else {
                                    $job_post_ID = $_GET['jobPostID'];
                                }
                                $sqlcheck = "SELECT * FROM job_post_questions WHERE JobID = $job_post_ID";
                                $resultcheck = mysqli_query($connect, $sqlcheck);

                                if (mysqli_num_rows($resultcheck) > 0) {
                                    // Print the code if none of the columns are null
                                    $_SESSION['job_post_ID'] = $job_post_ID;

                                    ?>
                                    <div style="flex-grow:1;">
                                        <div class="solid-line"></div>
                                    </div>
                                    <script>
                                        function questiondirect() {
                                            document.getElementById('isQSubmit').value = '1';
                                            document.getElementById('submitbtn').click();
                                        }
                                    </script>
                                    <div style="position:relative;cursor:pointer;" onclick="questiondirect()">
                                        <div style="width:24px"><svg width="24px" height="24px" viewBox="0 0 24 24"
                                                version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <desc>Created with Sketch.</desc>
                                                <g id="Beta-CAJA--—-EDITS/-HELP/-ERRORS.-LW" stroke="none" stroke-width="1"
                                                    fill="none" fill-rule="evenodd">
                                                    <g id="Beta--guided-VD" transform="translate(-193.000000, -130.000000)">
                                                        <g id="Header-">
                                                            <g id="Progress-bar-" transform="translate(0.000000, 68.000000)">
                                                                <g id="Group-2-Copy"
                                                                    transform="translate(176.000000, 62.000000)">
                                                                    <g id="plus">
                                                                        <g id="done" transform="translate(17.000000, 0.000000)">
                                                                            <g id="Group-3">
                                                                                <circle id="Oval" fill="#FFFFFF" cx="12" cy="12"
                                                                                    r="10"></circle>
                                                                                <path
                                                                                    d="M12,0 C5.36374948,0 0,5.36374948 0,12 C0,18.6362505 5.36374948,24 12,24 C18.6362505,24 24,18.6362505 24,12 C24,5.36374948 18.6362505,0 12,0 Z M10.3128439,17.4201576 C10.0914199,17.6415816 9.81490391,17.7517489 9.53839347,17.7517489 C9.26188304,17.7517489 8.9853726,17.6415761 8.76394304,17.4201576 L4.45093322,13.1060418 L6.02682151,11.5301535 L9.51140606,15.0697636 L17.4201576,7.16101203 L18.9960459,8.73690032 L10.3128439,17.4201576 Z"
                                                                                    id="Shape" fill="#747474"
                                                                                    fill-rule="nonzero"></path>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg></div>
                                        <div class="page_title"><span class="landing_sentence2">Question</span>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    // Print other code if any of the columns are null
                                    ?>
                                    <div style="flex-grow:1;">
                                        <div class="dotted-line"></div>
                                    </div>
                                    <div style="position:relative;">
                                        <div style="width:24px"><svg width="24px" height="25px" viewBox="0 0 24 25"
                                                version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <g id="Beta-CAJA--—-EDITS/-HELP/-ERRORS.-LW" stroke="none" stroke-width="1"
                                                    fill="none" fill-rule="evenodd">
                                                    <g id="Beta--Classify-VD" transform="translate(-486.000000, -130.000000)"
                                                        fill="#FFFFFF" stroke="#D6D6D6" stroke-width="4">
                                                        <g id="Header-">
                                                            <g id="Progress-bar-" transform="translate(0.000000, 68.000000)">
                                                                <g id="Group-2-Copy"
                                                                    transform="translate(176.000000, 62.000000)">
                                                                    <g id="plus-copy"
                                                                        transform="translate(303.000000, 0.000000)">
                                                                        <g id="emty" transform="translate(7.000000, 0.000000)">
                                                                            <ellipse id="Oval-Copy-135" cx="12" cy="12.5"
                                                                                rx="10" ry="10.5"></ellipse>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg></div>
                                        <div class="page_title"><span class="landing_sentence2">Question</span>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div style="flex-grow:1;">
                                    <div class="dotted-line"></div>
                                </div>
                                <div style="position:relative;">
                                    <div style="width:24px"><svg width="24px" height="25px" viewBox="0 0 24 25"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Beta-CAJA--—-EDITS/-HELP/-ERRORS.-LW" stroke="none" stroke-width="1"
                                                fill="none" fill-rule="evenodd">
                                                <g id="Beta--Classify-VD" transform="translate(-486.000000, -130.000000)"
                                                    fill="#FFFFFF" stroke="#D6D6D6" stroke-width="4">
                                                    <g id="Header-">
                                                        <g id="Progress-bar-" transform="translate(0.000000, 68.000000)">
                                                            <g id="Group-2-Copy"
                                                                transform="translate(176.000000, 62.000000)">
                                                                <g id="plus-copy"
                                                                    transform="translate(303.000000, 0.000000)">
                                                                    <g id="emty" transform="translate(7.000000, 0.000000)">
                                                                        <ellipse id="Oval-Copy-135" cx="12" cy="12.5"
                                                                            rx="10" ry="10.5"></ellipse>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg></div>
                                    <div class="page_title"><span class="landing_sentence2">Question</span>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-container" style="margin-top:10px;padding-top:32px">

        <?php
        if (isset($_GET['jobPostID'])) {
            $postid = $_GET["jobPostID"];
            $result = mysqli_query($connect, "SELECT * FROM job_post WHERE Job_Post_ID = '$postid' ");
            $row = mysqli_fetch_assoc($result);
        }
        ?>

        <form method="POST" id="classify">
            <div class="header-title">
                <span
                    style="color: rgb(46, 56, 73);font-size: 36px;font-style: normal;font-weight: 600;line-height: 36px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Classify
                    your role</span>
            </div>
            <div class="form-style" style="margin-top:22px;">
                <div>
                    <span
                        style="color: rgb(46, 56, 73);font-size: 28px;font-style: normal;font-weight: 600;line-height: 28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Role
                        Information</span>
                </div>
                <div class="form-group">
                    <label for="jobTitle" class="question" style="padding-bottom: 8px;">Job Title</label>
                    <input type="text" id="jobTitle" name="jobTitle" class="input-box" placeholder="Enter the job title"
                        value="<?php echo isset($row['Job_Post_Title']) ? htmlspecialchars($row['Job_Post_Title']) : ''; ?>">

                    <div style="padding-top:4px;" id="validation-title" class="hide"><span style="display:flex"><span
                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="color:#b91e1e">
                                    <path
                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                    </path>
                                    <circle cx="12" cy="17" r="1"></circle>
                                    <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                    </path>
                                </svg></span><span><span id="title-message" class="validation_sentence">Please add job
                                    title</span></span></span></div>
                </div>
                <div class="vertical-space"></div>
                <div class="form-group">
                    <label for="jobLocation" class="question" style="padding-bottom: 8px;">Location</label>
                    <input id="jobLocation" name="jobLocation" class="form-dropdown"
                        style="height: 24px;width:578.672px;" placeholder="Select state"
                        value="<?php echo isset($row['Job_Post_Location']) ? htmlspecialchars($row['Job_Post_Location']) : ''; ?>">
                    <input type="hidden" id="jobLocationId" name="jobLocationId"
                        value="<?php echo isset($row['Job_Location_ID']) ? htmlspecialchars($row['Job_Location_ID']) : ''; ?>">
                    <div style="padding-top:4px;" id="validation-location" class="hide"><span style="display:flex"><span
                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="color:#b91e1e">
                                    <path
                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                    </path>
                                    <circle cx="12" cy="17" r="1"></circle>
                                    <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                    </path>
                                </svg></span><span><span id="location-message" class="validation_sentence">Please select
                                    a location</span></span></span></div>
                </div>
                <div class="vertical-space"></div>
                <div class="form-group">
                    <label class="question" style="padding-bottom: 8px;">Job Position</label>
                    <select class="form-dropdown" name="Jobposition" id="jobposition"
                        style="height:46px;width:604.67px;">
                        <option value="" disabled selected>Select a position level</option>
                        <?php
                        $positions = ["Senior manager", "Manager", "Senior Executive", "Junior Executive", "Entry Level", "Non-Executive"];
                        foreach ($positions as $position) {
                            echo '<option value="' . $position . '"';
                            if (isset($row['Job_Post_Position']) && $row['Job_Post_Position'] == $position) {
                                echo ' selected';
                            }
                            echo '>' . $position . '</option>';
                        }
                        ?>
                    </select>
                    <div style="padding-top:4px;" id="validation-jobposition" class="hide"><span
                            style="display:flex"><span
                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="color:#b91e1e">
                                    <path
                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                    </path>
                                    <circle cx="12" cy="17" r="1"></circle>
                                    <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                    </path>
                                </svg></span><span><span id="position-message" class="validation_sentence">Required
                                    Please select a position</span></span></span></div>
                </div>
                <div class="vertical-space"></div>

                <div class="form-group">
                    <label class="question" style="padding-bottom: 8px;">Required years of experience</label>
                    <select class="form-dropdown" name="requiredexperience" id="requiredexperience"
                        style="height:46px;width:604.67px;">
                        <option value="" disabled selected>Select required years of experience</option>
                        <?php
                        $selectedExperience = isset($row['Job_Post_Exp']) ? $row['Job_Post_Exp'] : '';
                        echo '<option value="Not required"' . ($selectedExperience == 'Not required' ? ' selected' : '') . '>Not required</option>';
                        for ($i = 1; $i <= 20; $i++) {
                            $years = $i . ' Year' . ($i > 1 ? 's' : '');
                            echo '<option value="' . $years . '"' . ($selectedExperience == $years ? ' selected' : '') . '>' . $years . ' and above</option>';
                        }
                        ?>
                    </select>
                    <div style="padding-top:4px;" id="validation-requiredexperience" class="hide"><span
                            style="display:flex"><span
                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="color:#b91e1e">
                                    <path
                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                    </path>
                                    <circle cx="12" cy="17" r="1"></circle>
                                    <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                    </path>
                                </svg></span><span><span id="requiredexperience-message"
                                    class="validation_sentence">Please select the required years of
                                    experience</span></span></span></div>
                </div>
                <div class="vertical-space"></div>

                <div class="form-group">
                    <label for="jobSpecialisation" class="question">Category</label>
                    <label for="jobSpecialisation" class="question"
                        style="padding-bottom: 8px;font-weight: 400;color: rgb(90, 104, 129);">Suggested category based
                        on your job title</label>
                    <input id="jobSpecialisation" name="jobSpecialisation" class="form-dropdown"
                        style="height: 24px;width:578.672px;" placeholder="Select a category"
                        value="<?php echo isset($row['Main_Category_Name']) ? htmlspecialchars($row['Main_Category_Name']) : ''; ?>">
                    <input type="hidden" id="jobSpecialisationId" name="jobSpecialisationId"
                        value="<?php echo isset($row['Main_Category_ID']) ? htmlspecialchars($row['Main_Category_ID']) : ''; ?>">

                    <div style="padding-top:4px;" id="validation-maincat" class="hide"><span style="display:flex"><span
                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="color:#b91e1e">
                                    <path
                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                    </path>
                                    <circle cx="12" cy="17" r="1"></circle>
                                    <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                    </path>
                                </svg></span><span><span id="maincat-message" class="validation_sentence">Please select
                                    the job category</span></span></span></div>
                    <div id="JobRole">
                        <input id="jobRole" name="jobRole" class="form-dropdown"
                            style="height: 24px;width:578.672px;margin-top: 10px;" placeholder="Select a sub category"
                            value="<?php echo isset($row['Sub_Category_Name']) ? htmlspecialchars($row['Sub_Category_Name']) : ''; ?>">
                        <input type="hidden" id="jobRoleId" name="jobRoleId"
                            value="<?php echo isset($row['Sub_Category_ID']) ? htmlspecialchars($row['Sub_Category_ID']) : ''; ?>">

                        <div style="padding-top:4px;" id="validation-subcat" class="hide"><span
                                style="display:flex"><span
                                    style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                        focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                        style="color:#b91e1e">
                                        <path
                                            d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                        </path>
                                        <circle cx="12" cy="17" r="1"></circle>
                                        <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                        </path>
                                    </svg></span><span><span id="subcat-message" class="validation_sentence">Please
                                        select the job role</span></span></span></div>
                    </div>

                </div>
                <div class="vertical-space"></div>
                <div class="form-group">
                    <label for="jobType" class="question">Work type</label>
                    <div style="height: 10px;"></div>
                    <div class="radio-option">
                        <input type="radio" id="type1" name="jobType" value="1" onclick="boldOption1(this)" <?php echo isset($row['Job_Post_Type']) && $row['Job_Post_Type'] == 1 ? 'checked' : ''; ?>>
                        <label for="type1" class="option">Full-Time</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="type2" name="jobType" value="2" onclick="boldOption1(this)" <?php echo isset($row['Job_Post_Type']) && $row['Job_Post_Type'] == 2 ? 'checked' : ''; ?>>
                        <label for="type2" class="option">Part-Time</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="type3" name="jobType" value="3" onclick="boldOption1(this)" <?php echo isset($row['Job_Post_Type']) && $row['Job_Post_Type'] == 3 ? 'checked' : ''; ?>>
                        <label for="type3" class="option">Internship</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="type4" name="jobType" value="4" onclick="boldOption1(this)" <?php echo isset($row['Job_Post_Type']) && $row['Job_Post_Type'] == 4 ? 'checked' : ''; ?>>
                        <label for="type4" class="option">Contract</label>
                    </div>
                    <div style="padding-top:4px;width:299px;" id="validation-jobtype" class="hide"><span
                            style="display:flex"><span
                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="color:#b91e1e">
                                    <path
                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                    </path>
                                    <circle cx="12" cy="17" r="1"></circle>
                                    <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                    </path>
                                </svg></span><span><span id="jobtype-message" class="validation_sentence">Please select
                                    job type</span></span></span></div>
                </div>
            </div>

            <div class="form-style" style="margin-top:32px;">
                <div>
                    <span
                        style="color: rgb(46, 56, 73);font-size: 28px;font-style: normal;font-weight: 600;line-height: 28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Pay
                        Details</span>
                </div>
                <!-- <div class="form-group">
                    <label for="Paytype" class="question">Pay Type</label>
                    <div style="height: 10px;"></div>
                    <div class="radio-option">
                        <input type="radio" id="pay1" name="Paytype" value="1" onclick="boldOption2(this)" checked>
                        <label for="pay1" class="option">Hourly Rate</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="pay2" name="Paytype" value="2" onclick="boldOption2(this)">
                        <label for="pay2" class="option">Monthly Salary</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="pay3" name="Paytype" value="3" onclick="boldOption2(this)">
                        <label for="pay3" class="option">Annual Salary</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="pay4" name="Paytype" value="4" onclick="boldOption2(this)">
                        <label for="pay4" class="option">Annual plus commission</label>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="jobSalary" class="question" style="padding-bottom: 8px;">Pay Range</label>
                    <label for="jobSpecialisation" class="question"
                        style="padding-bottom: 8px;font-weight: 400;color: rgb(90, 104, 129);">Enter a range to offer
                        candidates. If pay is an exact amount, enter the same in both fields.</label>
                    <div style="display: flex; align-items: flex-start;">
                        <div style="margin-right: 10px;">
                            <div style="padding-bottom: 8px;">
                                <label for="jobSalaryMin" class="question">From</label>
                            </div>
                            <div>
                                <input type="text" id="jobSalaryMin" name="jobSalaryMin" class="input-box"
                                    placeholder="Min" style="height: 22px;width:273px;"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 1 && this.value.startsWith('0')) { this.value = this.value.substring(1); }"
                                    value="<?php echo isset($row['Job_Post_MinSalary']) ? htmlspecialchars($row['Job_Post_MinSalary']) : ''; ?>">
                                <div style="padding-top:4px;width:299px;" id="validation-minsal" class="hide"><span
                                        style="display:flex"><span
                                            style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                xml:space="preserve" focusable="false" fill="currentColor" width="16"
                                                height="16" aria-hidden="true" style="color:#b91e1e">
                                                <path
                                                    d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                </path>
                                                <circle cx="12" cy="17" r="1"></circle>
                                                <path
                                                    d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                </path>
                                            </svg></span><span><span id="minsal-message"
                                                class="validation_sentence">Enter minimum pay</span></span></span></div>
                            </div>
                        </div>
                        <div>
                            <div style="padding-bottom: 8px;">
                                <label for="jobSalaryMax" class="question">To</label>
                            </div>
                            <div>
                                <input type="text" id="jobSalaryMax" name="jobSalaryMax" class="input-box"
                                    placeholder="Max" style="height: 22px;width:273px;"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 1 && this.value.startsWith('0')) { this.value = this.value.substring(1); }"
                                    value="<?php echo isset($row['Job_Post_MaxSalary']) ? htmlspecialchars($row['Job_Post_MaxSalary']) : ''; ?>">
                                <div style="padding-top:4px;width:299px;" id="validation-maxsal" class="hide"><span
                                        style="display:flex"><span
                                            style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                xml:space="preserve" focusable="false" fill="currentColor" width="16"
                                                height="16" aria-hidden="true" style="color:#b91e1e">
                                                <path
                                                    d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                </path>
                                                <circle cx="12" cy="17" r="1"></circle>
                                                <path
                                                    d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                </path>
                                            </svg></span><span><span id="maxsal-message"
                                                class="validation_sentence">Enter maximum pay</span></span></span></div>
                            </div>
                        </div>

                    </div>
                    <div style="padding-top:4px;" id="validation-totalsalary" class="hide"><span
                            style="display:flex"><span
                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="color:#b91e1e">
                                    <path
                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                    </path>
                                    <circle cx="12" cy="17" r="1"></circle>
                                    <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                    </path>
                                </svg></span><span><span id="totalsalary-message"
                                    class="validation_sentence"></span></span></span></div>
                </div>


            </div>
            <div class="form-group" style="display: block;">
                <input type="hidden" id="isQSubmit" name="isQSubmit" value="0">

                <input type="submit" value="Continue" class="cont-button" name="submitbtn" id="submitbtn">
                <!-- <input type="submit" value="Save draft" class="save-button" style="margin-left:4px"> -->
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="post-job.js"></script>
    <script src="post-job-classify-validation.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('signout-link').addEventListener('click', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to sign out.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, sign out!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        });

        $.ui.autocomplete.filter = function (array, term) {
            var matcher = new RegExp($.ui.autocomplete.escapeRegex(term), "i");
            return $.grep(array, function (value) {
                return matcher.test(value.label || value.value || value);
            });
        };

        var specialisationSelected = false; // flag to indicate if an option was selected
        var selectedspecialisationLabel = ''; // variable to store the label of the selected item

        var roleSelected = false; // flag to indicate if an option was selected
        var selectedroleLabel = ''; // variable to store the label of the selected item

        $(function () {
            // Hide the second input box initially
            $("#JobRole").hide();

            $("#jobSpecialisation").autocomplete({
                source: function (request, response) {
                    if (request.term.trim() === '') { // If the input field is empty
                        response([]); // Return an empty array to prevent the dropdown from showing
                    } else {
                        $.ajax({
                            url: 'fetch.php?fetch=job_specialisations',
                            dataType: 'json',
                            success: function (data) {
                                var results = $.ui.autocomplete.filter(data, request.term);

                                results.sort(function (a, b) {
                                    var aIndex = a.label.toLowerCase().indexOf(request.term.toLowerCase()) === 0 ? -1 : a.label.toLowerCase().indexOf(request.term.toLowerCase());
                                    var bIndex = b.label.toLowerCase().indexOf(request.term.toLowerCase()) === 0 ? -1 : b.label.toLowerCase().indexOf(request.term.toLowerCase());
                                    return aIndex - bIndex;
                                });

                                response(results);
                            }
                        });
                    }
                },
                select: function (event, ui) {
                    event.preventDefault(); // Prevent the widget from automatically updating the input field with the value of the selected item
                    $(this).val(ui.item.label); // Manually update the input field with the label of the selected item
                    $("#jobSpecialisationId").val(ui.item.value); // Update the value of the hidden input field with the value of the selected item

                    selectedspecialisationLabel = ui.item.label; // store the label of the selected item
                    specialisationSelected = true; // set the flag


                    $.ajax({
                        url: 'fetch.php?fetch=job_roles&jobSpecialisationId=' + ui.item.value,
                        data: { jobSpecialisationId: ui.item.value },
                        dataType: 'json',
                        success: function (data) {
                            $("#jobRole").autocomplete({
                                source: data,
                                minLength: 0,
                                select: function (event, ui) {
                                    event.preventDefault();
                                    $(this).val(ui.item.label);
                                    $("#jobRoleId").val(ui.item.value); // Update the value of the hidden input field with the value of the selected item
                                    selectedroleLabel = ui.item.label; // store the label of the selected item
                                    roleSelected = true; // set the flag
                                },
                                close: function (event, ui) {
                                    if (!roleSelected && $(this).val().trim() !== '') { // Only select the first item if no option was selected and the input box is not empty
                                        var firstItem = $(this).data('ui-autocomplete').menu.element.children().first().data('ui-autocomplete-item');
                                        if (firstItem) {
                                            $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', { item: firstItem });
                                        }
                                    }
                                    roleSelected = false; // reset the flag
                                },
                                response: function (event, ui) {
                                    if ($(this).val().trim() === '') { // If the input field is empty
                                        ui.content = []; // Empty the dropdown content
                                    }
                                },
                                focus: function (event, ui) {
                                    event.preventDefault(); // Prevent the default action
                                },

                            }).focus(function () {
                                if ($(this).val().trim() !== '') { // Only trigger the search if the input field is not empty
                                    $(this).autocomplete("search");
                                }
                            });
                            $("#JobRole").show(); // Show the second input box when the AJAX call completes

                            $("#jobRole").on('input', function () {
                                if ($(this).val().trim() === '' || $(this).val().trim() !== selectedroleLabel) { // If the input is empty
                                    $("#jobRoleId").val('0'); // Set the value of #jobLocationId to '0'
                                }
                            });

                        }
                    });

                },
                close: function (event, ui) {
                    if (!specialisationSelected && $(this).val().trim() !== '') { // Only select the first item if no option was selected and the input box is not empty
                        var firstItem = $(this).data('ui-autocomplete').menu.element.children().first().data('ui-autocomplete-item');
                        if (firstItem) {
                            $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', { item: firstItem });
                            $(this).trigger('autocompleteselect', { item: firstItem }); // Manually trigger the select event
                            $("#JobRole").show(); // Show the second input box when the first item is automatically selected
                        }
                    }
                    specialisationSelected = false; // reset the flag
                },
                change: function (event, ui) {
                    if (!ui.item) {
                        // If the input box is cleared, hide the second input box
                        $("#JobRole").hide().val('');
                    } else {
                        // If the value of #jobSpecialisation changes, clear the value of #jobRole
                        $("#JobRole").val('');
                    }
                },
                response: function (event, ui) {
                    if ($(this).val().trim() === '') { // If the input field is empty
                        ui.content = []; // Empty the dropdown content
                    }
                },
                focus: function (event, ui) {
                    event.preventDefault(); // Prevent the default action
                },
                minLength: 0
            }).focus(function () {
                if ($(this).val().trim() !== '') { // Only trigger the search if the input field is not empty
                    $(this).autocomplete("search");
                }
            });

            $("#jobSpecialisation").on('input', function () {
                if ($(this).val().trim() === '' || $(this).val().trim() !== selectedspecialisationLabel) { // If the input is empty
                    $("#jobSpecialisationId").val('0'); // Set the value of #jobLocationId to '0'
                    $("#jobRoleId").val('0');
                    $("#jobRole").val('');
                }
            });

            var locationSelected = false; // flag to indicate if an option was selected
            var selectedlocationLabel = ''; // variable to store the label of the selected item

            $("#jobLocation").autocomplete({
                source: function (request, response) {
                    if (request.term.trim() === '') { // If the input field is empty
                        response([]); // Return an empty array to prevent the dropdown from showing
                    } else {
                        $.ajax({
                            url: 'fetch.php?fetch=job_locations',
                            dataType: 'json',
                            success: function (data) {
                                var results = $.ui.autocomplete.filter(data, request.term);

                                results.sort(function (a, b) {
                                    var aIndex = a.label.toLowerCase().indexOf(request.term.toLowerCase()) === 0 ? -1 : a.label.toLowerCase().indexOf(request.term.toLowerCase());
                                    var bIndex = b.label.toLowerCase().indexOf(request.term.toLowerCase()) === 0 ? -1 : b.label.toLowerCase().indexOf(request.term.toLowerCase());
                                    return aIndex - bIndex;
                                });

                                response(results);
                            }
                        });
                    }

                },
                close: function (event, ui) {
                    if (!locationSelected && $(this).val().trim() !== '') { // Only select the first item if no option was selected and the input box is not empty
                        var firstItem = $(this).data('ui-autocomplete').menu.element.children().first().data('ui-autocomplete-item');
                        if (firstItem) {
                            $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', { item: firstItem });
                        }
                    }
                    locationSelected = false; // reset the flag
                },
                select: function (event, ui) {
                    event.preventDefault(); // prevent the default action

                    $("#jobLocation").val(ui.item.label);
                    $("#jobLocationId").val(ui.item.value); // Update the value of the hidden input field with the value of the selected item
                    selectedlocationLabel = ui.item.label; // store the label of the selected item
                    locationSelected = true; // set the flag

                },
                response: function (event, ui) {
                    if ($(this).val().trim() === '') { // If the input field is empty
                        ui.content = []; // Empty the dropdown content
                    }
                },
                focus: function (event, ui) {
                    event.preventDefault(); // Prevent the default action
                },
                minLength: 0
            }).focus(function () {
                if ($(this).val().trim() !== '') { // Only trigger the search if the input field is not empty
                    $(this).autocomplete("search");
                }
            });

            $("#jobLocation").on('input', function () {
                if ($(this).val().trim() === '' || $(this).val().trim() !== selectedlocationLabel) { // If the input is empty
                    $("#jobLocationId").val('0'); // Set the value of #jobLocationId to '0'
                }
            });

            $("#jobSpecialisation, #jobRole, #jobLocation").autocomplete("instance")._renderItem = function (ul, item) {
                var newText = item.label;
                return $("<li></li>")
                    .data("item.autocomplete", item)
                    .append($("<div></div>").text(newText))
                    .appendTo(ul);
            };

        });

    </script>

    <script>
        window.onbeforeunload = function () {
            // Send an AJAX request to get the jobPostID from the session
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_job_post_id.php', false); // Set async to false
            xhr.send(null);

            if (xhr.status === 200) {
                var jobPostID = xhr.responseText;
                // Modify the URL to include the jobPostID
                history.pushState(null, null, "post-job-classify.php?jobPostID=" + jobPostID);
            }
        };

    </script>


</body>

</html>

<?php
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (!isset($_SESSION['companyID'])) {
    ?>
    <script>
        Swal.fire({
            title: "Error",
            text: "You haven\'t logged in",
            icon: "error",
            backdrop: `lightgrey`,
        }).then(function () {
            window.location.href = "company_login.php";
        });
    </script>
    <?php
    exit;
} else if ($row['CompanyStatus'] == 'Verify') {
    // Show swal box
    ?>
        <script>
            Swal.fire({
                title: 'Error',
                text: 'Please verify your email first.',
                icon: 'error',
            }).then(function () {
                window.location = "company_signout.php";
            });
        </script>
    <?php
} else if ($row['CompanyStatus'] == 'Block') {
    // Show swal box
    ?>
            <script>
                Swal.fire({
                    title: 'Error',
                    text: 'Your account has been blocked.',
                    icon: 'error',
                }).then(function () {
                    window.location = "company_signout.php";
                });
            </script>
    <?php
}
?>

<?php
mysqli_free_result($result);
mysqli_close($connect);
?>