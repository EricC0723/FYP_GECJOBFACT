<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
if(isset($_GET['contactid']))
{
    $contactid = mysqli_real_escape_string($connect, $_GET['contactid']);

    $query = "SELECT * FROM company_contact_us WHERE c_ContactID='$contactid'";
    $query_run = mysqli_query($connect, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $contact = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Company contact us Fetch Successfully by id',
            'data' => $contact
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Company contact us Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST["action"] == "updateResponse")
    {   
        $contactid = $_POST['contactid'];
        $company_email = $_POST['company_email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $response = $_POST['response'];
        if (empty($response)) {
            echo 'Failed';
            exit;
        }
        $sql = "UPDATE company_contact_us 
            SET Response = '$response', ResponseStatus = 1
            WHERE c_ContactID  = '$contactid'";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            require "phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            $mail->Username='gecjobfacts888@gmail.com';
            $mail->Password='atteeyliyxloitmo';

            $mail->setFrom('gecjobfacts888@gmail.com', '- GEC JobFacts');
            $mail->addAddress($company_email);
            $mail->addReplyTo('gecjobfacts888@gmail.com');

            $mail->isHTML(true);
            $mail->Subject="Your Inquiry Response";
            $mail->Subject="Your Inquiry Response";
            $mail->Body="
            <p>Dear Company,</p>
            <p>Thank you for reaching out to us. Here is our response to your inquiry:</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong> $message</p>
            <p><strong>Our Response:</strong> $response</p>
            <br><br>
            <p>With regards,</p>
            <b>GEC JobFacts</b>";
            
            if(!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Your response has been sent successfully!';
            }
            }
    }
}
?>