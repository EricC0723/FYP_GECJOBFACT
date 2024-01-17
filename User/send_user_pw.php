<?php
session_start();
include("C:/xampp/htdocs/FYP/dataconnection.php");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $sql = mysqli_query($connect, "SELECT * FROM users WHERE Email='$email'");
        $query = mysqli_num_rows($sql);
        $fetch = mysqli_fetch_assoc($sql);
        if($query <= 0){
            echo "no_exist";
            exit();
        }
        else{
        require "phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username='gecjobfacts888@gmail.com';
        $mail->Password='atteeyliyxloitmo';

        $mail->setFrom('gecjobfacts888@gmail.com', 'Recover your password');
        $mail->addAddress($email);
        $mail->addReplyTo('gecjobfacts888@gmail.com');

        $mail->isHTML(true);
		$mail->Subject="Recover your password";
		$mail->Body="<b>Dear User</b>
		<h3>We received a request to reset your password.</h3>
		<p>Kindly click the below link to reset your password</p>
		http://localhost/final_fyp/FYP/User/resetPassword.php
		<br><br>
		<p>With regrads,</p>
		<b>GEC Job Facts</b>";
        if(!$mail->send()){
                    echo "email not valid";
		}else{
					echo "success";
		}
    }
}