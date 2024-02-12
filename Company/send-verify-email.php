<?php
session_start();
require 'vendor/autoload.php'; // Add this line to include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;

$companyEmail = $_SESSION['companyEmail']; // Get the email from the session

$sql = "SELECT * FROM companies WHERE CompanyEmail = '$companyEmail'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$company_contact = $row['CompanyContact'];
$company_name = $row['CompanyName'];

$mail = new PHPMailer;

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
    <p>Please click on the link to verify your email: <a href="http://localhost/FYP/Company/verify-email.php?data=' . urlencode($encoded) . '">Click to verify</a></p>
    </div>
    <div style="height:20px"></div>
    <div class="footer">Best regards,<br> GEC Job Facts.</div>
  </div>
</body>
</html>';

if($mail->send()) {
    echo 'Email sent successfully';
} else {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}

?>