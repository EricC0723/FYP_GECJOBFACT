<!DOCTYPE html>

<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning
unset($_SESSION['job_post_ID']);

?>

<?php

$CompanyID = null;
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
    // Prepare the SQL statement to count the total number of jobs
    $sqlc = "SELECT COUNT(*) as total FROM job_post WHERE CompanyID = $CompanyID";
    $resultc = mysqli_query($connect, $sqlc);
    $rowc = mysqli_fetch_assoc($resultc);
    $totalJobs = $rowc['total'];

    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="job-listing.css">
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
                    <span class="header-link"><a href="company_landing.php">Home</a></span>
                    <span class="header-link"><a href="job-listing.php" class="company_nav_active">Jobs</a></span>
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
                            <div style="padding-top: 12px;"><a href="#team" class="dropdown-link">Your team</a></div>
                            <div style="padding-top: 12px;"><a href="company_creditcard.php" class="dropdown-link">Card
                                    Payment</a></div>

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
    <div style="width:100%;background:white;">
        <div style="max-width:1280px; margin:0 auto;flex-direction:row;display:flex;position:relative;">
            <div>
                <button type="button" class="joblistbtn active" id="activeButton"><span
                        class="joblisttitle">Active</span></button>
            </div>
            <div>
                <button type="button" class="joblistbtn" id="closedButton"><span
                        class="joblisttitle">Closed</span></button>
            </div>
            <div>
                <button type="button" class="joblistbtn" id="draftButton"><span
                        class="joblisttitle">Draft</span></button>
            </div>
            <div>
                <button type="button" class="joblistbtn" id="blockedButton"><span
                        class="joblisttitle">Blocked</span></button>
            </div>
            <div>
                <button type="button" class="joblistbtn" id="applicantsButton"><span
                        class="joblisttitle">Applicants</span></button>
            </div>
            <div class="underline"></div>
        </div>
    </div>

    <div class="content-div" id="active" style="padding-bottom:100px;">

    </div>

    <div class="content-div" id="closed" style="padding-bottom:100px;">

    </div>

    <div class="content-div" id="draft" style="padding-bottom:100px;">

    </div>

    <div class="content-div" id="blocked" style="padding-bottom:100px;">

    </div>

    <div class="content-div" id="applicants" style="padding-bottom:100px;">

    </div>

    <div id="mySidebar" class="sidebar">
        <!-- Your content goes here -->

    </div>




    <div id="overlay" class="overlay"></div>


    <script src="post-job.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        $(document).ready(function () {
            getactivejob();
            getclosedjob();
            getdraftjob();
            getblockedjob();
            getapplicants();
        });

        function confirmCloseJobPost(jobPostID) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once closed, you will not be able to reopen this job post",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, close it',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'change_status/closed.php',
                        type: 'GET',
                        data: { jobPostID: jobPostID },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire("Closed", "Job post has been closed.", "success");
                                // Update the status in the table
                                getactivejob();
                                getclosedjob();
                                getdraftjob();
                                getblockedjob();
                                getapplicants();
                            } else {
                                Swal.fire("Error", "Error closing job post", "error");
                            }
                        }
                    });
                }
            });
        }

        function confirmDeleteJobPost(jobPostID) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once delete, you will not be able to recover this job post",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'change_status/delete.php',
                        type: 'GET',
                        data: { jobPostID: jobPostID },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire("Deleted", "Job post has been delete.", "success");
                                // Update the status in the table
                                getactivejob();
                                getclosedjob();
                                getdraftjob();
                                getblockedjob();
                                getapplicants();
                            } else {
                                Swal.fire("Error", "Error deleting job post", "error");
                            }
                        }
                    });
                }
            });
        }

        function confirmDeleteDraft(jobPostID) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once delete, you will not be able to recover this draft",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'change_status/delete-draft.php',
                        type: 'GET',
                        data: { jobPostID: jobPostID },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire("Deleted", "Draft has been delete.", "success");
                                // Update the status in the table
                                getactivejob();
                                getclosedjob();
                                getdraftjob();
                                getblockedjob();
                                getapplicants();
                            } else {
                                Swal.fire("Error", "Error deleting draft", "error");
                            }
                        }
                    });
                }
            });
        }

        function copyJobPost(jobPostID) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once copied, the copied job post will be generated in drafts",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'change_status/copy.php',
                        type: 'GET',
                        data: { jobPostID: jobPostID },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire("Copied", "Job post has been copied.", "success");
                                // Update the status in the table
                                getactivejob();
                                getclosedjob();
                                getdraftjob();
                                getblockedjob();
                                getapplicants();
                            } else {
                                Swal.fire("Error", "Error copying job post", "error");
                            }
                        }
                    });
                }
            });
        }

        function changeAcceptstatus(applicantId) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once accepted, you will not be able to change the status",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, accept it',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'change_status/accept.php',
                        type: 'GET',
                        data: { applicantId: applicantId },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire("Accepted", "Application has been accepted.", "success");
                                // Update the status in the table
                                getapplicants();
                            } else {
                                Swal.fire("Error", "Error accepting application", "error");
                            }
                        }
                    });
                }
            });
        }

        function changeRejectstatus(applicantId) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once rejected, you will not be able to change the status",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, reject it',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'change_status/reject.php',
                        type: 'GET',
                        data: { applicantId: applicantId },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire("Rejected", "Application has been rejected.", "success");
                                // Update the status in the table
                                getapplicants();
                            } else {
                                Swal.fire("Error", "Error rejecting application", "error");
                            }
                        }
                    });
                }
            });
        }

        function fetchAndOpenNav(button) {
            var applicantId = $(button).data('applicant-id');

            // Set the applicantId as a data attribute of the sidebar
            $('#mySidebar').data('applicant-id', applicantId);

            // First AJAX call to get the applicant details
            $.ajax({
                url: 'getjoblist/get-applicant-details.php',
                method: 'GET',
                data: { applicantId: applicantId },
                success: function (data) {
                    // Update the sidebar content with the applicant details
                    $('#mySidebar').html(data);
                    openNav();
                    // $.ajax({
                    //     url: 'change_status/process.php',
                    //     method: 'GET',
                    //     data: { applicant_id: applicantId },
                    //     success: function (response) {
                    //         if (response == 'success') {
                    //             // Update the status in the table
                    //             getapplicants();
                    //         } 
                    //     }
                    // });
                }
            });
        }

        function getactivejob() {
            $.ajax({
                url: 'getjoblist/get-active-job.php',
                type: 'GET',
                success: function (response) {
                    $('#active').html(response);
                }
            });
        }

        function getclosedjob() {
            $.ajax({
                url: 'getjoblist/get-closed-job.php',
                type: 'GET',
                success: function (response) {
                    $('#closed').html(response);
                }
            });
        }

        function getdraftjob() {
            $.ajax({
                url: 'getjoblist/get-draft-job.php',
                type: 'GET',
                success: function (response) {
                    $('#draft').html(response);
                }
            });
        }

        function getblockedjob() {
            $.ajax({
                url: 'getjoblist/get-blocked-job.php',
                type: 'GET',
                success: function (response) {
                    $('#blocked').html(response);
                }
            });
        }

        function getapplicants() {
            $.ajax({
                url: 'getjoblist/get-applicants.php',
                type: 'GET',
                success: function (response) {
                    $('#applicants').html(response);
                }
            });
        }

        function searchActive(searchTerm) {
            $.ajax({
                url: 'getjoblist/get-active-job.php', // The PHP file that executes the search
                type: 'GET',
                data: {
                    activesearch: searchTerm
                },
                success: function (data) {
                    // Update the table with the new data
                    $('#active').html(data);
                }
            });
        }

        function searchClosed(searchTerm) {
            $.ajax({
                url: 'getjoblist/get-closed-job.php', // The PHP file that executes the search
                type: 'GET',
                data: {
                    closedsearch: searchTerm
                },
                success: function (data) {
                    // Update the table with the new data
                    $('#closed').html(data);
                }
            });
        }

        function searchDraft(searchTerm) {
            $.ajax({
                url: 'getjoblist/get-draft-job.php', // The PHP file that executes the search
                type: 'GET',
                data: {
                    draftsearch: searchTerm
                },
                success: function (data) {
                    // Update the table with the new data
                    $('#draft').html(data);
                }
            });
        }

        function searchBlocked(searchTerm) {
            $.ajax({
                url: 'getjoblist/get-blocked-job.php', // The PHP file that executes the search
                type: 'GET',
                data: {
                    blockedsearch: searchTerm
                },
                success: function (data) {
                    // Update the table with the new data
                    $('#blocked').html(data);
                }
            });
        }

        function searchApplicant(searchTerm) {
            $.ajax({
                url: 'getjoblist/get-applicants.php', // The PHP file that executes the search
                type: 'GET',
                data: {
                    applicantsearch: searchTerm
                },
                success: function (data) {
                    // Update the table with the new data
                    $('#applicants').html(data);
                }
            });
        }

        function countApplicant(jobPostID) {
            $.ajax({
                url: 'getjoblist/get-applicants.php', // The PHP file that executes the search
                type: 'GET',
                data: {
                    jobPostID: jobPostID // Pass the jobPostID to get-applicants.php
                },
                success: function (data) {
                    // Update the table with the new data
                    $('#applicants').html(data);
                }
            });
        }


    </script>

    <script>
        var buttons = document.querySelectorAll('.joblistbtn');
        var underline = document.querySelector('.underline');
        var divs = [document.getElementById('active'), document.getElementById('closed'), document.getElementById('draft'), document.getElementById('blocked'), document.getElementById('applicants')];

        $(document).ready(function () {
            var urlParams = new URLSearchParams(window.location.search);
            var jobPostID = urlParams.get('jobPostID');

            if (jobPostID) {
                countApplicant(jobPostID);
            }
        });

        // Function to update the visibility of the divs based on the id in the URL
        function updateDivVisibility() {
            // Hide all divs
            divs.forEach(function (div) {
                div.style.display = 'none';
            });

            // Remove the 'active' class from all buttons
            buttons.forEach(function (btn) {
                btn.classList.remove('active');
            });

            // Get the id from the URL
            var id = window.location.href.split('#')[1];

            // If there's no id in the URL, default to 'active'
            if (!id) {
                id = 'active';
            }

            // If the id is 'applicants', get the jobPostID from the URL
            if (id === 'applicants') {
                var urlParams = new URLSearchParams(window.location.search);
                var jobPostID = urlParams.get('jobPostID');

                // Now you can use the jobPostID in your code
            }

            // Show the div that matches the id in the URL and add the 'active' class to the associated button
            if (id) {
                document.getElementById(id).style.display = 'block';
                document.getElementById(id + 'Button').classList.add('active');

                // Update the underline
                var activeButton = document.getElementById(id + 'Button');
                underline.style.width = activeButton.offsetWidth + 'px';
                underline.style.left = activeButton.offsetLeft + 'px';
            }
        }

        // Get the 'applicants' element
        var applicantsElement = document.getElementById('applicantsButton');

        // Add an event listener to the 'applicants' element
        applicantsElement.addEventListener('click', function () {
            // Get the current URL without the query parameters and hash
            var url = window.location.href.split('?')[0].split('#')[0];

            // Change the URL
            window.history.pushState(null, null, url + '#applicants');

            searchApplicant('');

        });

        // Update the visibility of the divs when the DOM content is loaded
        updateDivVisibility();

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Add the button id to the URL
                var id = this.id.replace('Button', '');
                window.history.pushState(null, null, '#' + id);

                // Update the visibility of the divs, the underline, and the 'active' class
                updateDivVisibility();
            });
        });


    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

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

<?php
mysqli_free_result($result);
mysqli_close($connect);
?>