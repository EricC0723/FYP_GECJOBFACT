<?php
session_start();
include("C:/xampp/htdocs/FYP/dataconnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = isset($_POST["new_password"]) ? $_POST["new_password"] : '';
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $user_id = $_SESSION['User_ID'];
    
    $update_query = "UPDATE users SET Password = '$hashed_password' WHERE UserID = '$user_id'";
    $update_result = mysqli_query($connect, $update_query);

    if ($update_result) {
        echo 'Password updated successfully, please login again';
    } else {
        echo 'update_error';
    }
    mysqli_close($connect);
}
?>
