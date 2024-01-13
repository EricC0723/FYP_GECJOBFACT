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
            $password= $_POST['password'];
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
            $sql = "INSERT INTO admins (FirstName, LastName, AdminPhone,StreetAddress,StateAndCity,PostalCode,AdminStatus,Email,Password,DateOfBirth,AdminType,AdminPicture)
            VALUES ('$Fname', '$Lname', '$phone', '$address', '$state', '$postcode', 'Active', '$email', '$password','$date_of_birth','$type','$picturetargetPath')";
            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Insert successfully';
            } else {
                echo 'Insert failed';
            }
        }
    }