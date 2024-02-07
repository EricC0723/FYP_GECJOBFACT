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
                <a href="company_landing.php" class="postjob_link"><img style="width:150px;" src="logo.png" alt="Logo"></a>
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