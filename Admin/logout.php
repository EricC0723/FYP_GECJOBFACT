<?php
session_start();

// 清除会话
unset($_SESSION['Admin_ID']);
unset($_SESSION['First_Name']);  
unset($_SESSION['Last_Name']);  
unset($_SESSION['profile']);  
unset($_SESSION['AdminType']);  
session_destroy();

// 发送禁止缓存的 HTTP 头
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

// 重定向到登录页面
header("Location: admin_login.php");
exit();
?>