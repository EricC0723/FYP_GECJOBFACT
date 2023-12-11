<?php
// check_email.php

// Include the database connection file
include("C:/xampp/htdocs/FYP/dataconnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email from the AJAX request
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Sanitize the email input to prevent SQL injection
    $email = mysqli_real_escape_string($connect, $email);

    // Perform the database query to check if the email exists
    $query = "SELECT COUNT(*) AS count FROM companies WHERE CompanyEmail = '$email'";
    $result = mysqli_query($connect, $query);

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
