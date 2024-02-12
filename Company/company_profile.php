<!DOCTYPE html>
<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning

$CompanyID = null;
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="post-job.css">
    <link rel="stylesheet" type="text/css" href="company_register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
</head>

<body class="postjob_body">
    <header class="postjob_header">
        <div class="container">
            <div class="logo">
                <a href="company_landing.php" class="postjob_link"><img style="width:150px;" src="logo.png"
                        alt="Logo"></a>
            </div>
            <div class="logo-nav">
                <nav style="display:flex">
                    <span class="header-link"><a href="company_landing.php" class="company_nav_active">Home</a></span>
                    <span class="header-link"><a href="job-listing.php">Jobs</a></span>
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
                                <?php echo isset($row['CompanyName']) ? $row['CompanyName'] : 'User Profile'; ?>
                            </span>
                            <div style="padding-top:10px;">
                                <span class="contactPerson">
                                    <?php echo isset($row['ContactPerson']) ? $row['ContactPerson'] : 'Contact Person'; ?>
                                </span>
                            </div>
                            <div style="padding-top: 10px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="company_profile.php" class="dropdown-link">Accounts
                                    details</a></div>
                            <div style="padding-top: 12px;"><a href="company_creditcard.php" class="dropdown-link">Card
                                    Payment</a></div>

                            <div style="padding-top: 12px;"><a href="payment_history.php" class="dropdown-link">Payment
                                    History</a>
                            </div>
                            <div style="padding-top: 20px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="company_contactus.php"
                                    class="dropdown-link">Contact us</a>
                            </div>
                            <div style="padding-top: 12px;"><a id="signout-link" href="company_signout.php"
                                    class="dropdown-link">Sign out</a></div>
                        </div>
                    </div>
                    <div class="add_button">
                        <a href="post-job-classify.php" class="create_job_link">Create a job ad</a>
                    </div>
                </div>
            </div>

    </header>

    <div style="padding-top:48px;padding-bottom:48px;">

        <div style="margin:0 auto;max-width:960px;width:100%;">
            <div style="padding-top:20px;">
                <div style="display:flex;flex-direction:row;align-items:center">
                    <h2 class="landing_sentence3">Company Profile</h2>
                </div>
            </div>
            <div style="padding-top:20px;">
                <div style="padding:24px;background:white;">
                    <div style="padding:20px;">
                        <div style="display:flex;flex-direction:row;justify-content:center">
                            <div style="width:100%;">
                                <div>
                                    <div style="display:flex;justify-content:center;"><svg width="62" height="65"
                                            viewBox="0 0 128 132" xmlns="http://www.w3.org/2000/svg">
                                            <g fill="none">
                                                <path d="M107.836 45.147v51.926H2V21.986h79.516" stroke-width="4"
                                                    stroke-miterlimit="10" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke="#D8527E"></path>
                                                <path
                                                    d="M104.685 44.773c11.677 0 21.315-9.526 21.315-21.48A21.242 21.242 0 00104.685 2c-11.677 0-21.13 9.526-21.13 21.48 0 11.767 9.453 21.293 21.13 21.293z"
                                                    stroke-width="4" stroke-miterlimit="10" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke="#D8527E"></path>
                                                <path
                                                    d="M2 21.986l55.05 39.038 31.694-23.161s6.858 7.284 19.092 7.284v51.926H2V21.986z"
                                                    fill="#F7DCE5"></path>
                                                <path
                                                    d="M2 21.986l55.05 39.038 31.694-23.161s6.858 7.284 19.092 7.284v51.926H2V21.986zM114.879 23.48H94.676M110.802 32.819L98.754 14.14M110.802 14.14L98.754 32.82"
                                                    stroke-width="4" stroke-miterlimit="10" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke="#D8527E"></path>
                                                <g>
                                                    <path
                                                        d="M55.01 132c17.403 0 31.51-2.509 31.51-5.604 0-3.094-14.107-5.603-31.51-5.603-17.402 0-31.509 2.509-31.509 5.603 0 3.095 14.107 5.604 31.51 5.604z"
                                                        fill="#E1E1E1"></path>
                                                </g>
                                            </g>
                                        </svg></div>
                                </div>
                            </div>
                            <div style="width:100%;">
                                <div style="padding-left:20px;">
                                    <div>
                                        <h2 class="landing_sentence3">Account Details</h2>
                                    </div>
                                    <div style="padding-top:20px;display:flex;flex-direction:row;align-items:flex-end;">
                                        <div style="width:600px;">
                                            <div><span class="landing_sentence1">Company Email</span></div>
                                            <div>
                                                <span class="landing_sentence2">
                                                    <?php echo isset($row['CompanyEmail']) ? $row['CompanyEmail'] : 'Company Email'; ?>

                                                </span>
                                            </div>
                                        </div>
                                        <div><a class="employee_sentence" href="change_email.php"
                                                style="height: 28px;width:27px;display: flex;align-items: center;">Edit</a>
                                        </div>
                                    </div>
                                    <div style="padding-top:20px;display:flex;flex-direction:row;align-items:flex-end;">
                                        <div style="width:600px;">
                                            <div><span class="landing_sentence1">Password</span></div>
                                            <div>
                                                <span class="landing_sentence2">
                                                    ********
                                                </span>
                                            </div>
                                        </div>
                                        <div><a class="employee_sentence" href="change_password.php"
                                                style="height: 28px;width:27px;display: flex;align-items: center;">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="padding-top:20px;">
                <div style="padding:24px;background:white;">
                    <div style="padding:20px;">
                        <div style="display:flex;flex-direction:row;justify-content:center">
                            <div style="width:100%;">
                                <div>
                                    <div style="display:flex;justify-content:center;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                            viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg></div>
                                </div>
                            </div>
                            <div style="width:100%;">
                                <div style="padding-left:20px;">
                                    <div>
                                        <h2 class="landing_sentence3">Personal Details</h2>
                                    </div>
                                    <div id="edit_personal">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="padding-top:20px;">
                <div style="padding:24px;background:white;">
                    <div style="padding:20px;">
                        <div style="display:flex;flex-direction:row;justify-content:center">
                            <div style="width:100%;">
                                <div>
                                    <div style="display:flex;justify-content:center;"><svg width="62" height="65"
                                            viewBox="0 0 108 134" xmlns="http://www.w3.org/2000/svg">
                                            <g fill="none">
                                                <path
                                                    d="M35.712 2v44.954H2v54.888H62.175V67.327h17.361v34.515H106V2H35.712zM24.08 71.704h-10.62V54.026h10.62v17.678zM65.209 58.74h-17.53V41.06h17.699V58.74h-.169zm0-27.78h-17.53V13.28h17.699v17.68h-.169zm28.823 27.78H76.334V41.06h17.698V58.74zm0-27.78H76.334V13.28h17.698v17.68z"
                                                    fill="#B3B5DC"></path>
                                                <path
                                                    d="M35.712 2v44.954H2v54.888H62.175V67.327h17.361v34.515H106V2H35.712zM24.08 71.704h-10.62V54.026h10.62v17.678zM65.209 58.74h-17.53V41.06h17.699V58.74h-.169zm0-27.78h-17.53V13.28h17.699v17.68h-.169zm28.823 27.78H76.334V41.06h17.698V58.74zm0-27.78H76.334V13.28h17.698v17.68zM62.176 101.842h17.361"
                                                    stroke-width="4" stroke-miterlimit="10" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke="#4153A0"></path>
                                                <g>
                                                    <path d="M35.712 46.954v54.888" stroke-width="4"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke="#4153A0"></path>
                                                </g>
                                                <g>
                                                    <path
                                                        d="M53.242 133.999c15.825 0 28.655-2.261 28.655-5.051s-12.83-5.051-28.655-5.051c-15.826 0-28.655 2.261-28.655 5.051s12.83 5.051 28.655 5.051z"
                                                        fill="#E1E1E1"></path>
                                                </g>
                                            </g>
                                        </svg></div>
                                </div>
                            </div>
                            <div style="width:100%;">
                                <div style="padding-left:20px;">
                                    <div>
                                        <h2 class="landing_sentence3">Company details</h2>
                                    </div>
                                    <div id="edit_company">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="post-job.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        document.getElementById('signout-link').addEventListener('click', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to sign out.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, sign out!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        });

        $(document).ready(function () {
            $.ajax({
                url: 'edit_profile/edit_personal.php',
                type: 'GET',
                success: function (response) {
                    $('#edit_personal').html(response);
                },
                error: function (error) {
                    console.log('Error: ', error);
                }
            });
        });

        $(document).ready(function () {
            $.ajax({
                url: 'edit_profile/edit_company.php',
                type: 'GET',
                success: function (response) {
                    $('#edit_company').html(response);
                },
                error: function (error) {
                    console.log('Error: ', error);
                }
            });
        });

    </script>
</body>

</html>
<?php

if (isset($_GET['savepersonal'])) {
    $companyPerson = $_GET['companyPerson'];
    $companyContact = $_GET['companyContact'];

    $sql = "UPDATE companies SET ContactPerson='$companyPerson', CompanyPhone='$companyContact' WHERE CompanyID='$CompanyID'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        ?>
        <script>
            Swal.fire({
                title: "Success",
                text: "Personal details updated successfully.",
                icon: "success",
            }).then(function () {
                $.ajax({
                    url: 'edit_profile/edit_personal.php',
                    type: 'GET',
                    success: function (response) {
                        $('#edit_personal').html(response);
                    },
                    error: function (error) {
                        console.log('Error: ', error);
                    }
                });
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "Failed to update personal details. Please try again.",
                icon: "error",
            }).then(function () {
                $.ajax({
                    url: 'edit_profile/edit_personal.php',
                    type: 'GET',
                    success: function (response) {
                        $('#edit_personal').html(response);
                    },
                    error: function (error) {
                        console.log('Error: ', error);
                    }
                });
            });
        </script>
        <?php
    }
}

if (isset($_GET['savecompany'])) {
    $companySize = $_GET['companySize'];

    $sql = "UPDATE companies SET CompanySize='$companySize' WHERE CompanyID='$CompanyID'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        ?>
        <script>
            Swal.fire({
                title: "Success",
                text: "Company details updated successfully.",
                icon: "success",
            }).then(function () {
                $.ajax({
                    url: 'edit_profile/edit_company.php',
                    type: 'GET',
                    success: function (response) {
                        $('#edit_company').html(response);
                    },
                    error: function (error) {
                        console.log('Error: ', error);
                    }
                });
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "Failed to update company details. Please try again.",
                icon: "error",
            }).then(function () {
                $.ajax({
                    url: 'edit_profile/edit_company.php',
                    type: 'GET',
                    success: function (response) {
                        $('#edit_company').html(response);
                    },
                    error: function (error) {
                        console.log('Error: ', error);
                    }
                });
            });
        </script>
        <?php
    }
}
?>

<?php
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}

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
    // Show swal box
    ?>
        <script>
            Swal.fire({
                title: 'Error',
                text: 'Please verify your email first.',
                icon: 'error',
            }).then(function () {
                window.location = "company_signout.php";
            });
        </script>
    <?php
} else if ($row['CompanyStatus'] == 'Block') {
    // Show swal box
    ?>
            <script>
                Swal.fire({
                    title: 'Error',
                    text: 'Your account has been blocked.',
                    icon: 'error',
                }).then(function () {
                    window.location = "company_signout.php";
                });
            </script>
    <?php
}
?>

<script>

    let cardType = getCardType();
    document.getElementById('cardType').value = cardType;
</script>

<?php
mysqli_free_result($result);
mysqli_close($connect);
?>