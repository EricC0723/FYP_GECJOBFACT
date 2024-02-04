<?php
session_start();

// 清除会话
session_unset();
session_destroy();

// 发送禁止缓存的 HTTP 头
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

// 重定向到登录页面
header("Location: admin_login.php");
exit();
?>