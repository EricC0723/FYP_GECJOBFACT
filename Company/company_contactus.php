<!DOCTYPE html>
<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning
unset($_SESSION['job_post_ID']);

$CompanyID = null;
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];

    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
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

<body class="postjob_body" style="background-color:white;">
    <header class="postjob_header">
        <div class="container">
            <div class="logo">
                <a href="company_landing.php" class="postjob_link"><img style="width:150px;" src="logo.png"
                        alt="Logo"></a>
            </div>
            <div class="logo-nav">
                <nav style="display:flex">
                    <span class="header-link"><a href="company_landing.php" class="company_nav_active">Home</a></span>
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
                            <div style="padding-top: 12px;"><a href="company_creditcard.php" class="dropdown-link">Card
                                    Payment</a></div>

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

    <div style="padding:48px 0px;">
        <div style="width:100%;max-width:960px;margin:0 auto;">
            <div>
                <h1 class="landing_sentence2" style="font-size:42px;line-height:44px;margin:0;">Contact Us</h1>
            </div>
            <div style="padding-top:48px;display:flex;flex-direction:row;">
                <div style="width:100%;">
                    <div>
                        <div>
                            <h3 class="landing_sentence1">Have an enquiry?</h3>
                        </div>
                        <div style="padding-top:10px;"><span class="landing_sentence2">Send us a message using the form
                                below and we'll get back to you as soon as possible.</span></div>
                        <div style="padding-top:10px;"><a class="landing_sentence2 contactlink" href="#"
                                style="color:#4964e9;font-weight:600;text-decoration:none;">Job seekers contact us here</a></div>
                    </div>
                    <div style="padding-top:24px;">
                        <form method="post">
                            <div>
                                <div class="form-group"><label for="contactName" class="question"
                                        style="padding-bottom: 8px;">Contact Name</label>
                                    <input type="text" id="contactName" name="contactName" class="input-box"
                                        placeholder="Enter the job title">
                                    <div style="padding-top:4px;" id="validation-contactName" class="hide"><span
                                            style="display:flex"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true" style="color:#b91e1e">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="contactName-message"
                                                    class="validation_sentence">Required Field</span></span></span>
                                    </div>
                                </div>
                                <div style="padding-top:20px;" class="form-group">
                                    <label class="question" style="padding-bottom: 8px;">Email
                                        address</label>
                                    <input class="input-box" type="email" id="contactEmail" name="contactEmail">
                                    <div style="padding-top:4px;" id="validation-contactEmail" class="hide"><span
                                            style="display:flex"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true" style="color:#b91e1e">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="contactEmail-message"
                                                    class="validation_sentence">Required
                                                    field</span></span></span></div>
                                </div>
                                <div class="form-group" style="padding-top:20px;"><label for="contactSubject"
                                        class="question" style="padding-bottom: 8px;">Subject</label>
                                    <input type="text" id="contactSubject" name="contactSubject" class="input-box"
                                        placeholder="Enter the job title">
                                    <div style="padding-top:4px;" id="validation-contactSubject" class="hide"><span
                                            style="display:flex"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true" style="color:#b91e1e">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="contactSubject-message"
                                                    class="validation_sentence">Required Field</span></span></span>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top:20px;">
                                    <label for="contactMessage" class="question" style="padding-bottom: 8px;">Message
                                        <span style="font-weight:400;">(Max 1000 characters)</span></label>
                                    <textarea id="contactMessage" name="contactMessage"
                                        class="write-textarea"></textarea>
                                    <div style="padding-top:4px;" id="validation-contactMessage" class="hide"><span
                                            style="display:flex"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true" style="color:#b91e1e">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="contactMessage-message"
                                                    class="validation_sentence">Required Field</span></span></span>
                                    </div>
                                </div>
                                <div style="padding-top:20px">
                                    <input type="submit" value="Send" class="create_btn" name="submitbtn">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div style="width:100%;padding-left:48px;">
                    <div>
                        <div>
                            <h3 class="landing_sentence1">Contact Information</h3>
                        </div>
                        <div style="padding-top:10px;"><span class="landing_sentence2">Malaysia</span></div>
                        <div style="padding-top:10px;"><span class="landing_sentence2">Monday to Friday, 8:30am - 5:30pm
                                MYT</span></div>
                        <div style="padding-top:24px;"><span style="position:relative;display:block;"><span
                                    style="background:#d2d7df;height:1px;width:100%;position:absolute;"></span></span>
                        </div>
                        <div style="padding-top:24px;">
                            <span class="landing_sentence2" style="font-weight:700;">Melaka</span>
                        </div>
                        <div style="padding-top:10px;">
                            <span class="landing_sentence2">Multimedia University, Jalan Ayer Keroh Lama, 75450 Bukit Beruang, Melaka, Malaysia</span>
                        </div>
                        <div style="padding-top:10px;">
                            <span class="landing_sentence2">Customer Service: <a href="tel:+60 11 1061 4689" class="landing_sentence2 contactlink" style="color:#4964e9;font-weight:600;text-decoration:none;">+60 11 1061 4689</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="post-job.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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