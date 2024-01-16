<?php

include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_GET['applicantId'])) {
    $applicantId = $_GET['applicantId'];

    // Prepare the SQL statement
    $sql = "UPDATE applications SET Status = 'Accepted' WHERE ApplicationID = $applicantId";

    // Execute the SQL statement
    if (mysqli_query($connect, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>