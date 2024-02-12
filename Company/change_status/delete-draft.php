<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_GET['jobPostID'])) {
    $jobPostID = $_GET['jobPostID'];

    // Prepare the SQL statement
    $sql = "DELETE FROM job_post WHERE Job_Post_ID = $jobPostID";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        $sqlq = "DELETE FROM job_post_questions WHERE JobID = $jobPostID";
        // Execute the SQL statement
        if (mysqli_query($connect, $sqlq)) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }


}
?>