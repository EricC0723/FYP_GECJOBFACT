<!DOCTYPE html>


<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");

session_start(); // Start the session at the beginning
session_destroy();
session_start(); // Start the session at the beginning

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="post-job.css">
    <link rel="stylesheet" type="text/css" href="company_register.css">
</head>

<body class="postjob_body">
    <header class="postjob_header" style="background:#0d3880;">
        <div class="container">
            <div class="logo">
                <a href="company_landing.php" class="postjob_link"><img src="logo.png" alt="Logo"></a>
            </div>
            <div class="logo-nav">

            </div>
            <div style="flex:1 1 auto;"></div>

            <div style="padding:0 20px">
                <div class="flex-container">

                </div>
            </div>

    </header>

    <div style="padding-top:20px;">
        <div class="register_content">
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
                                <h1 class="register_title">Sign in
                                </h1>
                            </div>
                            <div class="form-group">
                                <label class="question" style="padding-bottom: 8px;">Email
                                    address</label>
                                <input class="register_input" type="email" name="companyEmail" id="email-input">
                                <div style="padding-top:4px;" id="validation-email" class="hide"><span
                                        style="display:flex"><span
                                            style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                xml:space="preserve" focusable="false" fill="currentColor" width="16"
                                                height="16" aria-hidden="true" style="color:#b91e1e">
                                                <path
                                                    d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                </path>
                                                <circle cx="12" cy="17" r="1"></circle>
                                                <path
                                                    d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                </path>
                                            </svg></span><span><span id="email-message"
                                                class="validation_sentence">Required
                                                field</span></span></span></div>
                            </div>

                            <div class="form-group">
                                <div style="display:flex;flex-direction:row;align-items:baseline;">
                                    <label class="question" style="padding-bottom: 8px;width:370px;">Password</label>
                                    <a class="employee_sentence" href="forget-password.php" style="height:27px;">Forget
                                        password?</a>
                                </div>
                                <div style="position: relative;">
                                    <input id="password" class="register_input" type="password"
                                        style="width: calc(100% - 54px); padding-right: 40px;" name="companyPassword">
                                    <button id="togglePassword" style="border: none; padding: 0; outline: none;"
                                        class="password_btn" type="button">
                                        <span id="eyeIcon">
                                            <!-- SVG for 'eye closed' here -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" focusable="false" fill="currentColor"
                                                style="width:20px;height:20px;" aria-hidden="true">
                                                <path
                                                    d="M21.912 11.59C21.791 11.32 18.867 5 12 5s-9.791 6.32-9.912 6.59a1.001 1.001 0 0 0 0 .82C2.209 12.68 5.133 19 12 19s9.791-6.32 9.912-6.59a1.001 1.001 0 0 0 0-.82ZM12 17c-4.708 0-7.173-3.728-7.877-5C4.827 10.728 7.292 7 12 7c4.71 0 7.175 3.73 7.877 5-.704 1.272-3.169 5-7.877 5Z">
                                                </path>
                                                <circle cx="12" cy="12" r="2.5"></circle>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div style="padding-top:4px;" id="validation-password" class="hide"><span
                                        style="display:flex"><span
                                            style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                xml:space="preserve" focusable="false" fill="currentColor" width="16"
                                                height="16" aria-hidden="true" style="color:#b91e1e">
                                                <path
                                                    d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                </path>
                                                <circle cx="12" cy="17" r="1"></circle>
                                                <path
                                                    d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                </path>
                                            </svg></span><span><span id="password-message"
                                                class="validation_sentence">Required
                                                field</span></span></span></div>
                            </div>


                            <div class="form-group" style="padding-top:60px;">
                                <div>
                                    <input class="register_login_btn" type="submit" value="Sign in" name="login_btn">
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <label class="question"
                                        style="padding-bottom: 8px;font-weight: 400;color: rgb(90, 104, 129);">Don't
                                        have an account? <a class="employee_sentence"
                                            href="company_register.php">Register</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        var password = document.getElementById('password');
        var togglePassword = document.getElementById('togglePassword');
        var eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function (event) {
            // Prevent the default action
            event.preventDefault();
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" focusable="false" fill="currentColor" style="width:20px;height:20px;" aria-hidden="true"><path d="M5.571 14.015A11.133 11.133 0 0 1 4.123 12C4.827 10.728 7.292 7 12 7c.192 0 .374.015.558.027l1.768-1.767A10.41 10.41 0 0 0 12 5c-6.867 0-9.791 6.32-9.912 6.59a1.001 1.001 0 0 0 0 .82 12.68 12.68 0 0 0 2.072 3.016Zm16.341-2.425a12.842 12.842 0 0 0-3.64-4.448l2.435-2.435a1 1 0 0 0-1.414-1.414l-6.384 6.384-3.232 3.232-6.384 6.384a1 1 0 1 0 1.414 1.414l2.76-2.76A10.023 10.023 0 0 0 12 19c6.867 0 9.791-6.32 9.912-6.59a1.001 1.001 0 0 0 0-.82ZM12 17a8.097 8.097 0 0 1-3.008-.578l2.099-2.099a2.488 2.488 0 0 0 3.232-3.232l2.515-2.515A10.792 10.792 0 0 1 19.877 12c-.704 1.272-3.169 5-7.877 5Z"></path></svg>'; // SVG for 'eye closed' here
            } else {
                password.type = 'password';
                eyeIcon.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" focusable="false" fill="currentColor" style="width:20px;height:20px;" aria-hidden="true"><path d="M21.912 11.59C21.791 11.32 18.867 5 12 5s-9.791 6.32-9.912 6.59a1.001 1.001 0 0 0 0 .82C2.209 12.68 5.133 19 12 19s9.791-6.32 9.912-6.59a1.001 1.001 0 0 0 0-.82ZM12 17c-4.708 0-7.173-3.728-7.877-5C4.827 10.728 7.292 7 12 7c4.71 0 7.175 3.73 7.877 5-.704 1.272-3.169 5-7.877 5Z"></path><circle cx="12" cy="12" r="2.5"></circle></svg>'; // SVG for 'eye open' here
            }
            togglePassword.blur();
        });


    </script>
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

        // Select the password input field, the confirm password input field, and the validation message containers
        var passwordInput = document.getElementById('password');
        var validationPassword = document.getElementById('validation-password');

        // Add an event listener to the email input field
        passwordInput.addEventListener('input', function () {
            var passwordMessage = document.getElementById('password-message');
            if (this.value.trim() === '') {
                // If the input field is empty
                passwordMessage.textContent = 'Required field';
                this.dataset.valid = '0';
                validationPassword.classList.remove('hide'); // Show the validation message
            } else {
                passwordMessage.textContent = '';
                this.dataset.valid = '1';
                validationPassword.classList.add('hide'); // Hide the validation message
            }
        });


        // Modify the event listener for the submit button
        submitButton.addEventListener('click', function (event) {
            var invalidInputs = [];

            // Check each input field
            if (emailInput.dataset.valid !== '1') {
                invalidInputs.push({ input: emailInput, validation: validationEmail });
            }
            if (passwordInput.dataset.valid !== '1') {
                invalidInputs.push({ input: passwordInput, validation: validationPassword });
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
</body>

</html>

<?php

if (isset($_GET["login_btn"])) {

    // Get the values from the form fields
    $companyEmail = $_GET['companyEmail'];
    $companyPassword = $_GET['companyPassword'];

    // Prepare an SQL statement to check if the email exists
    $sql = "SELECT * FROM companies WHERE CompanyEmail = '$companyEmail'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Check if the password matches
        if ($row['CompanyPassword'] != $companyPassword) {
            ?>
            <script>
                Swal.fire({
                    title: "Error",
                    text: "Invalid password.",
                    icon: "error",
                });
            </script>
            <?php
        } else {
            $_SESSION['companyEmail'] = $companyEmail;
            // Check the CompanyStatus
            if ($row['CompanyStatus'] == 'Verify') {
                ?>
                <script>
                    function sendEmail() {
                        Swal.fire({
                            title: "Success",
                            text: "Email sent successfully. Please check your email.",
                            icon: "success",
                            showCancelButton: true,
                            confirmButtonText: "Send again",
                            backdrop: `lightgrey`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: 'GET',
                                    url: 'send-verify-email.php',
                                    success: function (data) {
                                        console.log(data); // Log the output of the send-verify-email.php script
                                        sendEmail(); // Call the function again if the email was sent successfully
                                    },
                                    error: function () {
                                        alert('An error occurred while sending the email.');
                                    }
                                });
                            }
                        });
                    }

                    Swal.fire({
                        title: "Error",
                        text: "Please verify your email first.",
                        icon: "error",
                        showCancelButton: true,
                        confirmButtonText: "Send again",
                        backdrop: `lightgrey`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'GET',
                                url: 'send-verify-email.php',
                                success: function (data) {
                                    console.log(data); // Log the output of the send-verify-email.php script
                                    sendEmail(); // Call the function again if the email was sent successfully
                                },
                                error: function () {
                                    alert('An error occurred while sending the email.');
                                }
                            });
                        }
                    });


                </script>
                <?php
            } else if ($row['CompanyStatus'] == 'Blocked') {
                ?>
                    <script>
                        Swal.fire({
                            title: "Error",
                            text: "Your company account is blocked.",
                            icon: "error",
                        });
                    </script>
                <?php
            } else if ($row['CompanyStatus'] == 'Active') {
                $_SESSION['companyID'] = $row['CompanyID']; // Store the CompanyID in a session variable
                ?>
                        <script>
                            Swal.fire({
                                title: "Success",
                                text: "Login Successfully",
                                icon: "success",
                            }).then(function () {
                                window.location.href = "company_landing.php";
                            });
                        </script>
                <?php
            } else {
                ?>
                        <script>
                            Swal.fire({
                                title: "Error",
                                text: "Failed to login. Please try again.",
                                icon: "error",
                            });
                        </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "Invalid email address.",
                icon: "error",
            });
        </script>
        <?php
    }

    // Close the database connection
    mysqli_close($connect);
}
?>