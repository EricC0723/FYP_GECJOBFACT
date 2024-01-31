<!DOCTYPE html>

<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning
require 'vendor/autoload.php'; // Add this line to include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
    <link rel="stylesheet" type="text/css" href="company_register.css">
</head>

<body class="postjob_body">
    <header class="postjob_header">
        <div class="container">
            <div class="logo">
                <a href="company_landing.php" class="postjob_link"><img src="logo.png" alt="Logo" style="width:150px;"></a>
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
                            <div style="padding-top: 12px;"><a href="company_creditcard.php" class="dropdown-link">Card Payment</a></div>

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

    <div style="padding-top:20px;">
        <div class="register_content" id="change_email">

        </div>
    </div>

    <script src="post-job.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'change-email-send.php',
                type: 'GET',
                success: function (response) {
                    $('#change_email').html(response);
                }
            });
        });
    </script>

</body>

</html>


<?php
if (isset($_GET["login_btn"])) {

    // Get the values from the form fields
    $companyEmail = $_GET['companyEmail'];

    // Prepare an SQL statement to check if the email exists
    $sql = "UPDATE companies SET CompanyEmail = '$companyEmail', CompanyStatus = 'Verify' WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);

    if ($result) {

        // After the user is registered, send the verification email
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Changed to Gmail's SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'jobfactsgec112@gmail.com'; // Your Gmail address
            $mail->Password = 'wqfrqwmpezbnrjfr'; // Your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('jobfactsgec112@gmail.com', 'Mailer'); // Your Gmail address
            $mail->addAddress($companyEmail, 'Joe User');

            // Generate a hash of the user's email and a secret key
            $secretKey = "your-secret-key";
            $hash = hash_hmac('sha256', $companyEmail, $secretKey);

            // Combine the hash and the email into a single string
            $combined = $hash . ':' . $companyEmail;

            // Encode the combined string
            $encoded = base64_encode($combined);

            // Send the verification email
            $mail->Body = 'Please click on the link to verify your email: http://localhost/FYP/Company/verify-email.php?data=' . urlencode($encoded);
            $mail->send();
            ?>
            <script>
                var companyEmail = '<?php echo $companyEmail; ?>';

                Swal.fire({
                    title: "Success",
                    text: "Please check your email for verification.",
                    icon: "success",
                }).then(function () {
                    $.ajax({
                        type: 'GET',
                        url: 'change-email-send.php', // The URL of the PHP file that sends the email
                        data: {
                            companyEmail: companyEmail, // Use the JavaScript variable here
                            emailSent: true // Add this line to send a value indicating that the email was sent
                        },
                        success: function (data) {
                            // This function will be called when the AJAX request is successful
                            // Replace the content of the div with the new HTML
                            $('#forget_password').html(data);
                        },
                        error: function () {
                            // This function will be called if the AJAX request fails
                            alert('An error occurred while sending the email.');
                        }
                    });
                });
            </script>
            <?php
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    } else {
        ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "Invalid email address.",
                icon: "error",
            });
        </script>
        <?php
    }
}
?>

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
} 
?>

<?php
mysqli_free_result($result);
mysqli_close($connect);
?>
