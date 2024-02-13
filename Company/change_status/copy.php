<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_GET['jobPostID'])) {
    $jobPostID = $_GET['jobPostID'];


    $sql = "SELECT * FROM job_post WHERE Job_Post_ID = $jobPostID";
    $result = mysqli_query($connect, $sql);

    // Check if a row was fetched
    if (mysqli_num_rows($result) > 0) {
        // Get the fetched row
        $row = mysqli_fetch_assoc($result);

        // Insert a new row with the fetched data
        $sql = "INSERT INTO job_post (Job_Post_Title, Job_Post_Position, Job_Post_Exp, Job_Post_MinSalary, Job_Post_MaxSalary, Job_Post_Description, CompanyID, Main_Category_ID, Sub_Category_ID, Job_Post_Type, Job_Location_ID, Job_Post_Location, Job_Post_Responsibilities, Job_Post_Benefits, Main_Category_Name, Sub_Category_Name, Job_Logo_Url, Job_Cover_Url)
        VALUES ('" . mysqli_real_escape_string($connect, $row['Job_Post_Title']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Post_Position']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Post_Exp']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Post_MinSalary']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Post_MaxSalary']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Post_Description']) . "', '" . mysqli_real_escape_string($connect, $row['CompanyID']) . "', '" . mysqli_real_escape_string($connect, $row['Main_Category_ID']) . "', '" . mysqli_real_escape_string($connect, $row['Sub_Category_ID']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Post_Type']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Location_ID']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Post_Location']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Post_Responsibilities']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Post_Benefits']) . "', '" . mysqli_real_escape_string($connect, $row['Main_Category_Name']) . "', '" . mysqli_real_escape_string($connect, $row['Sub_Category_Name']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Logo_Url']) . "', '" . mysqli_real_escape_string($connect, $row['Job_Cover_Url']) . "')";
        
        $result = mysqli_query($connect, $sql);
        if ($result) {
            $jobid = mysqli_insert_id($connect);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }

        $sqlq = "SELECT * FROM job_post_questions WHERE JobID = $jobPostID";
        $resultq = mysqli_query($connect, $sqlq);
        if (mysqli_num_rows($resultq) > 0) {
            while ($rowq = mysqli_fetch_assoc($resultq)) {
                $sql2 = "INSERT INTO job_post_questions (JobID, QuestionID)
                VALUES ('$jobid', '" . mysqli_real_escape_string($connect, $rowq['QuestionID']) . "')";
                $result2 = mysqli_query($connect, $sql2);
            }
        }


        // Check if the operation was successful
        if ($result2) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}
?>