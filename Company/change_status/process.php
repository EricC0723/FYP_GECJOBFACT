<?php

include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_GET['applicant_id'])) {
    $applicantId = $_GET['applicant_id'];

    // Prepare the SQL statement
    $sql = "UPDATE applications SET Status = 'Processed' WHERE ApplicationID = $applicantId";

    // Execute the SQL statement
    if (mysqli_query($connect, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>