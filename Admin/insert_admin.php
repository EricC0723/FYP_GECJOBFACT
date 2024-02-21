<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($_POST["action"] == "insert_admin")
        {
            $Fname= $_POST['Fname'];
            $Lname= $_POST['Lname'];
            $phone= $_POST['phone'];
            $date_of_birth= $_POST['date_of_birth'];
            $address= $_POST['address'];
            $postcode= $_POST['postcode'];
            $state= $_POST['state'];
            $email= $_POST['email'];
            $type= $_POST['type'];

            $picture = $_FILES['picture'];
            $picture_dir = '../Admin/adminPicture/';
            $picture_name = $picture['name'];
            $file_extension = pathinfo($picture_name, PATHINFO_EXTENSION);
            $picture_tmp = $picture['tmp_name'];

            // 为目标文件生成一个唯一的文件名，防止文件名冲突
            $unique_filename = uniqid('image_') . '.' . $file_extension;

            $picturetargetPath = $picture_dir . $unique_filename;
            move_uploaded_file($picture_tmp, $picturetargetPath);
            $sql = "INSERT INTO admins (FirstName, LastName, AdminPhone,StreetAddress,StateAndCity,PostalCode,AdminStatus,Email,DateOfBirth,AdminType,AdminPicture)
            VALUES ('$Fname', '$Lname', '$phone', '$address', '$state', '$postcode', 'Active', '$email', '$date_of_birth','$type','$picturetargetPath')";
            $result = mysqli_query($connect, $sql);

            if ($result) {
                $lastInsertID = mysqli_insert_id($connect);
                $resetLink = 'http://localhost/final_fyp/FYP/Admin/update_password.php?admin_id=' . $lastInsertID;

                echo 'Inserted successfully';
                require "phpmailer/PHPMailerAutoload.php";
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host='smtp.gmail.com';
                $mail->Port=587;
                $mail->SMTPAuth=true;
                $mail->SMTPSecure='tls';

                $mail->Username='gecjobfacts888@gmail.com';
                $mail->Password='atteeyliyxloitmo';

                $mail->setFrom('gecjobfacts888@gmail.com', 'New Admin Registration - GEC JobFacts');
                $mail->addAddress($email);
                $mail->addReplyTo('gecjobfacts888@gmail.com');

                $mail->isHTML(true);
                $mail->Subject="Welcome to GEC JobFacts!";
                $mail->Body="<p>We're excited to have you on board as a new admin. To ensure the security of your account, please click the link below to set up your account password:</p><br>
                <a href='$resetLink'>Set Up Password</a>
                <br>
                <br><br>
                <p>With regrads,</p>
                <b>GEC JobFacts</b>";
                if(!$mail->send()) {
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                }
                }
            }
        else if($_POST["action"] == "edit_admin")
        {   $AdminID = $_POST['AdminID'];
             $Fname = $_POST['edit_FirstName'];
            $Lname = $_POST['edit_LastName'];
            $phone = $_POST['edit_Phone'];
            $date_of_birth = $_POST['edit_DateOfBirth'];
            $address = $_POST['edit_StreetAddress'];
            $postcode = $_POST['edit_PostalCode'];
            $state = $_POST['edit_StateAndCity'];
            $password = $_POST['edit_Password'];
            $type = $_POST['edit_AdminType'];
            $status = $_POST['edit_AdminStatus'];
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
            // Process the profile picture
            $profilePictureTmpName = $_FILES['profile_picture']['tmp_name'];
            $profilePictureName = $_FILES['profile_picture']['name'];
    
            // Move the uploaded file to a desired directory
            $uploadDirectory = '../Admin/adminPicture/';
            $targetPath = $uploadDirectory . $profilePictureName;
            move_uploaded_file($profilePictureTmpName, $targetPath);
            // You can now use $targetPath as the path to the uploaded profile picture
            $sql = "UPDATE admins 
            SET FirstName='$Fname',
                LastName='$Lname',
                AdminPhone='$phone', 
                StreetAddress='$address', 
                StateAndCity='$state', 
                PostalCode='$postcode', 
                DateOfBirth='$date_of_birth', 
                Password='$password', 
                AdminType='$type' ,
                AdminStatus='$status' ,
                AdminPicture='$targetPath'
            WHERE AdminID = $AdminID";

            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Update successfully';
            } else {
                echo 'Update failed';
            }
            }
            else{
                $sql = "UPDATE admins 
            SET FirstName='$Fname',
                LastName='$Lname',
                AdminPhone='$phone', 
                StreetAddress='$address', 
                StateAndCity='$state', 
                PostalCode='$postcode', 
                DateOfBirth='$date_of_birth', 
                Password='$password', 
                AdminType='$type',
                AdminStatus='$status'
            WHERE AdminID = $AdminID";

            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Update successfully';
            } else {
                echo 'Update failed';
            }
            }
        }
        else if($_POST["action"] == "update_admin")
        {   $AdminID = $_POST['AdminID'];
             $Fname = $_POST['edit_FirstName'];
            $Lname = $_POST['edit_LastName'];
            $phone = $_POST['edit_Phone'];
            $date_of_birth = $_POST['edit_DateOfBirth'];
            $address = $_POST['edit_StreetAddress'];
            $postcode = $_POST['edit_PostalCode'];
            $state = $_POST['edit_StateAndCity'];
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
            // Process the profile picture
            $profilePictureTmpName = $_FILES['profile_picture']['tmp_name'];
            $profilePictureName = $_FILES['profile_picture']['name'];
    
            // Move the uploaded file to a desired directory
            $uploadDirectory = '../Admin/adminPicture/';
            $targetPath = $uploadDirectory . $profilePictureName;
            $_SESSION['profile'] = $targetPath;
            $_SESSION['First_Name'] = $_POST['edit_FirstName'];
            $_SESSION['Last_Name'] = $_POST['edit_LastName'];
            move_uploaded_file($profilePictureTmpName, $targetPath);
            // You can now use $targetPath as the path to the uploaded profile picture
            $sql = "UPDATE admins 
            SET FirstName='$Fname',
                LastName='$Lname',
                AdminPhone='$phone', 
                StreetAddress='$address', 
                StateAndCity='$state', 
                PostalCode='$postcode', 
                DateOfBirth='$date_of_birth', 
                AdminPicture='$targetPath'
            WHERE AdminID = $AdminID";

            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Update successfully';
            } else {
                echo 'Update failed';
            }
            }
            else{
                $sql = "UPDATE admins 
            SET FirstName='$Fname',
                LastName='$Lname',
                AdminPhone='$phone', 
                StreetAddress='$address', 
                StateAndCity='$state', 
                PostalCode='$postcode', 
                DateOfBirth='$date_of_birth'
            WHERE AdminID = $AdminID";

            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Update successfully';
            } else {
                echo 'Update failed';
            }
            }
        }
        if($_POST["action"] == "request_password_reset")
        {
            $adminID= $_POST['adminID'];
            $email= $_POST['email'];

                $resetLink = 'http://localhost/FYP/Admin/update_password.php?admin_id=' . $adminID;
                echo 'Inserted successfully';
                require "phpmailer/PHPMailerAutoload.php";
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host='smtp.gmail.com';
                $mail->Port=587;
                $mail->SMTPAuth=true;
                $mail->SMTPSecure='tls';

                $mail->Username='gecjobfacts888@gmail.com';
                $mail->Password='atteeyliyxloitmo';

                $mail->setFrom('gecjobfacts888@gmail.com', 'Change password request - GEC JobFacts');
                $mail->addAddress($email);
                $mail->addReplyTo('gecjobfacts888@gmail.com');

                $mail->isHTML(true);
                $mail->Subject="Welcome to GEC JobFacts!";
                $mail->Body = "<p>Hello Admin,</p>
                <p>We have received a request to change the password for your account at GEC JobFacts. Please click the link below to proceed with the password reset:</p>
                <a href='$resetLink'>Reset Password</a>
                <br><br>
                <p>If you did not make this request, you can ignore this email.</p>
                <br><br>
                <p>Best regards,</p>
                <b>GEC JobFacts</b>";
                if(!$mail->send()) {
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Successfully';
                }
            }
    }