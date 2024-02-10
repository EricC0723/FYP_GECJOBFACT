<?php

include("C:/xampp/htdocs/FYP/dataconnection.php");
require '../vendor/autoload.php'; // Add this line to include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get the company email
session_start(); // Start the session at the beginning

if (isset($_GET['applicantId'])) {
    $applicantId = $_GET['applicantId'];

    $CompanyID = null;
    if (isset($_SESSION['companyID'])) {
        $CompanyID = $_SESSION['companyID'];
        $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
    }

    $CompanyEmail = $row['CompanyEmail'];
    $CompanyName = $row['CompanyName'];

    $sql = "SELECT * FROM applications WHERE ApplicationID = $applicantId";
    $result = mysqli_query($connect, $sql);
    $arow = mysqli_fetch_assoc($result);

    $ApplyJobID = $arow['JobID'];
    $ApplicantEmail = $arow['Email'];
    $ApplicantFName = $arow['FirstName'];
    $ApplicantLName = $arow['LastName'];
    $ApplicantFullName = $arow['FirstName'] . ' ' . $arow['LastName'];

    // Prepare the SQL statement
    $sql = "UPDATE applications SET Status = 'Rejected' WHERE ApplicationID = $applicantId";

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
            $mail->Username = 'jobfactsgec112@gmail.com'; // Your Gmail address
            $mail->Password = 'wqfrqwmpezbnrjfr'; // Your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('jobfactsgec112@gmail.com', 'GEC Job Facts');
            $mail->addAddress($ApplicantEmail, $ApplicantFullName);


            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Your application with ' . $CompanyName . ' has been rejected by employer';
            $mail->Body = 'Dear ' . $ApplicantFullName . ',<br><br> We are sorry to inform you that your application has been rejected by ' . $CompanyName . '.<br><br> Please don\'t get discouraged. <br><br> Best regards,<br> GEC Job Facts.'; // The email body

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        echo 'success';
    } else {
        echo 'error';
    }
}
?>