<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($_POST["action"] == "updatejob")
        {   
            $job_id = $_POST['job_id'];
            $status = $_POST['status'];
            
            $sql = "UPDATE job_post
                SET job_status = '$status'
                WHERE Job_Post_ID = '$job_id'";
            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Updated successfully';
            } else {
                echo 'Updated failed';
            }
        }
    }
if(isset($_GET['admin_id']))
{
    $admin_id = mysqli_real_escape_string($connect, $_GET['admin_id']);

    $query = "SELECT * FROM admins WHERE AdminID='$admin_id'";
    $query_run = mysqli_query($connect, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $job_id = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'job Fetch Successfully by id',
            'data' => $job_id
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'job Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}
?>