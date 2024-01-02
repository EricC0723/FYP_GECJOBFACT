<!DOCTYPE html>

<?php
include("dataconnection.php"); ?>

<?php
session_start(); // Start the session if you haven't already

if (isset($_SESSION['job_post_ID'])) {
    $job_post_ID = $_SESSION['job_post_ID'];
}

$CompanyID = null;
if (isset($_SESSION['companyData']['CompanyID'])) {
    $CompanyID = $_SESSION['companyData']['CompanyID'];
}

if (isset($_POST["submitbtn"])) {
    // Store the form data in the session
    $_SESSION['formData'] = $_POST;

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
    $jobSalaryMin = $_POST['jobSalaryMin'];
    $jobSalaryMax = $_POST['jobSalaryMax'];

    if (isset($_GET['jobPostID'])) {
        // Update the existing job post
        $postid = $_GET["jobPostID"];
        $sql = "UPDATE job_post SET Job_Post_Title = '$jobTitle', Job_Location_ID = '$jobLocationID', Job_Post_Location = '$jobLocation', Main_Category_ID = '$jobSpecialisationID', Main_Category_Name = '$jobSpecialisation', Sub_Category_ID = '$jobRoleID', Sub_Category_Name = '$jobRole', Job_Post_Type = '$jobType', Job_Post_Position = '$jobPosition', Job_Post_MinSalary = '$jobSalaryMin', Job_Post_MaxSalary = '$jobSalaryMax', CompanyID = '$CompanyID' WHERE Job_Post_ID = '$postid'";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            // Store the job_post_ID in the session
            $_SESSION['job_post_ID'] = $postid;
            // Redirect to the next page
            echo "<script type='text/javascript'>window.location.href = 'post-job-write.php?jobPostID=$postid';</script>";
            exit;
        }
    } else if (isset($_SESSION['job_post_ID'])) {
        // Update the existing job post
        $postId = $_SESSION["job_post_ID"];
        $sql = "UPDATE job_post SET Job_Post_Title = '$jobTitle', Job_Location_ID = '$jobLocationID', Job_Post_Location = '$jobLocation', Main_Category_ID = '$jobSpecialisationID', Main_Category_Name = '$jobSpecialisation', Sub_Category_ID = '$jobRoleID', Sub_Category_Name = '$jobRole', Job_Post_Type = '$jobType', Job_Post_Position = '$jobPosition', Job_Post_MinSalary = '$jobSalaryMin', Job_Post_MaxSalary = '$jobSalaryMax', CompanyID = '$CompanyID' WHERE Job_Post_ID = '$postId'";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            // Redirect to the next page
            echo "<script type='text/javascript'>window.location.href = 'post-job-write.php;</script>";
            exit;
        }
    } else {
        // Insert a new job post
        $sql = "INSERT INTO job_post (Job_Post_Title, Job_Location_ID, Job_Post_Location, Main_Category_ID, Main_Category_Name, Sub_Category_ID, Sub_Category_Name, Job_Post_Type, Job_Post_Position, Job_Post_MinSalary, Job_Post_MaxSalary, CompanyID, job_status) VALUES ('$jobTitle', '$jobLocationID', '$jobLocation', '$jobSpecialisationID', '$jobSpecialisation', '$jobRoleID', '$jobRole', '$jobType', '$jobPosition', '$jobSalaryMin', '$jobSalaryMax', '$CompanyID', 'Draft')";
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
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="post-job.css">
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
                    <span class="header-link"><a href="#home">Home</a></span>
                    <span class="header-link"><a href="#jobs">Jobs</a></span>
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
    <div
        style="width:100%;height:155px;background:white;box-shadow:rgba(28, 35, 48, 0.1) 0px 2px 4px 0px, rgba(28, 35, 48, 0.1) 0px 2px 2px -2px, rgba(28, 35, 48, 0.2) 0px 4px 4px -4px;">
        <div class="container">
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

        <form method="POST">
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
                        <label for="type3" class="option">Contract</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="type4" name="jobType" value="4" onclick="boldOption1(this)" <?php echo isset($row['Job_Post_Type']) && $row['Job_Post_Type'] == 4 ? 'checked' : ''; ?>>
                        <label for="type4" class="option">Casual</label>
                    </div>
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

                <input type="submit" value="Continue" class="cont-button" name="submitbtn">
                <input type="submit" value="Save draft" class="save-button" style="margin-left:4px">
            </div>
        </form>
    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="post-job.js"></script>
    <script>
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

    <script src="post-job-classify-validation.js"></script>

</body>

</html>