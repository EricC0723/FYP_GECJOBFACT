<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    require "phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username = 'gecjobfacts888@gmail.com';
    $mail->Password = 'atteeyliyxloitmo';

    $mail->setFrom('gecjobfacts888@gmail.com', 'GEC JobFact OTP');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Your verify code";
    $mail->Body = "<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                <br><br>
                <p>With regards,</p>
                <b>GEC JobFacts</b>";

    if ($mail->send()) {
        echo "OTP sent successfully!";
    } else {
        echo "Error sending OTP: " . $mail->ErrorInfo;
    }
}
?>