<?php
session_start() ;
$email = $_POST["email"];
$_SESSION["new_email"] = $email;
        require "phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username='gecjobfacts888@gmail.com';
        $mail->Password='atteeyliyxloitmo';

        $mail->setFrom('gecjobfacts888@gmail.com', 'Email Change Request - GEC JobFacts');
        $mail->addAddress($email);
        $mail->addReplyTo('gecjobfacts888@gmail.com');

        $mail->isHTML(true);
        $mail->Subject="Email Change Request";
        $mail->Body="<p>Dear user, </p><br><h3>You have requested to change your email on GEC JobFacts.</h3>
        <a href='http://localhost/final_fyp/FYP/User/update_email.php'>Click here to change your email</a>
        <br>
        <p>If you did not make this request, please ignore this email.</p>
        <br>
        <br><br>
        <p>With regrads,</p>
        <b>GEC JobFacts</b>";
        if(!$mail->send()){
			?>
				<script>
					alert("<?php echo " Invalid Email "?>");
				</script>
			<?php
		}else{
					 echo 'Change password link send to your email';
		}
        ?>