<?php
session_start();
// Include the database connection file
include("C:/xampp/htdocs/FYP/dataconnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email from the AJAX request
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $user_id = $_SESSION['User_ID'];
    // Sanitize the email input to prevent SQL injection
    $email = mysqli_real_escape_string($connect, $email);

    $exist_query = "SELECT COUNT(*) AS count FROM users WHERE Email = '$email' AND UserID = '$user_id'";
    $exist_result = mysqli_query($connect, $exist_query);
    // Perform the database query to check if the email exists
    $query = "SELECT COUNT(*) AS count FROM users WHERE Email = '$email'";
    $result = mysqli_query($connect, $query);
    if ($exist_result) {
        $exist_row = mysqli_fetch_assoc($exist_result);
        $email_exist = $exist_row['count'];
        if ($email_exist > 0) {
            echo 'same';
            exit();
        }
    }
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $email_count = $row['count'];
        if ($email_count > 0) {
            // If the email exists in the database, send 'exists' as the response
            echo 'exists';
        } else {
            // If the email does not exist in the database, send any other response
            echo 'not_exists';
        }
    } else {
        // If there is an error with the query, send an appropriate response
        echo 'error';
    }

    // Close the database connection
    mysqli_close($connect);
}
?>
