<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($_POST["action"] == "updatejob")
        {   $job_id = $_POST['job_id'];
            $title = $_POST['title'];
            $status = $_POST['status'];

            if (empty($title)) {
                echo 'Failed';
                exit;
            }
            $sql = "UPDATE job_post
                SET job_status = '$status',Job_Post_Title = '$title'
                WHERE Job_Post_ID = '$job_id'";
            $result = mysqli_query($connect, $sql);

            if ($result) {
                echo 'Updated successfully';
            } else {
                echo 'Updated failed';
            }
        }
    }
if (isset($_GET['job_id'])) {
    $job_id = mysqli_real_escape_string($connect, $_GET['job_id']);

    $query = "SELECT * FROM job_post WHERE Job_Post_ID='$job_id'";
    $job_query = "SELECT * FROM job_post_questions WHERE JobID='$job_id'";

    $query_run = mysqli_query($connect, $query);
    $job_query_run = mysqli_query($connect, $job_query);

    if (mysqli_num_rows($query_run) == 1) {
        $job_data = mysqli_fetch_array($query_run);

        // 获取关联的问题
        $questions = array();
        while ($question_row = mysqli_fetch_assoc($job_query_run)) {
            $question_id = $question_row['QuestionID'];
            $question_query = "SELECT * FROM job_question WHERE Job_Question_ID='$question_id'";
            $question_query_run = mysqli_query($connect, $question_query);
            $question_data = mysqli_fetch_assoc($question_query_run);

            // 将问题内容添加到数组
            $questions[] = $question_data;
        }

        $res = [
            'status' => 200,
            'message' => 'Job Fetch Successfully by id',
            'data' => [
                'job' => $job_data,
                'questions' => $questions
            ]
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Job Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}