<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    $user_id = $_SESSION['User_ID'];
     $job_id = $_POST['job_id'];
    if ($_POST["action"] == "add_job") {
        $save_sql = "INSERT INTO save_job (UserID, Job_Post_ID, DateAdded) VALUES ('$user_id', '$job_id', CURRENT_TIMESTAMP)";
    } elseif ($_POST["action"] == "delete_job") {
        $save_sql = "DELETE FROM save_job WHERE UserID='$user_id' AND Job_Post_ID='$job_id'";
    }

    $save_result = mysqli_query($connect, $save_sql);

    $query = "SELECT * FROM save_job WHERE UserID = $user_id";
    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)<=0)
    {
        echo "no_result"; 
    }
    else if ($save_result) {
        echo "success"; 
    } else {
        echo "failed";
    }
}
?>