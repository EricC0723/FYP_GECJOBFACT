<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($_POST["action"] == "updateUser")
        {   $user_id = $_POST['user_id'];
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $location = $_POST['location'];
            $phone = $_POST['phone'];
            $status = $_POST['status'];

            $sql = "UPDATE users 
                SET FirstName = '$firstName', LastName = '$lastName', Location = '$location', Phone = '$phone', UserStatus = '$status'
                WHERE UserID = '$user_id'";
            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Updated successfully';
            } else {
                echo 'Updated failed';
            }
        }
    }
if(isset($_GET['user_id']))
{
    $user_id = mysqli_real_escape_string($connect, $_GET['user_id']);

    $query = "SELECT * FROM users WHERE UserID='$user_id'";
    $query_run = mysqli_query($connect, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $user_id = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Student Fetch Successfully by id',
            'data' => $user_id
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Student Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}
?>