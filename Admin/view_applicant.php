<?php
session_start();
require 'C:/xampp/htdocs/FYP/dataconnection.php';

if (isset($_GET['applicant_id'])) {
    $applicant_id = mysqli_real_escape_string($connect, $_GET['applicant_id']);

    // 查询 applications 表
    $query_applications = "SELECT * FROM applications WHERE ApplicationID = '$applicant_id'";
    $result_applications = mysqli_query($connect, $query_applications);
    $applications_data = mysqli_fetch_array($result_applications);

    $query_career = "SELECT * FROM applicant_career WHERE ApplicationID = '$applicant_id'";
    $result_career = mysqli_query($connect, $query_career);

    $query_career = "SELECT * FROM applicant_career WHERE ApplicationID = '$applicant_id'";
    $result_career = mysqli_query($connect, $query_career);
    
    // 初始化一个数组来存储所有 career 的数据
    $career_data = array();
    
    // 循环遍历结果集，将每一行数据添加到数组中
    while ($row = mysqli_fetch_assoc($result_career)) {
        $career_data[] = $row;
    }

    // 查询 applicant_education 表
    $query_education = "SELECT * FROM applicant_education WHERE ApplicationID = '$applicant_id'";
    $result_education = mysqli_query($connect, $query_education);
    $education_data = mysqli_fetch_array($result_education);

    $query_responses = "SELECT * FROM applicant_responses WHERE ApplicationID = '$applicant_id'";
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