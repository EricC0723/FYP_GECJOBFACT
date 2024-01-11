<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_GET['jobPostID'])) {
    $jobPostID = $_GET['jobPostID'];

    // Prepare the SQL statement
    $sql = "UPDATE job_post SET Job_isDeleted = '1' WHERE Job_Post_ID = $jobPostID";

    // Execute the SQL statement
    if (mysqli_query($connect, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
}

?>
