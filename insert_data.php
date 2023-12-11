<?php session_start(); ?>
<?php
// insert_data.php
include("C:/xampp/htdocs/FYP/dataconnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Make sure to validate and sanitize the inputs before using them in the SQL query
    $contact_person = mysqli_real_escape_string($connect, $_POST["contact_person"]);
    $email = mysqli_real_escape_string($connect, $_POST["Email_id"]);
    $pw = mysqli_real_escape_string($connect, $_POST["password"]);
    $phone_number = mysqli_real_escape_string($connect, $_POST["phone_number"]);
    $business_name = mysqli_real_escape_string($connect, $_POST["business_name"]);
    $bcrypt_password = password_hash($pw, PASSWORD_BCRYPT);
    //date_default_timezone_set("Asia/Kuala_Lumpur");
    //$currentDateTime = date('Y-m-d H:i:s');
    // Perform the database insertion   
    if (!$connect) {
        ?>
        <script type="text/javascript">
            alert("Failed to connect to the database!");
        </script>
        <?php
    } else {
        $sql = "INSERT INTO companies (CompanyEmail, ContactPerson, CompanyPhone, CompanyName, CompanyPassword)
                VALUES ('$email', '$contact_person', '$phone_number', '$business_name', '$bcrypt_password')";
        //'$currentDateTime',register_date
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
                                ?>
                                    <script>
                                        alert("<?php echo "Register Failed, Invalid Email "?>");
                                        window.location.replace('Register.php');
                                    </script>
                                <?php
                            }else{
                                ?>
                                <script>
                                    alert("<?php echo "Register Successfully, OTP sent to " . $email ?>");
                                    window.location.replace('verification.php');
                                </script>
                                <?php
                            }
                }
         else {
            ?>
            <script type="text/javascript">
                alert("Error: Failed to insert data into the database!");
            </script>
            <?php
        }
    }

    mysqli_close($connect);
}
?>