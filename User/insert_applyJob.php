<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    $resumetargetPath = "";
    $covertargetPath = "";
    $user_id = $_SESSION['User_ID'];
    $job_id = $_SESSION['jobID'];
    $resumeOption = isset($_POST['resumeOption']) ? $_POST['resumeOption'] : '';
    $coverOption = isset($_POST['coverOption']) ? $_POST['coverOption'] : '';
    $questionAnswersJSON = $_POST['questionAnswers'];
    $questionAnswers = json_decode($questionAnswersJSON, true);

    // $job_query = "SELECT job_post.*, companies.CompanyEmail FROM job_post
    //         INNER JOIN companies ON job_post.CompanyID = companies.CompanyID WHERE Job_Post_ID = $job_post_id";
    // $job_result = mysqli_query($connect,$job_query);
    // $job_row = mysqli_fetch_assoc($job_result);
    $user_query = "SELECT * FROM users WHERE UserID =$user_id";
    $user_result = mysqli_query($connect,$user_query);
    $user_row = mysqli_fetch_assoc($user_result);
    $exit_query = "SELECT * FROM applications WHERE UserID = $user_id AND JobID = $job_id";
    $exit_result = mysqli_query($connect, $exit_query);
    if(mysqli_num_rows($exit_result) > 0)
    {
        echo("failed");
        exit();
    }
    //resume
    if ($resumeOption === 'defaultResume') {
        $query = "SELECT Resume_Path FROM users WHERE UserID = $user_id";
        $result = mysqli_query($connect, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $resumePath = $row['Resume_Path'];
    
            // 构建目标文件夹和目标路径
            $resumetargetFolder = 'applicant_resume/';
            $resumetargetPath = $resumetargetFolder . basename($resumePath);
    
            // 使用 copy 函数将默认简历文件从原始路径复制到目标路径
            if (copy($resumePath, $resumetargetPath)) {
            } else {
            }
        }
    }
    else if($resumeOption === 'selectResume'){
        $resume = $_FILES['resume'];
        $resume_dir = 'applicant_resume/';
        $resume_name = $resume['name'];
        $file_extension = pathinfo($resume_name, PATHINFO_EXTENSION);
        $new_resume_name = pathinfo($resume_name, PATHINFO_FILENAME) . '_' . $user_id . '.' . $file_extension;
        $resume_tmp = $resume['tmp_name'];

        $resumetargetPath = $resume_dir . $new_resume_name;
        move_uploaded_file($resume_tmp, $resume_dir . basename($new_resume_name));
    }
    //cover
    if($coverOption === 'selectCover'){
        $cover = $_FILES['cover'];
        $cover_dir = 'applicant_cover_letter/';
        $cover_name = $cover['name'];
        $file_extension = pathinfo($cover_name, PATHINFO_EXTENSION);
        $new_cover_name = pathinfo($cover_name, PATHINFO_FILENAME) . '_' . $user_id . '.' . $file_extension;
        $cover_tmp = $cover['tmp_name'];

        $covertargetPath = $cover_dir . $new_cover_name;
        move_uploaded_file($cover_tmp, $cover_dir . basename($new_cover_name));
    }
    //insert cover and resume in sql
    $sql = "INSERT INTO applications (UserID, JobID, FirstName,LastName,Phone,Email,Location,Profile_Description,ResumePath, CoverLetterPath)
            VALUES ('$user_id', '$job_id','{$user_row['FirstName']}','{$user_row['LastName']}','{$user_row['Phone']}','{$user_row['Email']}','{$user_row['Location']}','{$user_row['Profile_Description']}', '$resumetargetPath', '$covertargetPath')";
    $result = mysqli_query($connect, $sql);
    if($result)
    {    echo "result is complete";
        $applicationID = mysqli_insert_id($connect);//get the applicantID insert

        foreach($questionAnswers["Question_answer"] as $answer)
        {   
            echo "question in progress";
            $questionID = $answer["questionID"];
            $option = $answer["option"];
            $q_sql = "INSERT INTO applicant_responses (ApplicationID, QuestionID, AnswerID)
            VALUES ('$applicationID', '$questionID', '$option')";
            $q_result = mysqli_query($connect, $q_sql);
        }
        $c_query = "SELECT * FROM career WHERE UserID = $user_id";
        $c_result = mysqli_query($connect, $c_query);
        if ($c_result) {
            $careerData = mysqli_fetch_all($c_result, MYSQLI_ASSOC);
            foreach($careerData as $careerRow)
            {
                $jobTitle = $careerRow['JobTitle'];
                $companyName = $careerRow['CompanyName'];
                $startDate = $careerRow['StartDate'];
                $endDate = $careerRow['EndDate'];
                $stillInRole = $careerRow['StillInRole'];
                $description = $careerRow['Description'];
                $insertQuery = "INSERT INTO applicant_career (ApplicationID, JobTitle, CompanyName, StartDate, EndDate, StillInRole, Description)
                    VALUES ('$applicationID', '$jobTitle', '$companyName', '$startDate', '$endDate', '$stillInRole', '$description')";
                $insertResult = mysqli_query($connect, $insertQuery);
            }
        }
        $e_query = "SELECT * FROM education WHERE UserID = $user_id";
        $e_result = mysqli_query($connect, $e_query);
        if(mysqli_num_rows($e_result) > 0)
        {
            $row = mysqli_fetch_assoc($e_result);
            $insert_query = "INSERT INTO applicant_education (ApplicationID, Institution, Course_or_Qualification, Course_Highlight, Qualification_complete)
                    VALUES ('$applicationID', '{$row['Institution']}', '{$row['Course_or_Qualification']}', '{$row['Course_Highlight']}', '{$row['Qualification_complete']}')";
            $insertEducationResult = mysqli_query($connect, $insert_query);
        }
        $job_query = "SELECT job_post.*, companies.CompanyEmail FROM job_post
                INNER JOIN companies ON job_post.CompanyID = companies.CompanyID WHERE Job_Post_ID = $job_id";
        $job_result = mysqli_query($connect, $job_query);
        $job_row = mysqli_fetch_assoc($job_result);
        $companyEmail = $job_row['CompanyEmail'];
        $job_post_title = $job_row['Job_Post_Title'];
        // echo $companyEmail;
        require "phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username='gecjobfacts888@gmail.com';
        $mail->Password='atteeyliyxloitmo';

        $mail->setFrom('gecjobfacts888@gmail.com', 'New Job Application');
        $mail->addAddress($companyEmail);
        $mail->addReplyTo('gecjobfacts888@gmail.com');

        $mail->isHTML(true);
        $mail->Subject="New Job Application";
        $mail->Body="<p>Dear company, </p><br><h3>Someone has applied for the job posted on GEC JobFact : $job_post_title.</h3>
        <br><br>
        <p>With regrads,</p>
        <b>GEC JobFacts</b>";
        if(!$mail->send()){
			?>
				<script>
					alert("<?php echo " Invalid Email "?>");
				</script>
			<?php
		}else{
			?>
				<script>
					window.location.replace("login.php");
				</script>
			<?php
		}
    }

    // echo '<pre>';
    // var_dump($questionAnswers);
    // echo '</pre>';
   
}
?>