<!DOCTYPE html>

<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
?>

<?php
session_start(); // Start the session at the beginning

if(isset($_GET["login_btn"])) {

    // Get the values from the form fields
    $companyEmail = $_GET['companyEmail'];
    $companyPassword = $_GET['companyPassword'];

    // Prepare an SQL statement
    $sql = "SELECT * FROM companies WHERE CompanyEmail = '$companyEmail' AND CompanyPassword = '$companyPassword'";
    $result = mysqli_query($connect, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['companyData'] = $row; // Store the entire row in a session variable
        echo '<script>alert("Login Successfully!"); window.location.href = "company_landing.php";</script>';
    } else {
        echo '<script>alert("Failed to login. Please try again.");</script>';
    }

    // Close the database connection
    mysqli_close($connect);
}
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
                                
                                <input class="register_input" type="email" name="companyEmail" required>
                            </div>

                            <div class="form-group">
                                <label class="question" style="padding-bottom: 8px;">Password</label>
                                <div style="position: relative;">
                                    <input id="password" class="register_input" type="password"
                                        style="width: calc(100% - 54px); padding-right: 40px;" required
                                        name="companyPassword">
                                    <button id="togglePassword" style="border: none; padding: 0; outline: none;"
                                        class="password_btn">
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
                            </div>


                            <div class="form-group" style="padding-top:60px;">
                                <div>
                                    <input class="register_login_btn" type="submit" value="Sign in"
                                        name="login_btn">
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <label class="question"
                                        style="padding-bottom: 8px;font-weight: 400;color: rgb(90, 104, 129);">Don't
                                        have an account? <a class="employee_sentence" href="company_register.php">Register</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
</body>

</html>