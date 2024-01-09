<!DOCTYPE html>

<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning

if (!isset($_SESSION['companyData'])) {
    echo '<script>alert("You haven\'t logged in"); window.location.href = "company_login.php";</script>';
    exit;
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
                <a href="company_landing.php" class="postjob_link"><img src="logo.png" alt="Logo"></a>
            </div>
            <div class="logo-nav">
                <nav style="display:flex">
                    <span class="header-link"><a href="company_landing.php" class="company_nav_active">Home</a></span>
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
                                <?php echo isset($_SESSION['companyData']['CompanyName']) ? $_SESSION['companyData']['CompanyName'] : 'User Profile'; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
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
            <div class="underline"></div>
        </div>
    </div>

    <div class="content-div" id="active">

    </div>

    <div class="content-div" id="closed">

    </div>

    <div class="content-div" id="draft">

    </div>

    <div class="content-div" id="blocked">

    </div>



    </div>

    <script src="post-job.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            getactivejob();
            getclosedjob();
            getdraftjob();
            getblockedjob();
        });

        function confirmCloseJobPost(jobPostID) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once closed, you will not be able to reopen this job post!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, close it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'change_status/closed.php',
                        type: 'GET',
                        data: { jobPostID: jobPostID },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire("Closed!", "Job post has been closed.", "success");
                                // Update the status in the table
                                getactivejob();
                                getclosedjob();
                                getdraftjob();
                                getblockedjob();
                            } else {
                                Swal.fire("Error!", "Error closing job post!", "error");
                            }
                        }
                    });
                }
            });
        }

        function confirmDeleteJobPost(jobPostID) {
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
                        url: 'change_status/delete.php',
                        type: 'GET',
                        data: { jobPostID: jobPostID },
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire("Closed!", "Job post has been closed.", "success");
                                // Update the status in the table
                                getactivejob();
                                getclosedjob();
                                getdraftjob();
                                getblockedjob();
                            } else {
                                Swal.fire("Error!", "Error closing job post!", "error");
                            }
                        }
                    });
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
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var buttons = document.querySelectorAll('.joblistbtn');
            var underline = document.querySelector('.underline');
            var divs = [document.getElementById('active'), document.getElementById('closed'), document.getElementById('draft'), document.getElementById('blocked')];

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
        });
    </script>
</body>
</html>