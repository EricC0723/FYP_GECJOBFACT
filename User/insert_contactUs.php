<?php
session_start();
include("C:/xampp/htdocs/FYP/dataconnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收前端传递的数据
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $user_email = $_POST['email'];
    // 执行插入数据的 SQL 查询
    $query = "INSERT INTO user_contact_us (UserEmail,Subject, Message) VALUES ('$user_email','$subject', '$message')";
    $result = mysqli_query($connect, $query);

    if ($result) {
        // 插入成功
        echo "Your message has been successfully submitted!";
    } else {
        // 插入失败
        echo "Error: " . mysqli_error($connect);
    }
} else {
    echo "Invalid request method!";
}
?>