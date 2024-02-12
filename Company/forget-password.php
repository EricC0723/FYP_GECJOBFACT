<!DOCTYPE html>
<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning
require 'vendor/autoload.php'; // Add this line to include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" type="text/css" href="post-job.css">
    <link rel="stylesheet" type="text/css" href="company_register.css">
</head>

<body class="postjob_body">
    <header class="postjob_header" style="background:#0d3880;">
        <div class="container">
            <div class="logo">
                <a href="company_login.php" class="postjob_link"><img style="width:150px;" src="logo.png"
                        alt="Logo"></a>
            </div>
            <div class="logo-nav">

            </div>
            <div style="flex:1 1 auto;"></div>

            <div style="padding:0 20px">
                <div class="flex-container">

                </div>
            </div>

    </header>

    <div style="padding-top:20px;">
        <div class="register_content" id="forget_password">

        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'reset-email-send.php',
                type: 'GET',
                success: function (response) {
                    $('#forget_password').html(response);
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
    $sql = "SELECT * FROM companies WHERE CompanyEmail = '$companyEmail'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $companyID = $row['CompanyID'];

        $sql = "SELECT * FROM companies WHERE CompanyID = $companyID";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $company_contact = $row['ContactPerson'];
        $company_name = $row['CompanyName'];


        // After the user is registered, send the verification email
        $mail = new PHPMailer(true);

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
            $mail->isHTML(true);

            $mail->Subject = 'Reset Password';

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
                <p>Please click on the link to reset your password: <a href="http://localhost/FYP/Company/reset-password.php?data=' . $companyID . '">Click to verify</a></p>
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
                    text: "Reset password link has been sent to your email.",
                    icon: "success",
                }).then(function () {
                    $.ajax({
                        type: 'GET',
                        url: 'reset-email-send.php', // The URL of the PHP file that sends the email
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

    // Close the database connection
    mysqli_close($connect);
}
?>