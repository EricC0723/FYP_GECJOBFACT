<?php
include("dataconnection.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['fetch']) && $_GET['fetch'] === 'job_specialisations') {
        // Fetch job specialisations
        $query = "SELECT Main_Category_ID as value, Main_Category_Name as label FROM main_category";
        $result = mysqli_query($connect, $query);

        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = array(
                'value' => $row['value'],
                'label' => $row['label']
            );
        }

        echo json_encode($data);
        exit;
    } elseif (isset($_GET['fetch']) && $_GET['fetch'] === 'job_roles' && isset($_GET['jobSpecialisationId'])) {
        // Fetch job roles
        $jobSpecialisationId = $_GET['jobSpecialisationId'];
        $query = "SELECT Sub_Category_ID as value, Sub_Category_Name as label FROM sub_category WHERE Main_Category_ID = $jobSpecialisationId";
        $result = mysqli_query($connect, $query);

        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = array(
                'value' => $row['value'],
                'label' => $row['label']
            );
        }

        echo json_encode($data);
        exit;
    }

    if (isset($_GET['fetch']) && $_GET['fetch'] === 'job_locations') {
        // Fetch job locations
        $query = "SELECT Job_Location_ID, Job_Location_Name FROM job_location";
        $result = mysqli_query($connect, $query);

        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = array(
                'value' => $row['Job_Location_ID'],
                'label' => $row['Job_Location_Name']
            );
        }

        echo json_encode($data);
        exit;
    }

    if (isset($_GET['fetch']) && $_GET['fetch'] === 'job_questions') {
        // Fetch job questions
        $query = "SELECT Job_Question_ID, Job_Question_Name, Job_Question_Type FROM job_question WHERE Recommended_Question = 0";
        $result = mysqli_query($connect, $query);

        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = array(
                'value' => $row['Job_Question_ID'],
                'label' => $row['Job_Question_Name'],
                'type' => $row['Job_Question_Type']
            );
        }

        echo json_encode($data);
        exit;
    }


    if (isset($_GET['fetch']) && $_GET['fetch'] === 'job_question_options' && isset($_GET['questionId'])) {
        // Fetch job question options
        $questionId = $_GET['questionId'];
        $query = "SELECT job_question_option.Job_Question_Option_Name, job_question.Job_Question_Type 
                  FROM job_question_option 
                  INNER JOIN job_question ON job_question_option.Job_Question_ID = job_question.Job_Question_ID 
                  WHERE job_question_option.Job_Question_ID = $questionId";
        $result = mysqli_query($connect, $query);

        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = array(
                'name' => $row['Job_Question_Option_Name'],
                'type' => $row['Job_Question_Type']
            );
        }

        echo json_encode($data);
        exit;
    }


}



?>