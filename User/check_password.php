<?php
session_start();
include("C:/xampp/htdocs/FYP/dataconnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $user_id = $_SESSION['User_ID'];

    $password = mysqli_real_escape_string($connect, $password);

    $query = "SELECT Password FROM users WHERE UserID = '$user_id'";
    $result = mysqli_query($connect, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $current_password = $row['Password'];

        if (password_verify($password, $current_password)) {
            // 密码匹配
            echo 'match';
        } else {
            // 密码不匹配
            echo 'not_match';
        }
    } else {
        // 查询错误
        echo 'error';
    }

    // 关闭数据库连接
    mysqli_close($connect);
}
?>
