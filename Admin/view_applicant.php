<?php
session_start();
require 'C:/xampp/htdocs/FYP/dataconnection.php';

if (isset($_GET['applicant_id'])) {
    $applicant_id = mysqli_real_escape_string($connect, $_GET['applicant_id']);

    //application
    $query_applications = "SELECT * FROM applications WHERE ApplicationID = '$applicant_id'";
    $result_applications = mysqli_query($connect, $query_applications);
    $applications_data = mysqli_fetch_assoc($result_applications);    

    $query_career = "SELECT * FROM applicant_career WHERE ApplicationID = '$applicant_id'";
    $result_career = mysqli_query($connect, $query_career);

    $query_career = "SELECT * FROM applicant_career WHERE ApplicationID = '$applicant_id'";
    $result_career = mysqli_query($connect, $query_career);
    
    //store career history
    $career_data = array();

    while ($row = mysqli_fetch_assoc($result_career)) {
        $career_data[] = $row;
    }

    //store education
    $query_education = "SELECT * FROM applicant_education WHERE ApplicationID = '$applicant_id'";
    $result_education = mysqli_query($connect, $query_education);
    $education_data = mysqli_fetch_array($result_education);

    $query_responses = "SELECT responses.*, questions.Job_Question_Name, options.Job_Question_Option_Name
    FROM applicant_responses AS responses
    LEFT JOIN job_question AS questions ON responses.QuestionID = questions.Job_Question_ID
    LEFT JOIN job_question_option AS options ON responses.AnswerID = options.Job_Question_Option_ID
    WHERE responses.ApplicationID = '$applicant_id'";
    $result_responses = mysqli_query($connect, $query_responses);
    $responses_data = array();

    while ($row = mysqli_fetch_assoc($result_responses)) {
    $responses_data[] = $row;
    }

    $json_data = [
        'status' => 200,
        'message' => 'Applicantion Fetch Successfully by id',
        'data' => [
            'applications' => $applications_data,
            'career' => $career_data,
            'education' => $education_data,
            'responses' => $responses_data,
        ],
    ];

    echo json_encode($json_data);
} else {
    $res = [
        'status' => 400,
        'message' => 'applicant_id not provided',
    ];
    echo json_encode($res);
}
?>