
<?php
$email = $job_row["CompanyEmail"];
        require "phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username='gecjobfacts888@gmail.com';
        $mail->Password='atteeyliyxloitmo';

        $mail->setFrom('gecjobfacts888@gmail.com', 'New Job Application');
        $mail->addAddress($email);
        $mail->addReplyTo('gecjobfacts888@gmail.com');

        $mail->isHTML(true);
        $mail->Subject="New Job Application";
        $mail->Body="<p>Dear company, </p><br><h3>Someone has applied for the job posted on GEC JobFact.</h3>
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
			?>
				<script>
					window.location.replace("login.php");
				</script>
			<?php
		}
        ?>