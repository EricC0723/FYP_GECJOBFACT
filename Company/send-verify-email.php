<?php
session_start();
require 'vendor/autoload.php'; // Add this line to include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;

$companyEmail = $_SESSION['companyEmail']; // Get the email from the session

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
$mail->setFrom('jobfactsgec112@gmail.com', 'Mailer'); // Your Gmail address
$mail->addAddress($companyEmail, 'Joe User');

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

// Send the verification email
$mail->Body = 'Please click on the link to verify your email: http://localhost/FYP/Company/verify-email.php?data=' . urlencode($encoded);
// Send the verification email
if($mail->send()) {
    echo 'Email sent successfully';
} else {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}

?>