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
    <title>Change Email</title>
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
                            <div style="padding-top: 12px;"><a href="company_creditcard.php" class="dropdown-link">Card Payment</a></div>

                            <div style="padding-top: 12px;"><a href="payment_history.php" class="dropdown-link">Payment History</a>
                            </div>
                            <div style="padding-top: 20px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="company_contactus.php" class="dropdown-link">Contact us</a>
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
if (isset($_GET["login_btn"])) {

    // Get the values from the form fields
    $companyEmail = $_GET['companyEmail'];

    // Prepare an SQL statement to check if the email exists
    $sql = "UPDATE companies SET CompanyEmail = '$companyEmail', CompanyStatus = 'Verify' WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);

    if ($result) {

        // After the user is registered, send the verification email
        $mail = new PHPMailer(true);

        $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $company_contact = $row['ContactPerson'];
        $company_name = $row['CompanyName'];

        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Changed to Gmail's SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'gecjobfacts888@gmail.com'; // Your Gmail address
            $mail->Password = 'atteeyliyxloitmo'; // Your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('gecjobfacts888@gmail.com', 'GEC Job Facts'); // Your Gmail address
            $mail->addAddress($companyEmail, $company_name);

            // Generate a hash of the user's email and a secret key
            $secretKey = "your-secret-key";
            $hash = hash_hmac('sha256', $companyEmail, $secretKey);

            // Combine the hash and the email into a single string
            $combined = $hash . ':' . $companyEmail;

            // Encode the combined string
            $encoded = base64_encode($combined);

            $mail->Subject = 'Change Email Verification';

            // Send the verification email
            $mail->Body = '
            <html>
            <head>
              <style>
                .email-content {
                  font-family: Arial, sans-serif;
                }
                .email-content .header {
                  color: #333;
                  font-size: 24px;
                }
                .email-content .body {
                  color: #666;
                  font-size: 16px;
                }
                .email-content .footer {
                  color: #999;
                  font-size: 12px;
                }
              </style>
            </head>
            <body>
              <div class="email-content">
                <div class="header">Dear ' . $company_contact . ',</div>
                <div class="body">
                <p>Please click on the link to verify your email: <a href="http://localhost/FYP/Company/verify-email.php?data=' . urlencode($encoded).'">Click to verify</a></p>
                </div>
                <div style="height:20px"></div>
                <div class="footer">Best regards,<br> GEC Job Facts.</div>
              </div>
            </body>
            </html>';
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
