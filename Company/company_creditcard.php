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
    <title>Payment Card</title>
    <link rel="stylesheet" type="text/css" href="post-job.css">
    <link rel="stylesheet" type="text/css" href="company_register.css">
    <link rel="stylesheet" type="text/css" href="company_creditcard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
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
                    <h2 class="landing_sentence3">Company Payment</h2>
                </div>
            </div>

            <div style="padding-top:20px;">
                <div style="background:white;" id="creditcard">

                </div>

            </div>





        </div>
    </div>

    <script src="post-job.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
    <script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
    <script src="company_creditcard.js"></script>

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
                url: 'creditcard/creditcardlist.php',
                type: 'GET',
                success: function (response) {
                    $('#creditcard').html(response);
                },
                error: function (error) {
                    console.log('Error: ', error);
                }
            });
        });

        function deleteCreditCard(button) {
            var id = button.getAttribute('data-id'); // make sure your button has a 'data-id' attribute
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'creditcard/deletecreditcard.php',
                        type: 'GET',
                        data: { id: id },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire("Success", "Payment card has been deleted.", "success");
                                $.ajax({
                                    url: 'creditcard/creditcardlist.php',
                                    type: 'GET',
                                    success: function (response) {
                                        $('#creditcard').html(response);
                                    },
                                    error: function (error) {
                                        console.log('Error: ', error);
                                    }
                                });
                            } else {
                                Swal.fire("Error!", "Error delete payment card!", "error");
                            }
                        }
                    });
                }
            });
        }



    </script>

</body>

</html>
<?php
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_GET['submitbtn'])) {
    $cardNumber = $_GET['cardNumberInput'];
    $cardName = $_GET['cardNameInput'];
    $cardType = $_GET['cardTypeInput'];
    $cardMonth = $_GET['cardMonthInput'];
    $cardYear = $_GET['cardYearInput'];
    $cardCvv = $_GET['cardCvvInput'];

    $sql = "INSERT INTO credit_card (CompanyID, CreditCard_Type, CreditCard_Number, CreditCard_Holder, CreditCard_ExpMonth, CreditCard_ExpYear, CreditCard_CVV) VALUES ('$CompanyID', '$cardType', '$cardNumber', '$cardName', '$cardMonth', '$cardYear', '$cardCvv')";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        ?>
        <script>
            Swal.fire({
                title: "Success",
                text: "Payment card added successfully",
                icon: "success",
                backdrop: `lightgrey`,
            }).then(function () {
                window.location.href = "company_creditcard.php";
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "Payment card added failed",
                icon: "error",
                backdrop: `lightgrey`,
            });
        </script>
        <?php
    }
}


if (isset($_GET['savebtn'])) {
    $cardNumber = $_GET['cardNumberInput'];
    $cardName = $_GET['cardNameInput'];
    $cardType = $_GET['cardTypeInput'];
    $cardMonth = $_GET['cardMonthInput'];
    $cardYear = $_GET['cardYearInput'];
    $cardCvv = $_GET['cardCvvInput'];

    $id = $_GET['id'];

    $sql = "UPDATE credit_card SET CreditCard_Type = '$cardType', CreditCard_Number = '$cardNumber', CreditCard_Holder = '$cardName', CreditCard_ExpMonth = '$cardMonth', CreditCard_ExpYear = '$cardYear', CreditCard_CVV = '$cardCvv' WHERE CreditCardID = '$id' AND CompanyID = '$CompanyID' AND CreditCard_isDeleted = 0";

    $result = mysqli_query($connect, $sql);

    if ($result) {
        ?>
        <script>
            Swal.fire({
                title: "Success",
                text: "Payment card updated successfully",
                icon: "success",
                backdrop: `lightgrey`,
            }).then(function () {
                window.location.href = "company_creditcard.php";
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "Payment card updated failed",
                icon: "error",
                backdrop: `lightgrey`,
            });
        </script>
        <?php
    }
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

<?php
mysqli_close($connect);
?>