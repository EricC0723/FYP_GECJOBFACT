<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($_POST["action"] == "insert_user")
        {   
            $Fname= $_POST['FirstName'];
            $Lname= $_POST['LastName'];
            $email= $_POST['email'];
            $password= $_POST['password'];
            $phone= $_POST['phone'];
            $location= $_POST['location'];
            $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (FirstName, LastName, Phone,Password,Email,Location)
            VALUES ('$Fname', '$Lname', '$phone', '$bcrypt_password', '$email', '$location')";

            if (mysqli_query($connect, $sql)) {
                $otp = rand(100000,999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['mail'] = $email;
                require "phpmailer/PHPMailerAutoload.php";
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host='smtp.gmail.com';
                $mail->Port=587;
                $mail->SMTPAuth=true;
                $mail->SMTPSecure='tls';

                $mail->Username='gecjobfacts888@gmail.com';
                $mail->Password='atteeyliyxloitmo';

                $mail->setFrom('gecjobfacts888@gmail.com', 'GEC JobFact OTP');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject="Your verify code";
                $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                <br><br>
                <p>With regrads,</p>
                <b>GEC JobFacts</b>";
                        if(!$mail->send()){
                            echo "fail";
                        }else{
                            echo "success";
                        }
            }
        }
    }