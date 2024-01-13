<?php
require 'C:/xampp/htdocs/FYP/dataconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST["action"] == "check_email") {
        $email = $_POST['email'];

        $sql = "SELECT COUNT(*) as count FROM admins WHERE Email = '$email'";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];

            if ($count > 0) {
                echo 'exists'; // 返回 exists 表示电子邮件已存在
            } else {
                echo 'not_exists'; // 返回 not_exists 表示电子邮件不存在
            }
        } else {
            echo 'error';
        }
    }
}
?>