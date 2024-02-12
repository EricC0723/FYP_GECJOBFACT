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
    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}


if (isset($_POST['submitbtn'])) {
    if (isset($_GET['jobPostID'])) {
        // Update the existing job post
        $postid = $_GET["jobPostID"];
        if ($postid) {

            echo "<script type='text/javascript'>window.location.href = 'view-job-question.php?jobPostID=$postid';</script>";
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
                            <script>
                                function classifydirect() {
                                    <?php
                                    if (isset($_SESSION['job_post_ID'])) {
                                        $job_post_ID = $_SESSION['job_post_ID'];
                                    } else {
                                        $job_post_ID = $_GET['jobPostID'];
                                    }
                                    // Print the code if none of the columns are null
                                    $_SESSION['job_post_ID'] = $job_post_ID;

                                    ?>
                                    window.location.href = 'view-job-classify.php?jobPostID=<?php echo $job_post_ID; ?>';
                                }
                            </script>
                            <div style="position:relative;cursor:pointer;" onclick="classifydirect()">
                                <div style="width:24px"><svg width="24px" height="24px" viewBox="0 0 24 24"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg">
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
                                                                            id="Shape" fill="#2765CF"
                                                                            fill-rule="nonzero"></path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="page_title"><span class="landing_sentence2">Classify</span>
                                </div>
                            </div>
                            <div style="flex-grow:1;">
                                <div class="solid-line" style="border-color: #4964e9 !important;"></div>
                            </div>

                            <div style="position:relative;cursor:pointer;">
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
                                        style="font-weight:600">Write</span>
                                </div>
                            </div>
                            <div style="flex-grow:1;">
                                <div class="solid-line"></div>
                            </div>

                            <script>
                                function questiondirect() {
                                    <?php
                                    if (isset($_SESSION['job_post_ID'])) {
                                        $job_post_ID = $_SESSION['job_post_ID'];
                                    } else {
                                        $job_post_ID = $_GET['jobPostID'];
                                    }
                                    // Print the code if none of the columns are null
                                    $_SESSION['job_post_ID'] = $job_post_ID;

                                    ?>
                                    window.location.href = 'view-job-question.php?jobPostID=<?php echo $job_post_ID; ?>';
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-container" style="padding-top:32px">
        <?php
        if (isset($_SESSION['job_post_ID'])) {
            $job_post_ID = $_SESSION['job_post_ID'];
            $result = mysqli_query($connect, "SELECT * FROM job_post WHERE Job_Post_ID = '$job_post_ID' ");
            $row = mysqli_fetch_assoc($result);
            echo "<script>
        var jobPostData = " . json_encode($row) . ";
        </script>";
        }

        if (isset($_GET['jobPostID'])) {
            $postid = $_GET["jobPostID"];
            $result = mysqli_query($connect, "SELECT * FROM job_post WHERE Job_Post_ID = '$postid' ");
            $row = mysqli_fetch_assoc($result);
        }
        ?>



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
                        <?php if (isset($row['Job_Cover_Url']) && $row['Job_Cover_Url'] != ''): ?>
                            <div class="add_cover_img_box" id="add_cover_img_box" style="height:auto;">
                                <div>
                                    <div style="flex-direction: column;" id="remove_cover">
                                        <div style="overflow: hidden;align-items: center;display: flex;">
                                            <img id="previewcover" src="<?php echo $row['Job_Cover_Url']; ?>"
                                                alt="Image preview" style=" max-width: 100%; height: auto;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="add_cover_img_box" id="add_cover_img_box" style="height:200px;">
                                <div>
                                    <div>
                                        <div id="uploadCover"><span
                                                style="font-size:16px;line-height:24px;font-weight: 400;color:#5a6881;font-family:Roboto, 'Helvetica Neue', HelveticaNeue, Helvetica, Arial, sans-serif;">This
                                                job post doesnt have a cover image</span></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div style="padding:20px 24px;">
                            <div style="display: flex; flex-direction:column">
                                <div style="flex-direction: column;" id="replace_logo">
                                    <div
                                        style="width: 180px; height: 80px; overflow: hidden; margin-left: 10px;align-items: center;display: flex;border:0.5px solid #4964e9 ;">
                                        <img id="previewlogo"
                                            src="<?php echo isset($row['Job_Logo_Url']) ? $row['Job_Logo_Url'] : ''; ?>"
                                            alt="Image preview" style=" max-width: 100%; height: auto;" />
                                    </div>

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
                    <textarea id="jobDescription" name="jobDescription" disabled
                        class="write-textarea"><?php echo isset($row['Job_Post_Description']) ? $row['Job_Post_Description'] : ''; ?></textarea>

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
                    <textarea id="jobResponsibilities" name="jobResponsibilities" disabled
                        class="write-textarea"><?php echo isset($row['Job_Post_Responsibilities']) ? $row['Job_Post_Responsibilities'] : ''; ?></textarea>
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
                    <textarea id="jobBenefits" name="jobBenefits" class="write-textarea"
                        disabled><?php echo isset($row['Job_Post_Benefits']) ? $row['Job_Post_Benefits'] : ''; ?></textarea>
                </div>
            </div>

            <div class="form-group" style="display: block;">
                <input type="submit" value="Continue" class="cont-button" name="submitbtn">
                <!-- <input type="submit" value="Save draft" class="save-button" style="margin-left:4px"> -->
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script src="post-job.js"></script>



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

if (!isset($_SESSION['job_post_ID'])) {
    ?>
    <script>
        Swal.fire({
            title: "Error",
            text: "Invalid Action.",
            icon: "error",
            backdrop: `lightgrey`,
        }).then(function () {
            window.location.href = "company_landing.php";
        });
    </script>
    <?php
    exit;
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