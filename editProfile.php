<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");

    if ($_POST["action"] == "profile_model") {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $location = $_POST['location'];
        $phone = $_POST['phone'];

        $user_id = $_SESSION['User_ID'];

        $sql = "UPDATE users 
                SET FirstName = '$firstName', LastName = '$lastName', Location = '$location', Phone = '$phone'
                WHERE UserID = '$user_id'";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Profile updated successfully';
        } else {
            echo 'Profile updated Failed';
        }
    }
    elseif ($_POST["action"] == "summary_model") {
        $summary = $_POST['summary'];
        $user_id = $_SESSION['User_ID'];
    
        $sql = "UPDATE users 
                SET Profile_Description = '$summary'
                WHERE UserID = '$user_id'";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Summary updated successfully';
        } else {
            echo 'Summary updated Failed';
        }
    }
    elseif ($_POST["action"] == "career_model") {
        
        $user_id = $_SESSION['User_ID'];
        $job_title = $_POST['job_title'];
        $company_name = $_POST['company_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $still_in_role = isset($_POST["still_in_role"]) ? $_POST["still_in_role"] : 0;
        $description = $_POST['description'];

        $sql = "INSERT INTO career (UserID, JobTitle, CompanyName, StartDate, EndDate, StillInRole, Description)
                VALUES ('$user_id', '$job_title', '$company_name', '$start_date', '$end_date', '$still_in_role', '$description')";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Summary updated successfully';
        } else {
            echo 'Summary updated Failed';
        }
    }
    elseif ($_POST["action"] == "education_model") {
        
        $user_id = $_SESSION['User_ID'];
    
        $sql = "UPDATE users 
                SET Profile_Description = '$summary'
                WHERE UserID = '$user_id'";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Summary updated successfully';
        } else {
            echo 'Summary updated Failed';
        }
    }elseif ($_POST["action"] == "resume_model") {
        
        $user_id = $_SESSION['User_ID'];
    
        $sql = "UPDATE users 
                SET Profile_Description = '$summary'
                WHERE UserID = '$user_id'";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Summary updated successfully';
        } else {
            echo 'Summary updated Failed';
        }
    }
}
?>