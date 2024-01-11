<!DOCTYPE html>

<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
?>

<?php
session_start(); // Start the session if you haven't already

if (isset($_SESSION['job_post_ID'])) {
    $job_post_ID = $_SESSION['job_post_ID'];
    $result = mysqli_query($connect, "SELECT * FROM job_post_questions WHERE JobID = '$job_post_ID' ");
    $selected_questions = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $selected_questions[] = $row['QuestionID'];
    }
}

$CompanyID = null;
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
}

if (isset($_POST['submitbtn'])) {
    if (isset($_GET['jobPostID'])) {
        // Update the existing job post
        $postid = $_GET["jobPostID"];
        if ($postid) {

            echo "<script type='text/javascript'>window.location.href = 'company_landing.php';</script>";
            exit;
        }
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="post-job.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
</head>

<body class="postjob_body">
    <header class="postjob_header">
        <div class="container">
            <div class="logo">
                <a href="company_landing.php" class="postjob_link"><img src="logo.png" alt="Logo"></a>
            </div>
            <div class="logo-nav">
                <nav style="display:flex">
                    <span class="header-link"><a href="company_landing.php">Home</a></span>
                    <span class="header-link"><a href="job-listing.php">Jobs</a></span>
                    <span class="header-link"><a href="#products">Products</a></span>
                </nav>
            </div>
            <div style="flex:1 1 auto;"></div>

            <div style="padding:0 20px">
                <div class="flex-container">
                    <div class="dropdown">
                        <div style="display: flex; align-items: center;">
                            <a href="#profile" onclick="toggleDropdown(event)" class="dropdown-title">
                                <?php echo isset($row['CompanyName']) ? $row['CompanyName'] : 'User Profile'; ?> <svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16"
                                    class="uatjxz0 bpnsn50 t0qjk721 chw1r94y ygcmz4c _140w0y32" aria-hidden="true"
                                    id="dropdown-icon"
                                    style="width:24px;height:24px;padding-left:10px;transform-origin:65% 50%;transition: transform .3s ease;">
                                    <path
                                        d="M20.7 7.3c-.4-.4-1-.4-1.4 0L12 14.6 4.7 7.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l8 8c.2.2.5.3.7.3s.5-.1.7-.3l8-8c.4-.4.4-1 0-1.4z">
                                    </path>
                                </svg>
                            </a>

                        </div>
                        <div class="dropdown-content" id="dropdownContent">
                            <span class="companyName">
                            <?php echo isset($row['CompanyName']) ? $row['CompanyName'] : 'User Profile'; ?>                            </span>
                            <div style="padding-top:10px;">
                                <span class="contactPerson">
                                <?php echo isset($row['ContactPerson']) ? $row['ContactPerson'] : 'Contact Person'; ?>
                                </span>
                            </div>
                            <div style="padding-top: 10px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="company_profile.php" class="dropdown-link">Accounts
                                    details</a></div>
                            <div style="padding-top: 12px;"><a href="#team" class="dropdown-link">Your team</a></div>
                            <div style="padding-top: 12px;"><a href="#invoicehistory" class="dropdown-link">Invoice
                                    history</a></div>
                            <div style="padding-top: 12px;"><a href="#logos" class="dropdown-link">Logos & Brands</a>
                            </div>
                            <div style="padding-top: 12px;"><a href="#adprice" class="dropdown-link">Ad price lookup</a>
                            </div>
                            <div style="padding-top: 20px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="#contact" class="dropdown-link">Contact us</a>
                            </div>
                            <div style="padding-top: 12px;"><a href="company_signout.php" class="dropdown-link">Sign
                                    out</a></div>
                        </div>
                    </div>
                    <div class="add_button">
                        <a href="post-job-classify.php" class="create_job_link">Create a job ad</a>
                    </div>
                </div>
            </div>

    </header>
    <div
        style="width:100%;height:155px;background:white;box-shadow:rgba(28, 35, 48, 0.1) 0px 2px 4px 0px, rgba(28, 35, 48, 0.1) 0px 2px 2px -2px, rgba(28, 35, 48, 0.2) 0px 4px 4px -4px;">
        <div class="container">
        </div>
    </div>
    <div class="form-container" style="padding-top:32px">

        <form method="POST">
            <div class="header-title">
                <span
                    style="color: rgb(46, 56, 73);font-size: 36px;font-style: normal;font-weight: 600;line-height: 36px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Manage
                    candidate applications <span
                        style="font-size:22px;color:rgb(90, 104, 129);font-weight:400;line-height:36px;">(optional)</span></span>
            </div>
            <div class="form-style" style="margin-top:22px;">
                <div>
                    <span
                        style="color: rgb(46, 56, 73);font-size: 28px;font-style: normal;font-weight: 600;line-height: 28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Questions
                        for candidates</span>
                </div>
                <div style="padding-top:20px;">
                    <span
                        style="font-size:18px;line-height:24px;font-weight: 400;color: rgb(46, 56, 73);font-family:Roboto, 'Helvetica Neue', HelveticaNeue, Helvetica, Arial, sans-serif;">Include
                        up to 8 easy-to-answer questions in your job ad.<br>When reviewing candidates, you will be able
                        to easily filter candidates who match your preferred answers.</span>
                </div>
                <div style="padding-top:20px">
                    <span style="font-size:18px;line-height:24px;font-weight: 400;color: rgb(46, 56, 73);font-family:Roboto,
                'Helvetica Neue', HelveticaNeue, Helvetica, Arial, sans-serif;">0
                        questions selected</span>
                </div>

                <div class="form-group" style="display:none;">
                    <input id="jobQuestion" name="jobQuestion" class="form-dropdown"
                        style="height: 24px;width:578.672px;margin-bottom: 10px;" placeholder="Find a question">
                </div>
                <!-- Searched Question -->
                <!-- New question groups will be appended to this div -->
                <div class="question-groups-container"></div>


                <div style="padding-top:20px;padding-bottom:5px;">
                    <span style="color: rgb(46, 56, 73);font-size: 24px;font-style: normal;font-weight: 600;line-height:
                28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Selected
                        questions</span>

                </div>


                <?php
                //Recommended questions
                // Execute a SELECT query to get all questions where Recommended_Question is 1
                $result = mysqli_query($connect, "SELECT Job_Question_Name, Job_Question_ID, Job_Question_Type FROM job_question WHERE Recommended_Question = 1");
                $selected_questions = isset($selected_questions) ? $selected_questions : array();

                // Check if the query returned any results
                if (mysqli_num_rows($result) > 0) {
                    // Use a while loop to fetch each row of results
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Check if the current question was selected by the user
                        $checked = in_array($row['Job_Question_ID'], $selected_questions) ? 'checked' : '';

                        // Only echo the question if it is selected
                        if ($checked == 'checked') {
                            // Display each question as a checkbox
                            echo '<div class="question-group" style="">';
                            echo '<input disabled class="question_checkbox" data-question-id="' . $row['Job_Question_ID'] . '" data-question-type="' . $row['Job_Question_Type'] . '" type="checkbox" id="' . $row['Job_Question_Name'] . '" name="questions[]" value="' . $row['Job_Question_ID'] . '" ' . $checked . '>';
                            echo '<label class="job_question" for="' . $row['Job_Question_Name'] . '" style="padding-left: 30px;user-select: none;cursor:default;">' . $row['Job_Question_Name'] . '</label>';
                            echo '<div class="limit-message" style="display: none;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="20" height="20"  aria-hidden="true" style="position:relative;top:4px;"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><circle cx="12" cy="17" r="1"></circle><path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z"></path></svg></span> You\'ve added 8 out of 8 questions. Please remove a question to add one.</div>'; // New div for the limit message
                            echo '</div>';
                        }
                    }
                }
                ?>

                <?php
                // User-selected non-recommended questions
                // First, get all the questions that are not recommended
                $result = mysqli_query($connect, "SELECT Job_Question_Name, Job_Question_ID, Job_Question_Type FROM job_question WHERE Recommended_Question = 0");

                // Check if the query returned any results
                if (mysqli_num_rows($result) > 0) {
                    // Use a while loop to fetch each row of results
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Check if the current question was selected by the user
                        if (in_array($row['Job_Question_ID'], $selected_questions)) {
                            // Display each question as a checkbox
                            echo '<div class="question-group" style="">';
                            echo '<input disabled class="question_checkbox" data-question-id="' . $row['Job_Question_ID'] . '" data-question-type="' . $row['Job_Question_Type'] . '" type="checkbox" id="' . $row['Job_Question_Name'] . '" name="questions[]" value="' . $row['Job_Question_ID'] . '" checked>';
                            echo '<label class="job_question" for="' . $row['Job_Question_Name'] . '" style="padding-left: 30px;user-select: none;cursor:default;">' . $row['Job_Question_Name'] . '</label>';
                            echo '<div class="limit-message" style="display: none;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="20" height="20"  aria-hidden="true" style="position:relative;top:4px;"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><circle cx="12" cy="17" r="1"></circle><path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z"></path></svg></span> You\'ve added 8 out of 8 questions. Please remove a question to add one.</div>'; // New div for the limit message
                            echo '</div>';
                        }
                    }
                }
                ?>

            </div>

            <div class="form-group" style="display: block;">
                <input type="submit" value="Home" class="cont-button" name="submitbtn">
                <input type="submit" value="Save draft" class="save-button" style="margin-left:4px">
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="post-job.js"></script>

    <script type="text/javascript">
        var selected_questions = <?php echo json_encode($selected_questions); ?>;
    </script>

    <script>
        $(document).ready(function () {
            // Attach a 'change' event listener to the checkboxes using event delegation
            $(document).on('change', '.question_checkbox', function () {
                updateCheckboxes();
                var questionGroup = $(this).closest('.question-group');
                var label = questionGroup.find('.job_question'); // Get the label
            });

            $(document).ready(function () {
                // Prevent the checkbox from being checked
                $('.question_checkbox').on('click', function (e) {
                    e.preventDefault();
                });
            });

            $("#jobQuestion").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: 'fetch.php?fetch=job_questions',
                        dataType: 'json',
                        success: function (data) {
                            // Filter out the questions that have already been selected
                            var filteredData = data.filter(function (question) {
                                return !selected_questions.includes(question.value);
                            });

                            var results = $.ui.autocomplete.filter(filteredData, request.term);

                            results.sort(function (a, b) {
                                var aIndex = a.label.toLowerCase().indexOf(request.term.toLowerCase()) === 0 ? -1 : a.label.toLowerCase().indexOf(request.term.toLowerCase());
                                var bIndex = b.label.toLowerCase().indexOf(request.term.toLowerCase()) === 0 ? -1 : b.label.toLowerCase().indexOf(request.term.toLowerCase());
                                return aIndex - bIndex;
                            });

                            response(results);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                },
                select: function (event, ui) {
                    event.preventDefault();
                    $(this).val(ui.item.label);

                    var questionId = ui.item.value;
                    var questionName = ui.item.label;
                    var questionType = ui.item.type;

                    // Check if the total number of checked checkboxes is already 8
                    var totalChecked = $('.question_checkbox:checked').length;
                    var isChecked = totalChecked < 8 ? 'checked' : '';
                    var isDisabled = totalChecked >= 8 ? 'disabled' : '';

                    var questionGroup = '<div class="question-group" style="">' +
                        '<input class="question_checkbox" data-question-id="' + questionId + '" data-question-type="' + questionType + '" type="checkbox" id="' + questionName + '" name="questions[]" value="' + questionId + '" ' + isChecked + ' ' + isDisabled + '>' +
                        '<label class="job_question" for="' + questionName + '" style="padding-left: 30px;user-select: none;">' + questionName + '</label>' +
                        '<div class="limit-message" style="display: none;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="20" height="20"  aria-hidden="true" style="position:relative;top:4px;"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><circle cx="12" cy="17" r="1"></circle><path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z"></path></svg></span> You\'ve added 8 out of 8 questions. Please remove a question to add one.</div>' +
                        '</div>';

                    var existingQuestionGroup = $(".question-groups-container .question_checkbox[data-question-id='" + questionId + "']").closest('.question-group');
                    if (existingQuestionGroup.length > 0) {
                        existingQuestionGroup.remove();
                    }

                    $(".question-groups-container").append(questionGroup);

                    if (totalChecked < 8) {
                        $('.question_checkbox[data-question-id="' + questionId + '"]').trigger('change');
                    }
                },
                minLength: 0
            }).focus(function () {
                $(this).autocomplete("search");
            });

            $("#jobQuestion").autocomplete("instance")._renderItem = function (ul, item) {
                var newText = item.label;
                return $("<li></li>")
                    .data("item.autocomplete", item)
                    .append($("<div></div>").text(newText))
                    .appendTo(ul);
            };

            $(document).on('change', '.question_checkbox', function () {

                var questionGroup = $(this).closest('.question-group');
                var label = questionGroup.find('.job_question'); // Get the label

                if ($(this).is(":checked")) {
                    questionGroup.addClass('question-bg');
                    label.addClass('bold'); // Add the .bold class to the label
                } else {
                    questionGroup.removeClass('question-bg');
                    label.removeClass('bold'); // Remove the .bold class from the label
                }

                if ($(this).is(":checked")) {
                    questionGroup.addClass('question-bg');
                } else {
                    questionGroup.removeClass('question-bg');
                }

                var questionId = $(this).data("question-id");
                var isChecked = $(this).is(":checked");
                var questionGroup = $(this).parent();
                var questionType = $(this).data("question-type");

                if (isChecked) {

                    $.get("fetch.php", { fetch: "job_question_options", questionId: questionId }, function (data) {
                        var options = JSON.parse(data);
                        var optionsDiv = $('<div class="question_options"></div>');

                        var instructionDiv = $('<div class="question_instruction"></div>'); // New div for instruction
                        if (questionType == 1) {
                            instructionDiv.text("This question allows applicants to choose multiple options");
                        } else {
                            instructionDiv.text("This question allows applicants to choose only one option");
                        }
                        questionGroup.append(instructionDiv); // Append instruction div to question group

                        options.forEach(function (option, index) {
                            var optionDiv = $('<div class="option"></div>'); // New div for each option
                            var inputWrapper = $('<div class="option_wrapper"></div>'); // New div for input wrapper
                            var input = $('<input>');
                            var label = $('<label>').text(option.name).addClass("job_question"); // Add class to label

                            if (option.type == 1) {
                                input.attr("type", "checkbox");
                                input.addClass("option_checkbox"); // Add class to checkbox
                            } else {
                                input.attr("type", "radio");
                                input.attr("name", "optionGroup" + questionId); // Group the radio buttons
                                input.addClass("option_radio"); // Add class to radio button
                            }

                            inputWrapper.append(input); // Append input to input wrapper
                            inputWrapper.append(label); // Append label to input wrapper
                            optionDiv.append(inputWrapper);
                            optionsDiv.append(optionDiv);
                        });

                        questionGroup.append(optionsDiv);
                    });
                } else {
                    questionGroup.find(".question_options").remove();
                    questionGroup.find(".question_instruction").remove(); // Remove instruction div
                }


            });

            // Initialize a MutationObserver
            var observer = new MutationObserver(updateCheckboxes);

            // Start observing the '.question-groups-container' for child list changes
            observer.observe($('.question-groups-container')[0], { childList: true });
            $('.question_checkbox:checked').trigger('change');

        });


        function updateCheckboxes() {
            // Count the total number of checked checkboxes
            var totalChecked = $('.question_checkbox:checked').length;

            // Update the text to show the number of selected questions out of 8
            $('div[style="padding-top:20px"] span').text(totalChecked + ' questions selected');

            // If the total number of checked checkboxes is 8, disable all unchecked checkboxes
            if (totalChecked >= 8) {
                var uncheckedCheckboxes = $('.question_checkbox:not(:checked)');
                uncheckedCheckboxes.prop('disabled', true);
                uncheckedCheckboxes.next('label').addClass('disabled');
            } else {
                // If the total number of checked checkboxes is less than 8, enable all checkboxes
                $('.question_checkbox').prop('disabled', false);
                $('label').removeClass('disabled');
            }
        }

    </script>

    <script>

        $(document).ready(function () {
            // Attach a 'change' event listener to the checkboxes using event delegation
            $(document).on('change', '.question_checkbox', function () {
                // Count the total number of checked checkboxes
                var totalChecked = $('.question_checkbox:checked').length;

                // Update the text to show the number of selected questions out of 8
                $('div[style="padding-top:20px"] span').text(totalChecked + ' questions selected');

                if (totalChecked >= 8) {
                    var uncheckedCheckboxes = $('.question_checkbox:not(:checked)');
                    uncheckedCheckboxes.prop('disabled', true);
                    uncheckedCheckboxes.next('label').addClass('disabled');
                } else {
                    $('.question_checkbox').prop('disabled', false);
                    $('label').removeClass('disabled');
                }
            });


            // Attach a 'click' event listener to the checkboxes and labels using event delegation
            $(document).on('click', '.question_checkbox, .job_question', function (event) {
                // If the clicked element is a disabled checkbox or the label of a disabled checkbox, show the limit message
                if ($(this).is(':disabled') || $(this).prev().is(':disabled')) {
                    // Hide all limit messages
                    $('.limit-message').hide();

                    // Show only the limit message for the clicked question
                    var limitMessage = $(this).parent().find('.limit-message');
                    limitMessage.show();
                }
            });
        });

    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
<?php
if (!isset($_SESSION['companyID'])) {
    ?>
    <script>
        Swal.fire({
            title: "Error",
            text: "You haven\'t logged in",
            icon: "error",
            backdrop: `lightgrey`,
        }).then(function () {
            window.location.href = "company_login.php";
        });
    </script>
    <?php
    exit;
} else if ($row['CompanyStatus'] == 'Verify') {
    ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "Please verify your email first.",
                icon: "error",
                backdrop: `lightgrey`,
            }).then(function () {
                window.location.href = "company_login.php";
            });
        </script>
    <?php
    // Exit or perform some other action...
} else if ($row['CompanyStatus'] == 'Blocked') {
    ?>
            <script>
                Swal.fire({
                    title: "Error",
                    text: "Your company account is blocked.",
                    icon: "error",
                    backdrop: `lightgrey`,
                }).then(function () {
                    window.location.href = "company_login.php";
                });
            </script>
    <?php
}
?>