<!DOCTYPE html>

<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" type="text/css" href="post-job.css">
    <link rel="stylesheet" type="text/css" href="company_register.css">
</head>

<body class="postjob_body">
    <header class="postjob_header" style="background:#0d3880;">
        <div class="container">
            <div class="logo">
                <a href="company_login.php" class="postjob_link"><img style="width:150px;" src="logo.png" alt="Logo"></a>
            </div>
    </header>

    <div style="padding-top:20px;">
        <div class="register_content">

            <form method="GET" style="padding-top:80px;">
                <div>
                    <div class="register_form">
                        <div style="padding:48px;">

                            <div>
                                <h1 class="register_title">Email verification
                                </h1>
                            </div>

                            <?php

                            if (isset($_GET['data'])) {
                                // Decode the data from the URL
                                $decoded = base64_decode($_GET['data']);

                                // Split the data into the hash and the email
                                list($hash, $email) = explode(':', $decoded, 2);

                                // Recreate the hash
                                $secretKey = "your-secret-key";
                                $expectedHash = hash_hmac('sha256', $email, $secretKey);

                                // Query the database for the user with this email
                                $query = mysqli_query($connect, "SELECT * FROM companies WHERE CompanyEmail = '$email'");

                                if (mysqli_num_rows($query) > 0) {
                                    // Verify the hash
                                    if ($hash === $expectedHash) {
                                        // The hashes match, so set the user's account as verified
                                        mysqli_query($connect, "UPDATE companies SET CompanyStatus = 'Active' WHERE CompanyEmail = '$email'");

                                        echo '<div style="padding-top:10px;"><h3 class="landing_sentence1"
                                        >Your account has been verified! You can now log in.
                                            </h3>
                                        </div>';
                                    } else {
                                        echo '
                                        <div style="padding-top:10px;"><h3 class="landing_sentence1"
                                        >Invalid verification link. Please check your email or request a new one.
                                            </h3>
                                        </div>';
                                    }
                                } else {
                                    echo '<div style="padding-top:10px;"><h3 class="landing_sentence1"
                                    >No account found with this email address.
                                        </h3>
                                    </div>';
                                }
                            } else {
                                echo '<div style="padding-top:10px;"><h3 class="landing_sentence1"
                                style="">No data received for verification.
                                    </h3>
                                </div>';
                            }

                            // Close the database connection
                            mysqli_close($connect);
                            ?>

                            <div class="form-group" style="padding-top:30px;">
                                <div>
                                    <a class="cont-button" href="company_login.php"
                                        style="display: flex;width: 100%;text-decoration: none;align-items: center;justify-content: center;">Sign
                                        in</a>
                                </div>
                            </div>

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
        </div>
    </div>
</body>

</html>