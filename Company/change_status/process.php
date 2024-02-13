<?php

include("C:/xampp/htdocs/FYP/dataconnection.php");
require '../vendor/autoload.php'; // Add this line to include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get the company email
session_start(); // Start the session at the beginning

if (isset($_GET['applicant_id'])) {
    $applicantId = $_GET['applicant_id'];

    $CompanyID = null;
    if (isset($_SESSION['companyID'])) {
        $CompanyID = $_SESSION['companyID'];
        $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
    }

    $CompanyEmail = $row['CompanyEmail'];
    $CompanyName = $row['CompanyName'];

    // Fetch the current status
    $sql = "SELECT * FROM applications WHERE ApplicationID = $applicantId";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $currentStatus = $row['Status'];
    $ApplyJobID = $row['JobID'];
    $ApplicantEmail = $row['Email'];
    $ApplicantFName = $row['FirstName'];
    $ApplicantLName = $row['LastName'];
    $ApplicantFullName = $row['FirstName'] . ' ' . $row['LastName'];

    // Check if the current status is 'Pending'
    if ($currentStatus === 'Pending') {
        // Prepare the SQL statement
        $sql = "UPDATE applications SET Status = 'Processed' WHERE ApplicationID = $applicantId";

        // Execute the SQL statement
        if (mysqli_query($connect, $sql)) {
            $sql = "SELECT * FROM job_post WHERE Job_Post_ID = $ApplyJobID";
            $result = mysqli_query($connect, $sql);
            $rowj = mysqli_fetch_assoc($result);
            $JobTitle = $rowj['Job_Post_Title'];
            $jobLocation = $rowj['Job_Post_Location'];

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Changed to Gmail's SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'gecjobfacts888@gmail.com'; // Your Gmail address
                $mail->Password = 'atteeyliyxloitmo'; // Your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('gecjobfacts888@gmail.com', 'GEC Job Facts');
                $mail->addAddress($ApplicantEmail, $ApplicantFullName);


                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Your application with ' . $CompanyName . ' has been viewed by employer';
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
                    <div class="header">Dear ' . $ApplicantFullName . ',</div>
                    <div class="body">
                      <p>Good News! Your application below has been viewed by employer.</p>
                      <table>
                      <thead>
                      <tr>
                          <th style="width:200px;text-align:left;">Company</th>
                          <th style="width:50px"></th>
                          <th style="width:200px;text-align:left;">Job Title</th>
                      </tr>
                        </thead>
                        <tbody>
                                <tr>
                                <td style="text-align:left;">' . $CompanyName . '</td>
                                <td></td>
                                <td style="text-align:left;">' . $JobTitle . '</td>
                                </tr>
                        </tbody>
                        </table>
    
                  
                      <p>Wish you all the best & Good Luck!</p>
                    </div>
                    <div><a href="http://localhost/FYP/Company/company_login.php">Check it Now</a>
                    </div>
                    <div style="height:20px"></div>
                    <div class="footer">Best regards,<br> GEC Job Facts.</div>
                  </div>
                </body>
                </html>';
                $mail->send();

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo 'success';

        } else {
            echo 'error';
        }
    } else {
        echo 'The application has already been processed';
    }
}
?>