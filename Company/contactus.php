<!DOCTYPE html>
<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
    <link rel="stylesheet" type="text/css" href="post-job.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
</head>

<body class="postjob_body" style="background-color:white;">
<header class="postjob_header" style="background:#0d3880;">
        <div class="container">
            <div class="logo">
                <a href="company_login.php" class="postjob_link"><img style="width:150px;" src="logo.png" alt="Logo"></a>
            </div>
            <div class="logo-nav">

            </div>
            <div style="flex:1 1 auto;"></div>

            <div style="padding:0 20px">
                <div class="flex-container">

                </div>
            </div>

    </header>

    <div style="padding:48px 0px;">
        <div style="width:100%;max-width:960px;margin:0 auto;">
            <div>
                <h1 class="landing_sentence2" style="font-size:42px;line-height:44px;margin:0;">Contact Us</h1>
            </div>
            <div style="padding-top:48px;display:flex;flex-direction:row;">
                <div style="width:100%;">
                    <div>
                        <div>
                            <h3 class="landing_sentence1">Have an enquiry?</h3>
                        </div>
                        <div style="padding-top:10px;"><span class="landing_sentence2">Send us a message using the form
                                below and we'll get back to you as soon as possible.</span></div>
                        <div style="padding-top:10px;"><a class="landing_sentence2 contactlink" href="../User/contact.php"
                                style="color:#4964e9;font-weight:600;text-decoration:none;">Job seekers contact us
                                here</a></div>
                    </div>
                    <div style="padding-top:24px;">
                        <form method="post" class="form">
                            <div>
                                <div style="padding-top:20px;" class="form-group">
                                    <label class="question" style="padding-bottom: 8px;">Email
                                        address</label>
                                    <input class="input-box" type="email" id="contactEmail" name="contactEmail"
                                        placeholder="Enter the your email">
                                    <div style="padding-top:4px;" id="validation-contactEmail" class="hide"><span
                                            style="display:flex"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true" style="color:#b91e1e">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="contactEmail-message"
                                                    class="validation_sentence">Required
                                                    field</span></span></span></div>
                                </div>
                                <div class="form-group" style="padding-top:20px;"><label for="contactSubject"
                                        class="question" style="padding-bottom: 8px;">Subject</label>
                                    <input type="text" id="contactSubject" name="contactSubject" class="input-box"
                                        placeholder="Enter the subject">
                                    <div style="padding-top:4px;" id="validation-contactSubject" class="hide"><span
                                            style="display:flex"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true" style="color:#b91e1e">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="contactSubject-message"
                                                    class="validation_sentence">Required Field</span></span></span>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top:20px;" id="Message">
                                    <label for="contactMessage" class="question" style="padding-bottom: 8px;">Message
                                        <span style="font-weight:400;">(Max 1000 characters)</span></label>
                                    <textarea id="contactMessage" name="contactMessage" class="write-textarea"
                                        placeholder="Enter your message here"></textarea>
                                    <div style="padding-top:4px;" id="validation-contactMessage" class="hide"><span
                                            style="display:flex"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true" style="color:#b91e1e">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="contactMessage-message"
                                                    class="validation_sentence">Required Field</span></span></span>
                                    </div>
                                </div>
                                <div style="padding-top:20px">
                                    <input type="submit" value="Send" class="create_btn" name="submitbtn">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div style="width:100%;padding-left:48px;">
                    <div>
                        <div>
                            <h3 class="landing_sentence1">Contact Information</h3>
                        </div>
                        <div style="padding-top:10px;"><span class="landing_sentence2">Malaysia</span></div>
                        <div style="padding-top:10px;"><span class="landing_sentence2">Monday to Friday, 8:30am - 5:30pm
                                MYT</span></div>
                        <div style="padding-top:24px;"><span style="position:relative;display:block;"><span
                                    style="background:#d2d7df;height:1px;width:100%;position:absolute;"></span></span>
                        </div>
                        <div style="padding-top:24px;">
                            <span class="landing_sentence2" style="font-weight:700;">Melaka</span>
                        </div>
                        <div style="padding-top:10px;">
                            <span class="landing_sentence2">Multimedia University, Jalan Ayer Keroh Lama, 75450 Bukit
                                Beruang, Melaka, Malaysia</span>
                        </div>
                        <div style="padding-top:10px;">
                            <span class="landing_sentence2">Customer Service: <a href="tel:+60 11 1061 4689"
                                    class="landing_sentence2 contactlink"
                                    style="color:#4964e9;font-weight:600;text-decoration:none;">+60 11 1061
                                    4689</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="post-job.js"></script>
    <script src="company_contactus.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>
<?php
if (isset($_POST["submitbtn"])) {

    $ContactName = $_POST["contactName"];
    $ContactEmail = $_POST["contactEmail"];
    $ContactSubject = $_POST["contactSubject"];
    $ContactMessage = $_POST["contactMessage"];

    $sql = "INSERT INTO company_contact_us (CompanyEmail, Subject, Message) VALUES ('$ContactEmail', '$ContactSubject', '$ContactMessage')";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        ?>
        <script>
            Swal.fire({
                title: "Success",
                text: "Your message has been sent",
                icon: "success",
                backdrop: `lightgrey`
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "company_login.php";
                }
            });
        </script>
        <?php
    }
}

?>
