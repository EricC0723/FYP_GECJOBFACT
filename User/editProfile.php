<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    //profile
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
    //summary
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
    //career
    elseif ($_POST["action"] == "career_model") {
        $user_id = $_SESSION['User_ID'];
        $job_title = $_POST['job_title'];
        $company_name = $_POST['company_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $still_in_role = isset($_POST["still_in_role"]) ? $_POST["still_in_role"] : 0;
        $description = $_POST['description'];

        $Dstart_date = DateTime::createFromFormat('Y-m', $_POST['start_date']);
        $Dend_date = DateTime::createFromFormat('Y-m', $_POST['end_date']);

        if (empty($job_title) || empty($company_name) || empty($start_date) || (empty($still_in_role) && empty($end_date)) || strlen($job_title) > 100 || strlen($company_name) > 100 || strlen($description) > 700 || ($start_date == $end_date && empty($still_in_role))){
            echo 'failed';
            exit;
        }
        else if(($still_in_role == 0 && $Dstart_date > $Dend_date))
        {   
            echo 'time_format_error';
            exit;
        }
        $sql = "INSERT INTO career (UserID, JobTitle, CompanyName, StartDate, EndDate, StillInRole, Description)
                VALUES ('$user_id', '$job_title', '$company_name', '$start_date', '$end_date', '$still_in_role', '$description')";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Career updated successfully';
        } else {
            echo 'Career updated Failed';
        }
    }
    //edit career
    elseif ($_POST["action"] == "edit_career_model") {
        $career_id = $_POST['career_id'];
        $job_title = $_POST['job_title'];
        $company_name = $_POST['company_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $still_in_role = isset($_POST["still_in_role"]) ? $_POST["still_in_role"] : 0;
        $description = $_POST['description'];

        $Dstart_date = DateTime::createFromFormat('Y-m', $_POST['start_date']);
        $Dend_date = DateTime::createFromFormat('Y-m', $_POST['end_date']);
        if (empty($job_title) || empty($company_name) || empty($start_date) || (empty($still_in_role) && empty($end_date)) || strlen($job_title) > 100 || strlen($company_name) > 100 || strlen($description) > 700 || ($start_date == $end_date && empty($still_in_role))){
            echo 'failed';
            exit;
        }
        else if(($still_in_role == 0 && $Dstart_date > $Dend_date))
        {   
            echo 'time_format_error';
            exit;
        }
        $sql = "UPDATE career SET JobTitle='$job_title', CompanyName='$company_name', StartDate='$start_date', EndDate='$end_date' , StillInRole='$still_in_role', Description='$description' 
        WHERE CareerID=' $career_id'";

        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Career updated successfully';
        } else {
            echo 'Career updated Failed';
        }
    }
    //delete career
    else if($_POST["action"] == "delete_career_model")
    {
        $career_id = $_POST['career_id'];

        $sql = "DELETE FROM career WHERE CareerID=' $career_id'";

        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Career delete successfully';
        } else {
            echo 'Career delete failed';
        }
    }
    //education 
    elseif ($_POST["action"] == "education_model") {
        $user_id = $_SESSION['User_ID'];
        $institution = $_POST['institution'];
        $qualification = $_POST['qualification'];
        $quali_is_complete = isset($_POST["quali_is_complete"]) ? $_POST["quali_is_complete"] : 0;
        $description = $_POST['description'];

        if (empty($institution) || empty($qualification) || strlen($institution) > 100 || strlen($qualification) > 100 || strlen($description) > 700){
            echo 'failed';
            exit;
        }
        $sql = "INSERT INTO education 
                SET Institution = '$institution',
                UserID = '$user_id',
                Course_or_Qualification = '$qualification',
                Course_Highlight = '$description',
                Qualification_complete = '$quali_is_complete'";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Add education successfully';
        } else {
            echo 'Add education Failed';
        }
    }elseif ($_POST["action"] == "delete_education_model") {
        $user_id = $_SESSION['User_ID'];

        $sql = "DELETE FROM education WHERE UserID=' $user_id'";

        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Education delete successfully';
        } else {
            echo 'Education delete failed';
        }
    }
    elseif ($_POST["action"] == "edit_education_model") {
        $institution = $_POST['institution'];
        $education_id = $_POST['education_id'];
        $qualification = $_POST['qualification'];
        $quali_is_complete = isset($_POST["quali_is_complete"]) ? $_POST["quali_is_complete"] : 0;
        $description = $_POST['description'];
        if (empty($institution) || empty($qualification) || strlen($institution) > 100 || strlen($qualification) > 100 || strlen($description) > 700){
            echo 'failed';
            exit;
        }
        $sql = "UPDATE education 
        SET Institution = '$institution',
        Course_or_Qualification = '$qualification',
        Course_Highlight = '$description',
        Qualification_complete = '$quali_is_complete'
        WHERE EducationID = '$education_id'";

        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Education updated successfully';
        } else {
            echo 'Education updated Failed';
        }
    }
    elseif ($_POST["action"] == "resume_model") {
        if (isset($_FILES['file_resume'])) {
        $user_id = $_SESSION['User_ID'];
        $upload_dir = 'resume/';
        error_log("Action: " . $_POST["action"]);
                error_log("File name: " . $_FILES['file_resume']['name']);
                $file_name = $_FILES['file_resume']['name'];
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);  // 获取文件扩展名
                $file_mime_type = mime_content_type($_FILES['file_resume']['tmp_name']);
                if ($file_mime_type != 'application/pdf') {
                    echo 'invalid_format';
                    exit();
                }
                // 修改文件名，添加用户 ID
                $new_file_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . $user_id . '.' . $file_extension;
            
                $file_tmp = $_FILES['file_resume']['tmp_name'];
                $file_size = $_FILES['file_resume']['size']; // Size in bytes
                $max_file_size = 2 * 1024 * 1024; // 2MB
        if ($file_size > $max_file_size) {
            echo 'size_extra';
            exit();
        }
        move_uploaded_file($file_tmp, $upload_dir . basename($new_file_name));

        $resume_path = $upload_dir . basename($new_file_name);
        $sql = "UPDATE users SET Resume_Path = '$resume_path' WHERE UserID = '$user_id'";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo 'Resume uploaded successfully';
        } else {
            echo 'Resume upload failed';
        }
    }
    else{
        echo 'empty';
        exit();
    }
}
elseif ($_POST["action"] == "delete_resume_model") {
    $user_id = $_SESSION['User_ID'];

    $sql = "UPDATE users SET Resume_Path = NULL WHERE UserID = '$user_id'";

    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo 'Resume delete successfully';
    } else {
        echo 'Resume delete failed';
    }
}
}
else if($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if(isset($_GET['career_id']))
    { 
    $career_id = mysqli_real_escape_string($connect, $_GET['career_id']);
    $query = "SELECT * FROM career WHERE CareerID='$career_id'";
    $query_run = mysqli_query($connect, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $career = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Career Fetch Successfully by id',
            'data' => $career
        ];
        echo json_encode($res);
        return;
    }
    else
    {   echo 'Career Id: ' . $career_id . ' Not Found';
        $res = [
            'status' => 404,
            'message' => 'Career Id Not Found'
        ];
        echo json_encode($res);
        exit;
    }
}
elseif(isset($_GET['education_id']))
    { 
        $education_id = mysqli_real_escape_string($connect, $_GET['education_id']);

        $query = "SELECT * FROM education WHERE EducationID='$education_id'";
        $query_run = mysqli_query($connect, $query);

        if(mysqli_num_rows($query_run) == 1)
        {
            $education = mysqli_fetch_array($query_run);

            $res = [
                'status' => 200,
                'message' => 'Education Fetch Successfully by id',
                'data' => $education
            ];
            echo json_encode($res);
            return;
        }
        else
        {   echo 'Education Id: ' . $education_id . ' Not Found';
            $res = [
                'status' => 404,
                'message' => 'Education Id Not Found'
            ];
            echo json_encode($res);
            exit;
        }
        }
}
?>