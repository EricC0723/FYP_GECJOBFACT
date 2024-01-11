<?php
session_start();

// Set headers to prevent caching
header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

session_destroy();
echo '<script>window.location.href = "company_login.php";</script>';
?>