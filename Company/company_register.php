<!DOCTYPE html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
require 'vendor/autoload.php'; // Add this line to include PHPMailer
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["register_btn"])) {

    // Get the values from the form fields
    $companyEmail = $_POST['companyEmail'];
    $companyPassword = $_POST['companyPassword'];
    $contactPerson = $_POST['companyPerson'];
    $companyPhone = $_POST['companyContact'];
    $companyName = $_POST['companyName'];
    $companySize = $_POST['companySize'];
    $registrationNo = $_POST['companyRegistration'];

    // Generate a unique verification token
    $token = bin2hex(random_bytes(50));

    // Prepare an SQL statement
    $sql = mysqli_query($connect, "INSERT INTO companies (CompanyEmail, CompanyPassword, ContactPerson, CompanyPhone, CompanyName, CompanySize, RegistrationNo) VALUES ('$companyEmail', '$companyPassword', '$contactPerson', '$companyPhone', '$companyName', '$companySize', '$registrationNo')");

    if ($sql) {
        // After the user is registered, send the verification email
        $_SESSION['companyEmail'] = $companyEmail;
        $mail = new PHPMailer(true);

        $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $company_contact = $row['ContactPerson'];
        $company_name = $row['CompanyName'];

        try {
            //Server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Changed to Gmail's SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'jobfactsgec112@gmail.com'; // Your Gmail address
            $mail->Password = 'wqfrqwmpezbnrjfr'; // Your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('jobfactsgec112@gmail.com', 'GEC Job Facts'); // Your Gmail address
            $mail->addAddress($companyEmail, $company_name);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';

            // Generate a hash of the user's email and a secret key
            $secretKey = "your-secret-key";
            $hash = hash_hmac('sha256', $companyEmail, $secretKey);

            // Combine the hash and the email into a single string
            $combined = $hash . ':' . $companyEmail;

            // Encode the combined string
            $encoded = base64_encode($combined);

            $mail->Subject = 'Email Verification';

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
                function sendEmail() {
                    Swal.fire({
                        title: "Success",
                        text: "Company Registered Successfully! Please check your email for verification.",
                        icon: "success",
                        showDenyButton: true,
                        confirmButtonText: "Send again",
                        denyButtonText: `Ok`,
                        backdrop: `lightgrey`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'GET',
                                url: 'send-verify-email.php',
                                success: function (data) {
                                    console.log(data); // Log the output of the send-verify-email.php script
                                    sendEmail(); // Call the function again if the email was sent successfully
                                },
                                error: function () {
                                    alert('An error occurred while sending the email.');
                                }
                            });
                        } else if (result.isDenied) {
                            window.location.href = 'company_login.php';
                        }
                    });
                }

                sendEmail(); // Call the function for the first time
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
                text: "Failed to register company. Please try again.",
                icon: "error",
            })
        </script>
        <?php
    }

    // Close the database connection
    mysqli_close($connect);
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
    <header class="postjob_header" style="background:#0d3880;">
        <div class="container">
            <div class="logo">
                <a href="company_login.php" class="postjob_link"><img style="width:150px;" src="logo.png" alt="Logo"></a>
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
        <div class="register_content">
            <div>
                <div class="employee_link">
                    <span><a href="" class="employee_sentence">Are you looking for a job?</a></span>
                </div>
            </div>
            <form method="POST">
                <div>
                    <div class="register_form">
                        <div style="padding:48px;">

                            <div>
                                <h1 class="register_title">Register as an employer
                                </h1>
                            </div>
                            <div class="form-group">
                                <label class="question" style="padding-bottom: 8px;">Email
                                    address</label>
                                <label class="question"
                                    style="padding-bottom: 8px;font-weight: 400;color: rgb(90, 104, 129);">Your email
                                    will need to be verified to post a job.
                                </label>
                                <input class="register_input" type="email" id="email-input" name="companyEmail">
                                <div style="padding-top:4px;" id="validation-email" class="hide"><span
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
                                            </svg></span><span><span id="email-message"
                                                class="validation_sentence">Required
                                                field</span></span></span></div>
                            </div>

                            <div class="form-group">
                                <label class="question" style="padding-bottom: 8px;">Password</label>
                                <div style="position: relative;">
                                    <input id="password" class="register_input" type="password"
                                        style="width: calc(100% - 54px); padding-right: 40px;" name="companyPassword">
                                    <button id="togglePassword" style="border: none; padding: 0; outline: none;"
                                        class="password_btn">
                                        <span id="eyeIcon">
                                            <!-- SVG for 'eye closed' here -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" focusable="false" fill="currentColor"
                                                style="width:20px;height:20px;" aria-hidden="true">
                                                <path
                                                    d="M21.912 11.59C21.791 11.32 18.867 5 12 5s-9.791 6.32-9.912 6.59a1.001 1.001 0 0 0 0 .82C2.209 12.68 5.133 19 12 19s9.791-6.32 9.912-6.59a1.001 1.001 0 0 0 0-.82ZM12 17c-4.708 0-7.173-3.728-7.877-5C4.827 10.728 7.292 7 12 7c4.71 0 7.175 3.73 7.877 5-.704 1.272-3.169 5-7.877 5Z">
                                                </path>
                                                <circle cx="12" cy="12" r="2.5"></circle>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div style="padding-top:4px;" id="validation-password" class="hide"><span
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
                                            </svg></span><span><span id="password-message"
                                                class="validation_sentence">Required
                                                field</span></span></span>
                                </div>
                                <div class="hide" id="password-requirement">
                                    <div style="padding-top:4px;" id="validation-password2"><span
                                            style="display:flex;color:#b91e1e"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="password-message2"
                                                    class="validation_sentence">8 - 15 characters</span></span></span>
                                    </div>
                                    <div style="padding-top:4px;" id="validation-password4"><span
                                            style="display:flex;color:#b91e1e"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="password-message4"
                                                    class="validation_sentence">A lowercase letter</span></span></span>
                                    </div>
                                    <div style="padding-top:4px;" id="validation-password5"><span
                                            style="display:flex;color:#b91e1e"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="password-message5"
                                                    class="validation_sentence">A capital (uppercase)
                                                    letter</span></span></span>
                                    </div>
                                    <div style="padding-top:4px;" id="validation-password3"><span
                                            style="display:flex;color:#b91e1e"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="password-message3"
                                                    class="validation_sentence">A number</span></span></span>
                                    </div>
                                    <div style="padding-top:4px;" id="validation-password6"><span
                                            style="display:flex;color:#b91e1e"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="password-message6"
                                                    class="validation_sentence">A symbol</span></span></span>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="question" style="padding-bottom: 8px;">Confirm Password</label>
                                <div style="position: relative;">
                                    <input id="confirm_password" class="register_input" type="password"
                                        style="width: calc(100% - 54px); padding-right: 40px;">
                                    <button id="toggleConfirmPassword" style="border: none; padding: 0; outline: none;"
                                        class="password_btn">
                                        <span id="confirmEyeIcon">
                                            <!-- SVG for 'eye closed' here -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" focusable="false" fill="currentColor"
                                                style="width:20px;height:20px;" aria-hidden="true">
                                                <path
                                                    d="M21.912 11.59C21.791 11.32 18.867 5 12 5s-9.791 6.32-9.912 6.59a1.001 1.001 0 0 0 0 .82C2.209 12.68 5.133 19 12 19s9.791-6.32 9.912-6.59a1.001 1.001 0 0 0 0-.82ZM12 17c-4.708 0-7.173-3.728-7.877-5C4.827 10.728 7.292 7 12 7c4.71 0 7.175 3.73 7.877 5-.704 1.272-3.169 5-7.877 5Z">
                                                </path>
                                                <circle cx="12" cy="12" r="2.5"></circle>
                                            </svg>
                                        </span>
                                    </button>

                                </div>
                                <div style="padding-top:4px;" id="validation-confirm" class="hide"><span
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
                                            </svg></span><span><span id="confirm-message"
                                                class="validation_sentence">Required
                                                field</span></span></span>
                                </div>
                            </div>





                        </div>
                    </div>

                    <div class="register_form" style="margin-top:10px;">
                        <div style="padding:48px;">

                            <div style="display: flex; align-items: center;position:relative;right:39px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16"
                                    style="width:24px;height:24px;padding-right:15px;" aria-hidden="true">
                                    <path d="M9 6h2v2H9zm4 0h2v2h-2zm-4 4h2v2H9zm4 0h2v2h-2zm-4 4h2v2H9zm4 0h2v2h-2z">
                                    </path>
                                    <path
                                        d="M17 2.2V2c0-.6-.4-1-1-1H8c-.6 0-1 .4-1 1v.2C5.9 2.6 5 3.7 5 5v16c0 .6.4 1 1 1h12c.6 0 1-.4 1-1V5c0-1.3-.9-2.4-2-2.8zM17 20h-3v-2h-4v2H7V5c0-.6.4-1 1-1h8c.6 0 1 .4 1 1v15z">
                                    </path>
                                </svg>
                                <h3 class="business_detail_title">Business Details</h3>
                            </div>
                            <div class="form-group">
                                <label class="question" style="padding-bottom: 8px;">Given name</label>
                                <label class="question"
                                    style="padding-bottom: 8px;font-weight: 400;color: rgb(90, 104, 129);">Enter your
                                    real name for security. This is not displayed on job ads
                                </label>
                                <input class="register_input" type="text" name="companyPerson" id="person">
                                <div style="padding-top:4px;" id="validation-person" class="hide"><span
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
                                            </svg></span><span><span id="person-message"
                                                class="validation_sentence">Required
                                                field</span></span></span></div>
                            </div>

                            <div class="form-group">
                                <label class="question" style="padding-bottom: 8px;">Phone Number</label>
                                <label class="question"
                                    style="padding-bottom: 8px;font-weight: 400;color: rgb(90, 104, 129);">We might need
                                    to contact you. This is never shared with candidates.
                                </label>
                                <div style="position: relative;">
                                    <label class="phone_label" style="display: flex; align-items: center;">
                                        <span class="question"
                                            style="padding:0;font-weight: 400;color: rgb(90, 104, 129);">+60</span>
                                        <div style="padding:12px 0 12px 12px;height:24px;">
                                            <div style="background:#838fa5;opacity: 0.4;width:1px;height:100%;"></div>
                                        </div>
                                    </label>
                                    <input class="register_input" type="text" name="companyContact" id="contact"
                                        style="padding-left: 65px;width:439px;"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                                </div>
                                <div style="padding-top:4px;" id="validation-contact" class="hide"><span
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
                                            </svg></span><span><span id="contact-message"
                                                class="validation_sentence">Required
                                                field</span></span></span></div>
                            </div>

                            <div class="form-group">
                                <label class="question" style="padding-bottom: 8px;">Business name</label>
                                <label class="question"
                                    style="padding-bottom: 8px;font-weight: 400;color: rgb(90, 104, 129);">For security
                                    purposes, please enter the registered business name.
                                </label>
                                <input class="register_input" type="text" name="companyName" id="businessnname">
                                <div style="padding-top:4px;" id="validation-businessname" class="hide"><span
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
                                            </svg></span><span><span id="business-message"
                                                class="validation_sentence">Required
                                                field</span></span></span></div>
                            </div>

                            <div class="form-group">
                                <label class="question" style="padding-bottom: 8px;">Company Size</label>
                                <select class="register_input" name="companySize" id="businesssize"
                                    style="height:46px;">
                                    <option value="" selected disabled>Select company size</option>
                                    <option value="1 - 50">1 - 50 Employees</option>
                                    <option value="51 - 200">51 - 200 Employees</option>
                                    <option value="201 - 500">201 - 500 Employees</option>
                                    <option value="501 - 1000">501 - 1000 Employees</option>
                                    <option value="1001 - 2000">1001 - 2000 Employees</option>
                                    <option value="2001 - 5000">2001 - 5000 Employees</option>
                                    <option value="5000+">More than 5000 Employees</option>
                                </select>
                                <div style="padding-top:4px;" id="validation-businesssize" class="hide"><span
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
                                            </svg></span><span><span id="size-message"
                                                class="validation_sentence">Required
                                                field</span></span></span></div>
                            </div>

                            <div class="form-group">
                                <label class="question" style="padding-bottom: 8px;">Registration No.</label>

                                <input class="register_input" type="text" name="companyRegistration"
                                    id="registrationNo">
                                <div style="padding-top:4px;" id="validation-registrationNo" class="hide"><span
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
                                            </svg></span><span><span id="registration-message"
                                                class="validation_sentence">Required
                                                field</span></span></span></div>
                            </div>

                            <div class="form-group">
                                <input id="checkbox1" class="form_checkbox" type="checkbox">
                                <label for="checkbox1" class="register_pp"
                                    style="padding-left: 30px;user-select: none;">By
                                    registering, you agree to the Privacy Policy and consent to receive marketing
                                    messages from us. You can opt out at any time via the unsubscribe links or as
                                    detailed in the Privacy Policy.</label>
                                <div style="padding-top:4px;" id="validation-terms" class="hide"><span
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
                                            </svg></span><span><span id="terms-message" class="validation_sentence">To
                                                create an account, you must agree to the
                                                above terms.</span></span></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <input class="register_login_btn" type="submit" value="Register employer account"
                                        name="register_btn">
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <label class="question"
                                        style="padding-bottom: 8px;font-weight: 400;color: rgb(90, 104, 129);">Already
                                        have an account? <a class="employee_sentence" href="company_login.php">Sign
                                            in</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="company_validation.js"></script>
    <script>
        var password = document.getElementById('password');
        var togglePassword = document.getElementById('togglePassword');
        var eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function (event) {
            // Prevent the default action
            event.preventDefault();
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" focusable="false" fill="currentColor" style="width:20px;height:20px;" aria-hidden="true"><path d="M5.571 14.015A11.133 11.133 0 0 1 4.123 12C4.827 10.728 7.292 7 12 7c.192 0 .374.015.558.027l1.768-1.767A10.41 10.41 0 0 0 12 5c-6.867 0-9.791 6.32-9.912 6.59a1.001 1.001 0 0 0 0 .82 12.68 12.68 0 0 0 2.072 3.016Zm16.341-2.425a12.842 12.842 0 0 0-3.64-4.448l2.435-2.435a1 1 0 0 0-1.414-1.414l-6.384 6.384-3.232 3.232-6.384 6.384a1 1 0 1 0 1.414 1.414l2.76-2.76A10.023 10.023 0 0 0 12 19c6.867 0 9.791-6.32 9.912-6.59a1.001 1.001 0 0 0 0-.82ZM12 17a8.097 8.097 0 0 1-3.008-.578l2.099-2.099a2.488 2.488 0 0 0 3.232-3.232l2.515-2.515A10.792 10.792 0 0 1 19.877 12c-.704 1.272-3.169 5-7.877 5Z"></path></svg>'; // SVG for 'eye closed' here
            } else {
                password.type = 'password';
                eyeIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" focusable="false" fill="currentColor" style="width:20px;height:20px;" aria-hidden="true"><path d="M21.912 11.59C21.791 11.32 18.867 5 12 5s-9.791 6.32-9.912 6.59a1.001 1.001 0 0 0 0 .82C2.209 12.68 5.133 19 12 19s9.791-6.32 9.912-6.59a1.001 1.001 0 0 0 0-.82ZM12 17c-4.708 0-7.173-3.728-7.877-5C4.827 10.728 7.292 7 12 7c4.71 0 7.175 3.73 7.877 5-.704 1.272-3.169 5-7.877 5Z"></path><circle cx="12" cy="12" r="2.5"></circle></svg>'; // SVG for 'eye open' here
            }
            togglePassword.blur();
        });

        var confirmPassword = document.getElementById('confirm_password');
        var toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        var confirmEyeIcon = document.getElementById('confirmEyeIcon');

        toggleConfirmPassword.addEventListener('click', function (event) {
            // Prevent the default action
            event.preventDefault();

            if (confirmPassword.type === 'password') {
                confirmPassword.type = 'text';
                confirmEyeIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" focusable="false" fill="currentColor" style="width:20px;height:20px;" aria-hidden="true"><path d="M5.571 14.015A11.133 11.133 0 0 1 4.123 12C4.827 10.728 7.292 7 12 7c.192 0 .374.015.558.027l1.768-1.767A10.41 10.41 0 0 0 12 5c-6.867 0-9.791 6.32-9.912 6.59a1.001 1.001 0 0 0 0 .82 12.68 12.68 0 0 0 2.072 3.016Zm16.341-2.425a12.842 12.842 0 0 0-3.64-4.448l2.435-2.435a1 1 0 0 0-1.414-1.414l-6.384 6.384-3.232 3.232-6.384 6.384a1 1 0 1 0 1.414 1.414l2.76-2.76A10.023 10.023 0 0 0 12 19c6.867 0 9.791-6.32 9.912-6.59a1.001 1.001 0 0 0 0-.82ZM12 17a8.097 8.097 0 0 1-3.008-.578l2.099-2.099a2.488 2.488 0 0 0 3.232-3.232l2.515-2.515A10.792 10.792 0 0 1 19.877 12c-.704 1.272-3.169 5-7.877 5Z"></path></svg>'; // SVG for 'eye closed' here
            } else {
                confirmPassword.type = 'password';
                confirmEyeIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" focusable="false" fill="currentColor" style="width:20px;height:20px;" aria-hidden="true"><path d="M21.912 11.59C21.791 11.32 18.867 5 12 5s-9.791 6.32-9.912 6.59a1.001 1.001 0 0 0 0 .82C2.209 12.68 5.133 19 12 19s9.791-6.32 9.912-6.59a1.001 1.001 0 0 0 0-.82ZM12 17c-4.708 0-7.173-3.728-7.877-5C4.827 10.728 7.292 7 12 7c4.71 0 7.175 3.73 7.877 5-.704 1.272-3.169 5-7.877 5Z"></path><circle cx="12" cy="12" r="2.5"></circle></svg>'; // SVG for 'eye open' here
            }
            toggleConfirmPassword.blur();
        });


    </script>

    <script>



    </script>
</body>

</html>