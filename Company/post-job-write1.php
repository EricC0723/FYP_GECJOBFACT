<!DOCTYPE html>

<?php
include("dataconnection.php");
?>

<?php
session_start(); // Start the session if you haven't already

if (isset($_SESSION['job_post_ID'])) {
    $job_post_ID = $_SESSION['job_post_ID'];
}

$CompanyID = null;
if (isset($_SESSION['companyData']['CompanyID'])) {
    $CompanyID = $_SESSION['companyData']['CompanyID'];
}



if (isset($_POST['submitbtn'])) {
    $jobDescription = $_POST['jobDescription'];
    $jobResponsibilities = $_POST['jobResponsibilities'];
    $jobBenefits = $_POST['jobBenefits'];
    $sql = "UPDATE job_post SET Job_Post_Description = '$jobDescription', Job_Post_Responsibilities = '$jobResponsibilities', Job_Post_Benefits = '$jobBenefits' WHERE Job_Post_ID = $job_post_ID";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        if (isset($_FILES['fileInput'])) {
            $errors = array();
            $file_name = $_FILES['fileInput']['name'];
            $file_size = $_FILES['fileInput']['size'];
            $file_tmp = $_FILES['fileInput']['tmp_name'];
            $file_type = $_FILES['fileInput']['type'];
            $file_parts = explode('.', $_FILES['fileInput']['name']);
            $file_ext = strtolower(end($file_parts));

            $extensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if (move_uploaded_file($file_tmp, "logo/" . $file_name)) {
                // Update the image_url in the job_post table
                $sql = "UPDATE job_post SET Job_Logo_Url='logo/" . $file_name . "' WHERE Job_Post_ID=" . $job_post_ID;
                mysqli_query($connect, $sql);
            }
        }

        // Redirect to post-job-question.php if the update was successful
        echo "<script type='text/javascript'>window.location.href = 'post-job-question.php';</script>";
        exit;
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
                <a href="post-job.php" class="postjob_link"><img src="logo.png" alt="Logo"></a>
            </div>
            <div class="logo-nav">
                <nav style="display:flex">
                    <span class="header-link"><a href="#home">Home</a></span>
                    <span class="header-link"><a href="#jobs">Jobs</a></span>
                    <span class="header-link"><a href="#products">Products</a></span>
                </nav>
            </div>
            <div style="flex:1 1 auto;"></div>

            <div style="padding:0 20px">
                <div class="flex-container">
                    <div class="dropdown">
                        <div style="display: flex; align-items: center;">
                            <a href="#profile" onclick="toggleDropdown(event)" class="dropdown-title">
                                <?php echo isset($_SESSION['companyData']['CompanyName']) ? $_SESSION['companyData']['CompanyName'] : 'User Profile'; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
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
                                <?php echo isset($_SESSION['companyData']['CompanyName']) ? $_SESSION['companyData']['CompanyName'] : 'User Profile'; ?>
                            </span>
                            <div style="padding-top:10px;">
                                <span class="contactPerson">
                                    <?php echo isset($_SESSION['companyData']['ContactPerson']) ? $_SESSION['companyData']['ContactPerson'] : ''; ?>
                                </span>
                            </div>
                            <div style="padding-top: 10px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="#accounts" class="dropdown-link">Accounts
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

        <form method="POST" enctype="multipart/form-data">
            <div class="header-title">
                <span
                    style="color: rgb(46, 56, 73);font-size: 36px;font-style: normal;font-weight: 600;line-height: 36px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Write
                    about your job</span>
            </div>
            <div class="form-style" style="margin-top:22px;">
                <div>
                    <span
                        style="color: rgb(46, 56, 73);font-size: 28px;font-style: normal;font-weight: 600;line-height: 28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Showcase
                        your brand
                    </span>
                </div>
                <div style="padding-top:20px;">
                    <span
                        style="font-size:16px;line-height:24px;font-weight: 400;color:#5a6881;font-family:Roboto, 'Helvetica Neue', HelveticaNeue, Helvetica, Arial, sans-serif;">Create
                        your first brand by uploading your company logo. Cover images can be added from the success
                        page, after payment.
                    </span>
                </div>
                <div style="padding-top:32px;">
                    <div class="add_logo_box">
                        <div class="add_cover_img_box"></div>
                        <div style="padding:20px 24px;">
                            <div style="display: flex; align-items: center;">
                                <div>
                                    <button type="button" id="uploadButton" data-testid="bx-add-asset"
                                        style="display: flex; align-items: center;margin-left:10px;"
                                        class="add_logo_btn">
                                        <div style="padding:14px 20px;display:flex;align-items:center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                xml:space="preserve" focusable="false" fill="currentColor" width="16"
                                                height="16" aria-hidden="true"
                                                style="color:white;width:19px;height:19px">
                                                <path
                                                    d="M19 2H5C3.3 2 2 3.3 2 5v14c0 1.7 1.3 3 3 3h14c1.7 0 3-1.3 3-3V5c0-1.7-1.3-3-3-3zM4 5c0-.6.4-1 1-1h14c.6 0 1 .4 1 1v7.6L17.4 10c-.8-.8-2.1-.8-2.8 0l-9.9 9.9c-.4-.1-.7-.5-.7-.9V5zm15 15H7.4l8.6-8.6 4 4V19c0 .6-.4 1-1 1z">
                                                </path>
                                                <circle cx="8" cy="8" r="2"></circle>
                                            </svg>
                                            <span style="margin-left: 10px;" class="add_logo_title">Add logo</span>
                                        </div>
                                    </button>
                                </div>
                                <div style="display: none; flex-direction: column;" id="replace_logo">
                                    <div
                                        style="width: 180px; height: 80px; overflow: hidden; margin-left: 10px;align-items: center;display: flex;">
                                        <img id="preview" src="" alt="Image preview"
                                            style="display: none; max-width: 100%; height: auto;" />
                                    </div>
                                    <div>
                                        <button type="button" id="replaceButton" data-testid="bx-add-asset"
                                            style="display: flex; align-items: center;margin-left:10px;"
                                            class="replace_logo_btn">
                                            <div style="padding:14px 0px;display:flex;align-items:flex-start;">

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true"
                                                    style="color:#4964e9;width:19px;height:19px">
                                                    <path
                                                        d="M20.7 4.1c-1.4-1.4-4-1.4-5.4 0l-11 11c-.1.1-.2.3-.3.5l-1 5c-.1.3 0 .7.3.9.2.2.4.3.7.3h.2l5-1c.2 0 .4-.1.5-.3l11-11c1.5-1.5 1.5-3.9 0-5.4zM8.5 18.9l-3.2.6.6-3.2 8.6-8.6 2.6 2.6-8.6 8.6zM19.3 8.1l-.8.8-2.6-2.6.8-.8c.7-.7 1.9-.7 2.6 0 .7.7.7 1.9 0 2.6z">
                                                    </path>
                                                </svg>
                                                <span style="margin-left: 5px;"
                                                    class="replace_logo_title">Replace</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <input type="file" id="fileInput" name="fileInput"
                                accept=".gif,.jpeg,.jpg,.png,.svg,.tiff,.webp" style="display: none;">
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-style" style="margin-top:22px;">
                <div>
                    <span
                        style="color: rgb(46, 56, 73);font-size: 28px;font-style: normal;font-weight: 600;line-height: 28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Job
                        description

                    </span>
                </div>
                <div style="padding-top:20px;">
                    <span
                        style="font-size:16px;line-height:24px;font-weight: 400;color:#5a6881;font-family:Roboto, 'Helvetica Neue', HelveticaNeue, Helvetica, Arial, sans-serif;">Enter
                        your job details or let us guide you through what to write.
                    </span>
                </div>
                <div class="form-group" id="Description">
                    <div id="jobdescription"></div>
                    <div style="padding-top:4px;" id="validation-jobdescription" class="hide"><span
                            style="display:flex"><span
                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="color:#b91e1e">
                                    <path
                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                    </path>
                                    <circle cx="12" cy="17" r="1"></circle>
                                    <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                    </path>
                                </svg></span><span><span id="jobdescription-message" class="validation_sentence">Please
                                    add job description</span></span></span></div>

                    <input type="hidden" id="jobDescription" name="jobDescription">
                </div>
            </div>

            <div class="form-style" style="margin-top:22px;">
                <div>
                    <span
                        style="color: rgb(46, 56, 73);font-size: 28px;font-style: normal;font-weight: 600;line-height: 28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Job
                        responsibilities

                    </span>
                </div>
                <div style="padding-top:20px;">
                    <span
                        style="font-size:16px;line-height:24px;font-weight: 400;color:#5a6881;font-family:Roboto, 'Helvetica Neue', HelveticaNeue, Helvetica, Arial, sans-serif;">Let
                        candidates know what they will be doing day-to-day.
                    </span>
                </div>
                <div class="form-group" id="Responsibilities">
                    <div id="jobresponsibilities"></div>
                    <div style="padding-top:4px;" id="validation-jobresponsibilities" class="hide"><span
                            style="display:flex"><span
                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="color:#b91e1e">
                                    <path
                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                    </path>
                                    <circle cx="12" cy="17" r="1"></circle>
                                    <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                    </path>
                                </svg></span><span><span id="jobresponsibilities-message"
                                    class="validation_sentence">Please add job responsibilities
                                </span></span></span></div>
                    <input type="hidden" id="jobResponsibilities" name="jobResponsibilities">
                </div>
            </div>

            <div class="form-style" style="margin-top:22px;">
                <div>
                    <span
                        style="color: rgb(46, 56, 73);font-size: 28px;font-style: normal;font-weight: 600;line-height: 28px;font-family: Roboto, 'Helvetica Neue', 'HelveticaNeue', Helvetica, Arial, sans-serif;">Benefits

                    </span>
                </div>
                <div style="padding-top:20px;">
                    <span
                        style="font-size:16px;line-height:24px;font-weight: 400;color:#5a6881;font-family:Roboto, 'Helvetica Neue', HelveticaNeue, Helvetica, Arial, sans-serif;">There’s
                        more to a job than just the pay. Attract candidates by letting them know what benefits you
                        offer.
                    </span>
                </div>
                <div class="form-group" id="Benefits">
                    <div id="jobbenefits"></div>
                    <div style="padding-top:4px;" id="validation-jobbenefits" class="hide"><span
                            style="display:flex"><span
                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                                    style="color:#b91e1e">
                                    <path
                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                    </path>
                                    <circle cx="12" cy="17" r="1"></circle>
                                    <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                    </path>
                                </svg></span><span><span id="benefits-message" class="validation_sentence">Please add
                                    job benefits</span></span></span></div>
                    <input type="hidden" id="jobBenefits" name="jobBenefits">
                </div>
            </div>

            <div class="form-group" style="display: block;">
                <input type="submit" value="Continue" class="cont-button" name="submitbtn">
                <input type="submit" value="Save draft" class="save-button" style="margin-left:4px">
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script src="post-job.js"></script>
    <script src="post-job-write-validation.js"></script>

    <script>

        document.getElementById('uploadButton').addEventListener('click', function () {
            document.getElementById('fileInput').click();
        });

        document.getElementById('replaceButton').addEventListener('click', function () {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', function (event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
            output.style.display = 'block';
            document.getElementById('replace_logo').style.display = 'flex';
            document.getElementById('uploadButton').style.display = 'none';
        });

    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#jobdescription'), {
                toolbar: ['heading', 'bold', 'italic', 'bulletedList', 'numberedList'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h2', title: 'Heading', class: 'ck-heading_heading1' }
                    ]
                }
            })
            .then(editor => {
                // Store the editor reference so you can use it later
                window.editor = editor;

                // Listen for changes in the editor and update the input field
                editor.model.document.on('change:data', () => {
                    var data = editor.getData();
                    $('#jobDescription').val(data);

                    // Perform validation
                    validateJobDescription(data);
                });
            })
            .catch(error => {
                console.error(error);
            });

        // When the form is submitted
        $('form').on('submit', function (e) {
            // Get the editor data
            var data = window.editor.getData();

            // Put the data into the hidden input field
            $('#jobDescription').val(data);
        });

        ClassicEditor
            .create(document.querySelector('#jobresponsibilities'), {
                toolbar: ['heading', 'bold', 'italic', 'bulletedList', 'numberedList'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h2', title: 'Heading', class: 'ck-heading_heading1' }
                    ]
                }
            })
            .then(editor => {
                // Store the editor reference so you can use it later
                window.editorResponsibilities = editor;

                // Listen for changes in the editor and update the input field
                editor.model.document.on('change:data', () => {
                    var data = editor.getData();
                    $('#jobResponsibilities').val(data);

                    // Perform validation
                    validateJobResponsibilities(data); // Assuming you have a similar function for responsibilities
                });
            })
            .catch(error => {
                console.error(error);
            });

        // When the form is submitted
        $('form').on('submit', function (e) {
            // Get the editor data
            var data = window.editorResponsibilities.getData();

            // Put the data into the hidden input field
            $('#jobResponsibilities').val(data);
        });

        ClassicEditor
            .create(document.querySelector('#jobbenefits'), {
                toolbar: ['heading', 'bold', 'italic', 'bulletedList', 'numberedList'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h2', title: 'Heading', class: 'ck-heading_heading1' }
                    ]
                }
            })
            .then(editor => {
                // Store the editor reference so you can use it later
                window.editorBenefits = editor;

                // Listen for changes in the editor and update the input field
                editor.model.document.on('change:data', () => {
                    var data = editor.getData();
                    $('#jobBenefits').val(data);

                    // Perform validation
                    validateJobBenefits(data); // Assuming you have a similar function for benefits
                });
            })
            .catch(error => {
                console.error(error);
            });

        // When the form is submitted
        $('form').on('submit', function (e) {
            // Get the editor data
            var data = window.editorBenefits.getData();

            // Put the data into the hidden input field
            $('#jobBenefits').val(data);
        });
    </script>

    <script>

        window.onload = function () {
            var fileInput = document.getElementById('fileInput');
            var uploadButton = document.getElementById('uploadButton');
            var replaceLogo = document.getElementById('replace_logo');
            var preview = document.getElementById('preview');

            // Hide the replace logo section initially
            replaceLogo.style.display = 'none';

            fileInput.addEventListener('change', function () {
                var file = this.files[0];

                // Check if the file is an image
                if (file && file.type.startsWith('image/')) {
                    // Create a new FileReader object
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        // Set the src attribute of the preview image to the data URL of the uploaded image
                        preview.src = e.target.result;

                        // Show the preview image and the replace logo section, and hide the upload button
                        preview.style.display = 'block';
                        replaceLogo.style.display = 'flex';
                        uploadButton.style.display = 'none';
                    };

                    // Read the uploaded file as a data URL
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</body>

</html>