<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning
$emailSent = isset($_GET['emailSent']) ? $_GET['emailSent'] : false;
$companyEmail = isset($_GET['companyEmail']) ? $_GET['companyEmail'] : '';
?>

<div>
    <div class="employee_link">
        <span><a href="" class="employee_sentence">Are you looking for a job?</a></span>
    </div>
</div>
<form method="GET">
    <div>
        <div class="register_form">
            <div style="padding:48px;">
                <div>
                    <h1 class="register_title">Forgot password
                    </h1>
                </div>
                <?php
                if ($emailSent) {
                    // The email was sent
                    echo '<div style="padding-top:10px;"><span class="question"
                                    style="font-weight: 400;color: rgb(90, 104, 129);font-size:14px;">You should receive the email fairly quickly. If you cant find it, try checking your spam folder.
                                </span></div>
                            <div class="form-group" style="align-items:center;flex-direction:row;">
                                <label class="question" style="padding-bottom: 0px;margin-right:0px;">Didnt receive? </label>
                                <input type="hidden" name="companyEmail" value="' . $companyEmail . '">
                                <input class="employee_sentence" type="submit" value="Send again" name="login_btn" style="background: none;border: none;cursor: pointer;height:24px;">
                            </div>

                            <div class="form-group" style="padding-top:60px;">
                                <div>
                                    <a class="cont-button" href="company_login.php" style="display: flex;width: 100%;text-decoration: none;align-items: center;justify-content: center;"
                                        >Sign in</a>
                                </div>
                            </div>';
                } else {
                    // There was an error sending the email
                    echo '<div style="padding-top:10px;"><span class="question"
                                    style="font-weight: 400;color:#5a6881;">Enter
                                    your email address below and we will send you a link to reset your password.
                                </span></div>
                            <div class="form-group">
                                <label class="question" style="padding-bottom: 8px;">Email
                                    address</label>
                                <input class="register_input" type="email" name="companyEmail" id="email-input">
                                <div style="padding-top:4px;" id="validation-email" class="hide"><span style="display:flex"><span
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
                                            </svg></span><span><span id="email-message" class="validation_sentence">Required
                                                field</span></span></span></div>
                            </div>

                            <div class="form-group" style="padding-top:60px;">
                                <div>
                                    <input class="register_login_btn" type="submit" value="Next" name="login_btn"
                                        style="width:74px;">
                                </div>
                            </div>
                    ';
                }
                ?>

                <div class="form-group">
                    <div>
                        <label class="question"
                            style="padding-bottom: 8px;font-weight: 400;color: rgb(90, 104, 129);">If you
                            need additional help, please contact
                            <a class="employee_sentence" href="contactus.php">customer service</a>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>

    // Select the email input field, the submit button, and the validation message container
    var emailInput = document.getElementById('email-input');
    var submitButton = document.querySelector('.register_login_btn');
    var validationEmail = document.getElementById('validation-email');

    // Add an event listener to the email input field
    emailInput.addEventListener('input', function () {
        var emailMessage = document.getElementById('email-message');
        if (this.value.trim() === '') {
            // If the input field is empty
            emailMessage.textContent = 'Required field';
            this.dataset.valid = '0';
            validationEmail.classList.remove('hide'); // Show the validation message
        } else {
            emailMessage.textContent = '';
            this.dataset.valid = '1';
            validationEmail.classList.add('hide'); // Hide the validation message
        }
    });

    // Modify the event listener for the submit button
    submitButton.addEventListener('click', function (event) {
        var invalidInputs = [];

        // Check each input field
        if (emailInput.dataset.valid !== '1') {
            invalidInputs.push({ input: emailInput, validation: validationEmail });
        }
        if (invalidInputs.length > 0) {
            // If there are invalid inputs, prevent the form submission
            event.preventDefault();

            // Focus on the first invalid input
            invalidInputs[0].input.focus();

            // Show validation messages for all invalid inputs
            invalidInputs.forEach(function (invalidInput) {
                invalidInput.validation.classList.remove('hide');
            });
        }
        // If all inputs are valid, the form will submit normally
    });
</script>

