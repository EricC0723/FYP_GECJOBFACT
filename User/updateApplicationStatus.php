<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    $user_id = $_SESSION['User_ID'];
    $job_id = $_POST['job_id'];
    
     if ($_POST["action"] == "delete_application"){
         $sql = "UPDATE applications
            SET applicant_isDeleted = 1
            WHERE UserID='$user_id' AND JobID='$job_id'";
        $updated_result = mysqli_query($connect, $sql);
        if ($updated_result) {
            echo "Deleted successfuly"; 
        } 
    }
}
?>