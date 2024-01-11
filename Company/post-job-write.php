<!DOCTYPE html>

<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
?>

<?php
session_start(); // Start the session if you haven't already

if (isset($_SESSION['job_post_ID'])) {
    $job_post_ID = $_SESSION['job_post_ID'];
    $result = mysqli_query($connect, "SELECT * FROM job_post WHERE Job_Post_ID = '$job_post_ID' ");
    $row = mysqli_fetch_assoc($result);
    echo "<script>
        var jobPostData = " . json_encode($row) . ";
        </script>";

}

$CompanyID = null;
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
}


if (isset($_POST['submitbtn'])) {
    $jobDescription = $_POST['jobDescription'];
    $jobResponsibilities = $_POST['jobResponsibilities'];
    $jobBenefits = $_POST['jobBenefits'];
    // Start the SQL query
    $sql = "UPDATE job_post SET Job_Post_Description = '$jobDescription', Job_Post_Responsibilities = '$jobResponsibilities', Job_Post_Benefits = '$jobBenefits'";

    // Check if a new logo image was uploaded
    if (isset($_FILES['logoInput']) && $_FILES['logoInput']['size'] > 0) {
        $errors = array();
        $file_name = $_FILES['logoInput']['name'];
        $file_size = $_FILES['logoInput']['size'];
        $file_tmp = $_FILES['logoInput']['tmp_name'];
        $file_type = $_FILES['logoInput']['type'];
        $file_parts = explode('.', $_FILES['logoInput']['name']);
        $file_ext = strtolower(end($file_parts));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if (move_uploaded_file($file_tmp, "../Company/logo/" . $file_name)) {
            // Add the Job_Logo_Url field to the SQL query
            $sql .= ", Job_Logo_Url='../Company/logo/" . $file_name . "'";
        }
    }

    // Check if a new cover image was uploaded
    if (isset($_FILES['coverInput']) && $_FILES['coverInput']['size'] > 0) {
        $errors = array();
        $file_name = $_FILES['coverInput']['name'];
        $file_size = $_FILES['coverInput']['size'];
        $file_tmp = $_FILES['coverInput']['tmp_name'];
        $file_type = $_FILES['coverInput']['type'];
        $file_parts = explode('.', $_FILES['coverInput']['name']);
        $file_ext = strtolower(end($file_parts));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if (move_uploaded_file($file_tmp, "../Company/covers/" . $file_name)) {
            // Add the Job_Cover_Url field to the SQL query
            $sql .= ", Job_Cover_Url='../Company/covers/" . $file_name . "'";
        }
    } else if ($_POST['coverRemoved'] === '1') {
        // If no new cover image is uploaded and the cover image was removed, set the Job_Cover_Url field to NULL
        $sql .= ", Job_Cover_Url=NULL";
    }

    // Add the WHERE clause to the SQL query
    $sql .= " WHERE Job_Post_ID=" . $job_post_ID;

    // Execute the SQL query
    $result = mysqli_query($connect, $sql);

    if ($result) {
        // Check if jobPostID is set and not empty
        if (isset($_GET['jobPostID'])) {
            // Redirect to the next page with jobPostID
            echo "<script type='text/javascript'>window.location.href = 'post-job-question.php?jobPostID=" . $_GET['jobPostID'] . "';</script>";
        } else {
            // Normal redirect
            echo "<script type='text/javascript'>window.location.href = 'post-job-question.php';</script>";
        }
        exit;
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
                    <span class="header-link"><a href="company_landing.php">Home</a></span>
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
                            <?php echo isset($row['CompanyName']) ? $row['CompanyName'] : 'User Profile'; ?>                            </span>
                            <div style="padding-top:10px;">
                                <span class="contactPerson">
                                <?php echo isset($row['ContactPerson']) ? $row['ContactPerson'] : 'Contact Person'; ?>
                                </span>
                            </div>
                            <div style="padding-top: 10px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="company_profile.php" class="dropdown-link">Accounts
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
    <div class="form-container" style="padding-top:32px">


        <form method="POST" enctype="multipart/form-data">
            <div class="header-title">
                <span
                    style="color: rgb(46, 56, 73);font-size: 36px;font-style: normal;font-weight: 600;line-height: 36px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Write
                    about your job</span>
            </div>
            <div class="form-style" style="margin-top:22px;">
                <div>
                    <span
                        style="color: rgb(46, 56, 73);font-size: 28px;font-style: normal;font-weight: 600;line-height: 28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Showcase
                        your brand
                    </span>
                </div>
                <div style="padding-top:20px;">
                    <span
                        style="font-size:16px;line-height:24px;font-weight: 400;color:#5a6881;font-family:Roboto, 'Helvetica Neue', HelveticaNeue, Helvetica, Arial, sans-serif;">Create
                        your first brand by uploading your company logo. Cover images can be added from the success
                        page, after payment.
                    </span>
                </div>
                <div style="padding-top:32px;">
                    <div class="add_logo_box">
                        <div class="add_cover_img_box" id="add_cover_img_box">
                            <div>
                                <button type="button" id="uploadCover" data-testid="bx-add-asset"
                                    style="display: flex; align-items: center;margin-left:10px;" class="add_cover_btn">
                                    <div style="padding:14px 20px;display:flex;align-items:center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                            focusable="false" fill="currentColor" width="16" height="16"
                                            aria-hidden="true" style="color:white;width:19px;height:19px">
                                            <path
                                                d="M19 2H5C3.3 2 2 3.3 2 5v14c0 1.7 1.3 3 3 3h14c1.7 0 3-1.3 3-3V5c0-1.7-1.3-3-3-3zM4 5c0-.6.4-1 1-1h14c.6 0 1 .4 1 1v7.6L17.4 10c-.8-.8-2.1-.8-2.8 0l-9.9 9.9c-.4-.1-.7-.5-.7-.9V5zm15 15H7.4l8.6-8.6 4 4V19c0 .6-.4 1-1 1z">
                                            </path>
                                            <circle cx="8" cy="8" r="2"></circle>
                                        </svg>
                                        <span style="margin-left: 10px;" class="add_cover_title">Add cover image</span>
                                    </div>
                                </button>
                            </div>
                            <div style="display: none; flex-direction: column;" id="remove_cover">
                                <div style="overflow: hidden;align-items: center;display: flex;">
                                    <img id="previewcover"
                                        src="<?php echo isset($row['Job_Cover_Url']) ? $row['Job_Cover_Url'] : ''; ?>"
                                        alt="Image preview" style=" max-width: 100%; height: auto;" />
                                    <input type="file" id="coverInput" name="coverInput"
                                        accept=".gif,.jpeg,.jpg,.png,.svg,.tiff,.webp" style="display: none;">
                                    <input type="hidden" id="coverRemoved" name="coverRemoved" value="0">
                                </div>
                                <div style="position: absolute;right: 15px;top:15px">
                                    <button type="button" id="removeCover" data-testid="bx-add-asset"
                                        style="display: flex; align-items: center;" class="remove_cover_btn">
                                        <div style="display:flex;align-items:flex-start;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                xml:space="preserve" focusable="false" fill="currentColor" width="16"
                                                height="16" aria-hidden="true"
                                                style="color:black;width:25px;height:25px">
                                                <path
                                                    d="m13.4 12 5.3-5.3c.4-.4.4-1 0-1.4s-1-.4-1.4 0L12 10.6 6.7 5.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l5.3 5.3-5.3 5.3c-.4.4-.4 1 0 1.4.2.2.4.3.7.3s.5-.1.7-.3l5.3-5.3 5.3 5.3c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4L13.4 12z">

                                                </path>
                                            </svg>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div style="padding:20px 24px;">
                            <div style="display: flex; flex-direction:column">
                                <div id="upload_logo">
                                    <button type="button" id="uploadLogo" data-testid="bx-add-asset"
                                        style="display: flex; align-items: center;margin-left:10px;"
                                        class="add_logo_btn">
                                        <div style="padding:14px 20px;display:flex;align-items:center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                xml:space="preserve" focusable="false" fill="currentColor" width="16"
                                                height="16" aria-hidden="true"
                                                style="color:white;width:19px;height:19px">
                                                <path
                                                    d="M19 2H5C3.3 2 2 3.3 2 5v14c0 1.7 1.3 3 3 3h14c1.7 0 3-1.3 3-3V5c0-1.7-1.3-3-3-3zM4 5c0-.6.4-1 1-1h14c.6 0 1 .4 1 1v7.6L17.4 10c-.8-.8-2.1-.8-2.8 0l-9.9 9.9c-.4-.1-.7-.5-.7-.9V5zm15 15H7.4l8.6-8.6 4 4V19c0 .6-.4 1-1 1z">
                                                </path>
                                                <circle cx="8" cy="8" r="2"></circle>
                                            </svg>
                                            <span style="margin-left: 10px;" class="add_logo_title">Add logo</span>
                                        </div>
                                    </button>
                                </div>
                                <div style="display: none; flex-direction: column;" id="replace_logo">
                                    <div
                                        style="width: 180px; height: 80px; overflow: hidden; margin-left: 10px;align-items: center;display: flex;">
                                        <img id="previewlogo"
                                            src="<?php echo isset($row['Job_Logo_Url']) ? $row['Job_Logo_Url'] : ''; ?>"
                                            alt="Image preview" style=" max-width: 100%; height: auto;" />
                                        <input type="file" id="logoInput" name="logoInput"
                                            accept=".gif,.jpeg,.jpg,.png,.svg,.tiff,.webp" style="display: none;">
                                        <input type="hidden" id="logoPresent" name="logoPresent"
                                            value="<?php echo isset($row['Job_Logo_Url']) ? '1' : '0'; ?>">
                                    </div>
                                    <div>
                                        <button type="button" id="replaceLogo" data-testid="bx-add-asset"
                                            style="display: flex; align-items: center;margin-left:10px;"
                                            class="replace_logo_btn">
                                            <div style="padding:14px 0px;display:flex;align-items:flex-start;">

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true"
                                                    style="color:#4964e9;width:19px;height:19px">
                                                    <path
                                                        d="M20.7 4.1c-1.4-1.4-4-1.4-5.4 0l-11 11c-.1.1-.2.3-.3.5l-1 5c-.1.3 0 .7.3.9.2.2.4.3.7.3h.2l5-1c.2 0 .4-.1.5-.3l11-11c1.5-1.5 1.5-3.9 0-5.4zM8.5 18.9l-3.2.6.6-3.2 8.6-8.6 2.6 2.6-8.6 8.6zM19.3 8.1l-.8.8-2.6-2.6.8-.8c.7-.7 1.9-.7 2.6 0 .7.7.7 1.9 0 2.6z">
                                                    </path>
                                                </svg>
                                                <span style="margin-left: 5px;"
                                                    class="replace_logo_title">Replace</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <div style="padding-top:4px;padding-left:10px" id="validation-joblogo" class="hide">
                                    <span style="display:flex"><span
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
                                            </svg></span><span><span id="joblogo-message"
                                                class="validation_sentence">Please
                                                add logo</span></span></span>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

            <div class="form-style" style="margin-top:22px;">
                <div>
                    <span
                        style="color: rgb(46, 56, 73);font-size: 28px;font-style: normal;font-weight: 600;line-height: 28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Job
                        description

                    </span>
                </div>
                <div style="padding-top:20px;">
                    <span
                        style="font-size:16px;line-height:24px;font-weight: 400;color:#5a6881;font-family:Roboto, 'Helvetica Neue', HelveticaNeue, Helvetica, Arial, sans-serif;">Enter
                        your job details or let us guide you through what to write.
                    </span>
                </div>
                <div class="form-group" id="Description">
                    <textarea id="jobDescription" name="jobDescription"
                        class="write-textarea"><?php echo isset($row['Job_Post_Description']) ? $row['Job_Post_Description'] : ''; ?></textarea>
                    <div style="padding-top:4px;" id="validation-jobdescription" class="hide"><span
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
                                </svg></span><span><span id="jobdescription-message" class="validation_sentence">Please
                                    add job description</span></span></span></div>

                </div>
            </div>

            <div class="form-style" style="margin-top:22px;">
                <div>
                    <span
                        style="color: rgb(46, 56, 73);font-size: 28px;font-style: normal;font-weight: 600;line-height: 28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Job
                        responsibilities

                    </span>
                </div>
                <div style="padding-top:20px;">
                    <span
                        style="font-size:16px;line-height:24px;font-weight: 400;color:#5a6881;font-family:Roboto, 'Helvetica Neue', HelveticaNeue, Helvetica, Arial, sans-serif;">Let
                        candidates know what they will be doing day-to-day.
                    </span>
                </div>
                <div class="form-group" id="Responsibilities">
                    <textarea id="jobResponsibilities" name="jobResponsibilities"
                        class="write-textarea"><?php echo isset($row['Job_Post_Responsibilities']) ? $row['Job_Post_Responsibilities'] : ''; ?></textarea>
                    <div style="padding-top:4px;" id="validation-jobresponsibilities" class="hide"><span
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
                                </svg></span><span><span id="jobresponsibilities-message"
                                    class="validation_sentence">Please add job responsibilities
                                </span></span></span></div>
                </div>
            </div>

            <div class="form-style" style="margin-top:22px;">
                <div>
                    <span
                        style="color: rgb(46, 56, 73);font-size: 28px;font-style: normal;font-weight: 600;line-height: 28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Benefits

                    </span>
                </div>
                <div style="padding-top:20px;">
                    <span
                        style="font-size:16px;line-height:24px;font-weight: 400;color:#5a6881;font-family:Roboto, 'Helvetica Neue', HelveticaNeue, Helvetica, Arial, sans-serif;">There's
                        more to a job than just the pay. Attract candidates by letting them know what benefits you
                        offer.
                    </span>
                </div>
                <div class="form-group" id="Benefits">
                    <textarea id="jobBenefits" name="jobBenefits"
                        class="write-textarea"><?php echo isset($row['Job_Post_Benefits']) ? $row['Job_Post_Benefits'] : ''; ?></textarea>
                    <div style="padding-top:4px;" id="validation-jobbenefits" class="hide"><span
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
                                </svg></span><span><span id="benefits-message" class="validation_sentence">Please add
                                    job benefits</span></span></span></div>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script src="post-job.js"></script>
    <script src="post-job-write-validation.js"></script>

    <script>

        document.getElementById('uploadLogo').addEventListener('click', function () {
            document.getElementById('logoInput').click();
        });

        document.getElementById('replaceLogo').addEventListener('click', function () {
            document.getElementById('logoInput').click();
        });

        document.getElementById('logoInput').addEventListener('change', function (event) {
            var output = document.getElementById('previewlogo');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
            output.style.display = 'block';
            document.getElementById('replace_logo').style.display = 'flex';
            document.getElementById('uploadLogo').style.display = 'none';
        });

        document.getElementById('uploadCover').addEventListener('click', function () {
            document.getElementById('coverInput').click();
        });

        document.getElementById('removeCover').addEventListener('click', function () {
            // Clear the preview image source
            var previewCover = document.getElementById('previewcover');
            previewCover.src = '';

            // Hide the remove cover button
            document.getElementById('remove_cover').style.display = 'none';
            document.getElementById('uploadCover').style.display = 'flex';
            document.getElementById('add_cover_img_box').style.height = '200px';

            // Set the coverRemoved flag to '1'
            document.getElementById('coverRemoved').value = '1';
        });

        document.getElementById('coverInput').addEventListener('change', function (event) {
            var output = document.getElementById('previewcover');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
            output.style.display = 'block';
            document.getElementById('remove_cover').style.display = 'flex';
            document.getElementById('uploadCover').style.display = 'none';

            // Reset the coverRemoved flag to '0'
            document.getElementById('coverRemoved').value = '0';
        });
    </script>


    <script>


        window.onload = function () {
            var logoInput = document.getElementById('logoInput');
            var uploadButton = document.getElementById('uploadLogo');
            var replaceLogo = document.getElementById('replace_logo');
            var preview = document.getElementById('previewlogo');

            logoInput.addEventListener('change', function () {
                var file = this.files[0];

                // Check if the file is an image
                if (file && file.type.startsWith('image/')) {
                    // Create a new FileReader object
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        // Set the src attribute of the preview image to the data URL of the uploaded image
                        preview.src = e.target.result;

                        // Show the preview image and the replace logo section, and hide the upload button
                        preview.style.display = 'block';
                        replaceLogo.style.display = 'flex';
                        uploadButton.style.display = 'none';
                    };

                    // Read the uploaded file as a data URL
                    reader.readAsDataURL(file);
                }
            });
        }

        window.onload = function () {
            var coverInput = document.getElementById('coverInput');
            var uploadButton = document.getElementById('uploadCover');
            var removeCover = document.getElementById('remove_cover');
            var preview = document.getElementById('previewcover');
            var coverimgbox = document.getElementById('add_cover_img_box');


            coverInput.addEventListener('change', function () {
                var file = this.files[0];

                // Check if the file is an image
                if (file && file.type.startsWith('image/')) {
                    // Create a new FileReader object
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        // Set the src attribute of the preview image to the data URL of the uploaded image
                        preview.src = e.target.result;

                        // Show the preview image and the replace logo section, and hide the upload button
                        removeCover.style.display = 'flex';
                        uploadButton.style.display = 'none';
                        coverimgbox.style.height = 'auto';
                    };

                    // Read the uploaded file as a data URL
                    reader.readAsDataURL(file);
                }

            });
        }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>

<?php
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
}
?>

