<?php
session_start();
include("C:/xampp/htdocs/FYP/dataconnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $new_email = $_SESSION["new_email"];
    $user_id = $_SESSION['User_ID'];

    $email = mysqli_real_escape_string($connect, $new_email);

    $update_query = "UPDATE users SET Email = '$email' WHERE UserID = '$user_id'";
    $update_result = mysqli_query($connect, $update_query);

    if ($update_result) {
        header("Location: success_changeEmail.html");
        exit();
    } else {
        echo 'update_error';
    }
    mysqli_close($connect);
}
?>
