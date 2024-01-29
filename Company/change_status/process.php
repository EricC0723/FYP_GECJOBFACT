<?php

include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_GET['applicant_id'])) {
    $applicantId = $_GET['applicant_id'];

    // Fetch the current status
    $sql = "SELECT Status FROM applications WHERE ApplicationID = $applicantId";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $currentStatus = $row['Status'];

    // Check if the current status is 'Pending'
    if ($currentStatus === 'Pending') {
        // Prepare the SQL statement
        $sql = "UPDATE applications SET Status = 'Processed' WHERE ApplicationID = $applicantId";

        // Execute the SQL statement
        if (mysqli_query($connect, $sql)) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'The application has already been processed';
    }
}
?>