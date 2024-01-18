<!DOCTYPE html>

<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning
?>

<?php
$CompanyID = null;
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
}

$applicantId = null;
if (isset($_GET['applicantId'])) {
    $applicantId = mysqli_real_escape_string($connect, $_GET['applicantId']);
}


$sql = "SELECT * FROM applications WHERE ApplicationID = $applicantId ";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

// Query for careers
$sql_careers = "SELECT * FROM applicant_career WHERE ApplicationID = $applicantId";
$result_careers = mysqli_query($connect, $sql_careers);

// Query for educations
$sql_educations = "SELECT * FROM applicant_education WHERE ApplicationID = $applicantId";
$result_educations = mysqli_query($connect, $sql_educations);

// Query for responses
$sql_responses = "SELECT ar.ApplicationID, jq.Job_Question_Name, jqp.Job_Question_Option_Name, ar.AnswerID, ar.QuestionID
FROM applicant_responses ar
JOIN job_question jq ON ar.QuestionID = jq.Job_Question_ID
JOIN job_question_option jqp ON ar.AnswerID = jqp.Job_Question_Option_ID
WHERE ar.ApplicationID = $applicantId
";
$result_responses = mysqli_query($connect, $sql_responses);






?>

<div style="background:white;width:100%">
    <div style="padding:32px 24px;margin:0;">
        <div style="background:white;width:100%">
            <div style="display:flex;flex-direction:row;justify-content:space-between">
                <div style="display:flex;flex-direction:column;">
                    <h2 class="landing_sentence3" style="width:800px">
                        <?php echo htmlspecialchars($row['FirstName']); ?>
                        <?php echo htmlspecialchars($row['LastName']); ?>
                    </h2>
                    <div style="font-size:16px;line-height:24px;" class="landing_sentence2">
                        Apply at
                        <?php echo date('j F Y', strtotime($row['ApplyDate'])); ?>.
                    </div>
                </div>
                <?php if ($row['Status'] == 'Accepted' || $row['Status'] == 'Rejected'): ?>
                    <span class="landing_sentence1" style="font-size:18px;">You have already
                        <?php echo strtolower($row['Status']); ?> this application.
                    </span>
                <?php else: ?>
                    <button class="cont-button" onclick="changeAcceptstatus(<?php echo $applicantId; ?>)">Accept</button>
                    <button class="save-button" style="margin-left:5px;border:1px solid rgb(73, 100, 233)"
                        onclick="changeRejectstatus(<?php echo $applicantId; ?>)">Reject</button>
                <?php endif; ?>

            </div>

            <div>
                <div style="display:flex;flex-direction:column;padding-top:10px;">
                    <span class="landing_sentence1" style="font-size:18px;">Email</span>
                    <span class="landing_sentence2">
                        <a class="landing_sentence2 a-link"
                            href="mailto:<?php echo htmlspecialchars($row['Email']); ?>">
                            <?php echo htmlspecialchars($row['Email']); ?>
                        </a>
                    </span>
                </div>

                <div style="display:flex;flex-direction:column;padding-top:10px;">
                    <span class="landing_sentence1" style="font-size:18px;">Phone number</span>
                    <span>
                        <a class="landing_sentence2 a-link"
                            href="https://api.whatsapp.com/send?phone=60<?php echo htmlspecialchars($row['Phone']); ?>">+60
                            <?php echo htmlspecialchars($row['Phone']); ?>
                        </a>
                    </span>
                </div>

                <div style="display:flex;flex-direction:column;padding-top:10px;">
                    <span class="landing_sentence1" style="font-size:18px;">Location</span>
                    <span class="landing_sentence2">
                        <?php echo htmlspecialchars($row['Location']); ?>
                    </span>
                </div>

                <div style="display:flex;flex-direction:column;padding-top:10px;">
                    <span class="landing_sentence1" style="font-size:18px;">Descirption</span>
                    <span class="landing_sentence2">
                        <?php echo htmlspecialchars($row['Profile_Description']); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="padding:32px 24px;margin:0;">
    <div style="background:white;padding:24px;">
        <div>
            <div>
                <h2 class="landing_sentence3" style="width:800px;font-weight:400;font-size:24px">
                    Career
                </h2>
            </div>
            <div>
                <?php
                if (mysqli_num_rows($result_careers) > 0) {
                    while ($row = mysqli_fetch_assoc($result_careers)) {
                        // Create DateTime objects from StartDate and EndDate
                        $startDate = new DateTime($row['StartDate']);
                        $endDate = new DateTime($row['EndDate']);

                        // Calculate the difference in months
                        $interval = $startDate->diff($endDate);
                        $months = $interval->y * 12 + $interval->m;

                        $monthString = $months == 1 ? '(1 month)' : '(' . $months . ' months)';

                        echo '
            <div style="padding-top:15px;">
                <div style="display:flex;flex-direction:column;">
                    <span>
                        <span class="landing_sentence2" style="font-size:16px;font-weight:600">
                            ' . htmlspecialchars($row['JobTitle']) . '
                        </span>
                        <span class="landing_sentence2">at
                            ' . htmlspecialchars($row['CompanyName']) . '
                        </span>
                    </span>
                    <span class="landing_sentence2">
                    ' . date('F Y', strtotime($row['StartDate'])) . ' to ' . ($row['StillInRole'] == 1 ? 'Current' : date('F Y', strtotime($row['EndDate']))) . ' ' . $monthString . '
                    </span>
                </div>
                <div style="display:flex;flex-direction:column;padding-top:10px;">
                    <span class="landing_sentence2">
                    ' . (!empty($row['Description']) ? htmlspecialchars($row['Description']) : 'No career description') . '
                    </span>
                </div>
            </div>
        ';
                    }
                } else {
                    echo '<div style="padding-top:15px;">
                    <div style="display:flex;flex-direction:column;">
                            <span class="landing_sentence2" style="font-size:16px;font-weight:600">-
                            </span>
                        
                    </div>
                    
                </div>';
                }
                ?>
            </div>
        </div>
        <div style="border-bottom: 1px solid lightgrey;width:100%;padding:15px 0"></div>
        <div style="padding-top:25px">
            <div>
                <h2 class="landing_sentence3" style="width:800px;font-weight:400;font-size:24px">
                    Education
                </h2>
            </div>
            <div>
                <?php
                if (mysqli_num_rows($result_educations) > 0) {
                    while ($row = mysqli_fetch_assoc($result_educations)) {
                        echo '
            <div style="padding-top:15px;">
                <div style="display:flex;flex-direction:column;">
                    <span>
                        <span class="landing_sentence2" style="font-size:16px;font-weight:600">
                            ' . htmlspecialchars($row['Institution']) . '
                        </span>
                    </span>
                    <span class="landing_sentence2">
                    ' . htmlspecialchars($row['Course_or_Qualification']) . ' ' . ($row['Qualification_complete'] == 1 ? '(Graduated)' : '(On-going)') . '
                    </span>
                </div>
                <div style="display:flex;flex-direction:column;padding-top:10px;">
                    <span class="landing_sentence2">
                    ' . (!empty($row['Course_Highlight']) ? htmlspecialchars($row['Course_Highlight']) : 'No education highlight') . '
                    </span>
                </div>
            </div>
        ';
                    }
                } else {
                    echo '<div style="padding-top:15px;">
                    <div style="display:flex;flex-direction:column;">
                            <span class="landing_sentence2" style="font-size:16px;font-weight:600">-
                            </span>
                        
                    </div>
                    
                </div>';
                }
                ?>
            </div>
        </div>
        <div style="border-bottom: 1px solid lightgrey;width:100%;padding:15px 0"></div>
        <div style="padding-top:25px">
            <div>
                <h2 class="landing_sentence3" style="width:800px;font-weight:400;font-size:24px">
                    Responses
                </h2>
            </div>

            <?php
            $questionsFetched = mysqli_num_rows($result_responses);

            if ($questionsFetched > 0) {
                while ($row = mysqli_fetch_assoc($result_responses)) {
                    echo '<div class="question_options"><label class="landing_sentence2" for="' . $row['Job_Question_Name'] . '" style="font-size:16px;font-weight:600">' . $row['Job_Question_Name'] . '</label>
        <div class="option">';

                    // Fetch options for the current question
                    $questionId = $row['QuestionID']; // This should be the same as Job_Question_ID in the job_question table
                    $sql_options = "SELECT Job_Question_Option_Name, Job_Question_Option_ID FROM job_question_option WHERE Job_Question_ID = $questionId";
                    $result_options = mysqli_query($connect, $sql_options);

                    while ($option = mysqli_fetch_assoc($result_options)) {
                        $isChecked = $row['AnswerID'] == $option['Job_Question_Option_ID'] ? 'checked' : '';

                        echo '<div style="display: flex;align-items: baseline;height: auto;padding-bottom: 10px;">
            <input type="radio" name="question_option_' . $questionId . '" value="' . $option['Job_Question_Option_Name'] . '" ' . $isChecked . ' disabled>';
                        echo '<label class="job_question" for="question_option_' . $questionId . '">' . $option['Job_Question_Option_Name'] . '</label><br></div>';
                    }

                    echo '</div></div>';
                }
            } else {
                echo '<span class="landing_sentence2" style="padding-top:15px">No applicant response</span>';
            }
            ?>

        </div>

        <div style="border-bottom: 1px solid lightgrey;width:100%;padding:15px 0"></div>
        <div style="padding-top:25px">
            <div>
                <h2 class="landing_sentence3" style="width:800px;font-weight:400;font-size:24px">
                    Resume/CoverLetter
                </h2>
            </div>
            <?php
            // Execute a SQL query to get the PDF paths
            $result = mysqli_query($connect, "SELECT ResumePath, CoverLetterPath FROM applications WHERE ApplicationID = $applicantId");

            if (mysqli_num_rows($result) > 0) {
                // Fetch the row from the result set
                $row = mysqli_fetch_assoc($result);

                // Get the PDF paths from the row
                $resumePath = $row['ResumePath'];
                $coverletterPath = $row['CoverLetterPath'];

                echo '
                <div style="padding-top:15px;">

                    <div style="display:flex;flex-direction:row;">';

                // Check if the resume path is not empty or null
                if (!empty($resumePath)) {
                    echo '
                    <div>
                        <a  href="' . $resumePath . '" target="_blank" style="text-decoration:none;"><button class="cont-button" style="width:150px;">View Resume</button></a>
                    </div>';
                }

                // Check if the cover letter path is not empty or null
                if (!empty($coverletterPath)) {
                    echo '
                    <div>
                        <a  href="' . $coverletterPath . '" target="_blank" style="text-decoration:none;"><button class="save-button" style="width:150px;margin-left:5px;border:1px solid rgb(73, 100, 233)">View Cover Letter</button></a>
                    </div>';
                }

                // If both paths are empty or null, print a message
                if (empty($resumePath) && empty($coverletterPath)) {
                    echo '<span class="landing_sentence2" style="">No resume or cover letter</span>';
                }

                echo '</div></div>';
            } else {
                echo 'No PDF found';
            }
            ?>
        </div>
    </div>
</div>

<?php
// Free the result set and close the connection
mysqli_free_result($result);
mysqli_close($connect);
?>