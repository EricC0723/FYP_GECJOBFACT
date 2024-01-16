<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning
?>

<div style="width:100%;padding-top:32px;">
    <div style="flex-direction:column;display:flex;">
        <?php
        $CompanyID = null;
        if (isset($_SESSION['companyID'])) {
            $CompanyID = $_SESSION['companyID'];
        }

        $searchTerm = '';
        if (isset($_GET['applicantsearch'])) {
            $searchTerm = mysqli_real_escape_string($connect, $_GET['applicantsearch']);
        }

        ?>
        <h2 class="landing_sentence3" style="width:500px">
            Applicants
        </h2>
        <span class="landing_sentence1" style="font-size:18px;line-height:28px;font-weight:400;padding-top:26px;">Search
            for current and past applicants</span>
        <div style="padding-top:26px;">
            <form id="applicantForm" method="GET" style="flex-direction:row;display:flex;">
                <div style="position:relative;padding-right:5px;">
                    <div class="divsearchicon">
                        <span class="spansearchicon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                xml:space="preserve" focusable="false" fill="currentColor" width="16" height="16"
                                style="width:20px;height:20px;" aria-hidden="true">
                                <path
                                    d="M21.7 20.3 18 16.6c1.2-1.5 2-3.5 2-5.6 0-5-4-9-9-9s-9 4-9 9 4 9 9 9c2.1 0 4.1-.7 5.6-2l3.7 3.7c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4zM4 11c0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.9-.8 3.7-2 4.9-1.3 1.3-3 2-4.9 2-4 .1-7.1-3-7.1-6.9z">
                                </path>
                            </svg></span>
                    </div>
                    <?php
                    // Get the search term from the URL parameters
                    $searchTerm = isset($_GET['applicantsearch']) ? $_GET['applicantsearch'] : '';
                    ?>
                    <input id="applicantInput" type="text" class="input-box" name="applicantsearch"
                        style="padding-left:44px;padding-right:44px;width:512px;"
                        placeholder="Search by name, job title" value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button id="clearapplicant" class="clear-button" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                            focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                            style="width:20px;height:20px;">
                            <path
                                d="m13.4 12 5.3-5.3c.4-.4.4-1 0-1.4s-1-.4-1.4 0L12 10.6 6.7 5.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l5.3 5.3-5.3 5.3c-.4.4-.4 1 0 1.4.2.2.4.3.7.3s.5-.1.7-.3l5.3-5.3 5.3 5.3c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4L13.4 12z">
                            </path>
                        </svg>
                    </button>
                    <input type="submit" value="Seek" class="create_btn" style="">
                </div>
            </form>
        </div>
        <!-- <div style="align-items:center;display:flex;width:147px;">
            <a href="post-job-classify.php" >Create a job ad</a>
        </div> -->
    </div>

    <div style="width: 100%;margin: auto;height: 100%;padding-top:12px;">

        <?php
        $CompanyID = null;
        if (isset($_SESSION['companyID'])) {
            $CompanyID = $_SESSION['companyID'];
        }

        $searchTerm = '';
        if (isset($_GET['applicantsearch'])) {
            $searchTerm = mysqli_real_escape_string($connect, $_GET['applicantsearch']);
        }

        $sql = "SELECT job_post.*, applications.*
                    FROM applications 
                    INNER JOIN job_post ON applications.JobID = job_post.Job_Post_ID 
                    WHERE job_post.CompanyID = $CompanyID 
                    AND (job_post.Job_Post_Title LIKE '%$searchTerm%' 
                    OR applications.FirstName LIKE '%$searchTerm%'
                    OR applications.LastName LIKE '%$searchTerm%')
                    AND job_post.Job_isDeleted = '0' 
                    AND job_post.job_status IN ('Active', 'Closed', 'Blocked')
                    ORDER BY applications.ApplyDate DESC";
        $result = mysqli_query($connect, $sql);

        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            // Fetch all the rows
            echo '<table style="background-color: #fff;border-collapse: collapse;width: 100%;">
            <thead>
                <tr>
                    <th style="width:100px;">
                        <div class="th_title">Status</div>
                    </th>
                    <th style="width:400px;">
                        <div class="th_title">Applicant Name</div>
                    </th>
                    <th>
                        <div class="th_title">Job Applied</div>
                    </th>
                    <th style="width:120px;">
                        <div class="th_title">Job Status</div>
                    </th>
                    <th style="width:156px;">
                        <div class="th_title" style="text-align:right;">Applicant Actions</div>
                    </th>
                </tr>
            </thead>';
            while ($row = mysqli_fetch_assoc($result)) {
                $jobStatus = htmlspecialchars($row['job_status']);
                $jobstatusbox = '';
                $jobstatustext = '';

                // Determine the class based on the job status
                switch ($jobStatus) {
                    case 'Active':
                        $jobstatusbox = 'active-box';
                        $jobstatustext = 'active-text';
                        break;
                    case 'Closed':
                        $jobstatusbox = 'closed-box';
                        $jobstatustext = 'closed-text';
                        break;
                    case 'Blocked':
                        $jobstatusbox = 'blocked-box';
                        $jobstatustext = 'blocked-text';
                        break;
                }

                $Status = htmlspecialchars($row['Status']);
                $statusbox = '';
                $statustext = '';

                // Determine the class based on the job status
                switch ($Status) {
                    case 'Accepted':
                        $statusbox = 'active-box';
                        $statustext = 'active-text';
                        break;
                    case 'Pending':
                        $statusbox = 'draft-box';
                        $statustext = 'draft-text';
                        break;
                    case 'Rejected':
                        $statusbox = 'blocked-box';
                        $statustext = 'blocked-text';
                        break;
                    case 'Processed':
                        $statusbox = 'process-box';
                        $statustext = 'process-text';
                        break;
                }

                echo '
                        <tbody>
                            <tr style="border-top: 4px solid #f5f6f8;height: 80px">
                                <td>
                                    <div class="td_title"><span class="' . $statusbox . '">
                                        <span class="' . $statustext . '">' . $Status . '</span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="td_title">
                                        <div>
                                            <div style="font-size:16px;line-height:24px;">' . htmlspecialchars($row['FirstName']) . ' ' . htmlspecialchars($row['LastName']) . '</div>
                                            <a href="mailto: ' . htmlspecialchars($row['Email']) . '" class="applicant_email"><div style="font-size:16px;line-height:24px;">' . htmlspecialchars($row['Email']) . '</div></a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="td_title">
                                        <div>
                                            <div><a href="view-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '" class="td_job_link">' . htmlspecialchars($row['Job_Post_Title']) . '</a></div>
                                            <div style="font-size:16px;line-height:24px;">' . htmlspecialchars($row['Job_Post_Location']) . '</div>
                                            <div style="font-size:16px;line-height:24px;">Apply at ' . date('j F Y', strtotime($row['ApplyDate'])) . '.</div>
                                            </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="td_title"><span class="' . $jobstatusbox . '">
                                        <span class="' . $jobstatustext . '">' . $jobStatus . '</span></span>
                                    </div>
                                </td>
                                <td>
                                <div class="td_title" style="width:160px;">
                                    <div style="flex-direction:row;display:flex;justify-content:end;">
                                        <div style="display:flex;justify-content:center;align-items:center;width:44px;">
                                            <button class="listlink" style="background:none;border:none;" onclick="fetchAndOpenNav(this)" data-applicant-id="' . htmlspecialchars($row['ApplicationID']) . '">
                                                <svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="b33ee29c-5454-4dc1-a348-be2854231b73-edit"  role="img"><title>View</title><path d="M21.912 11.59C21.791 11.32 18.867 5 12 5s-9.791 6.32-9.912 6.59a1.001 1.001 0 0 0 0 .82C2.209 12.68 5.133 19 12 19s9.791-6.32 9.912-6.59a1.001 1.001 0 0 0 0-.82ZM12 17c-4.708 0-7.173-3.728-7.877-5C4.827 10.728 7.292 7 12 7c4.71 0 7.175 3.73 7.877 5-.704 1.272-3.169 5-7.877 5Z"></path><circle cx="12" cy="12" r="2.5"></circle></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="continuedraft_button" style="display:none">
                                        <a href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '" class="continue_job_link">Continue draft</a>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            </tbody>
                        ';

            }
            echo '
            </table>';
        } else {
            // No results, check if a search term was provided
            if ($searchTerm != '') {
                // Display a message for no search results
                echo '<div style="padding-top:24px;">
                        <div style="width:100%;margin:0 auto;">
                            <div style="padding:24px;background:white;">
                                <div style="text-align:center;padding:24px 0;">
                                    <div style="display:flex;flex-direction:column;align-items:center;padding-top:32px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="121" viewBox="0 0 128 121"><title>Empty search icon</title><defs><path id="a" d="M0 0.38516965L127.544 0.38516965 127.544 104.031405 0 104.031405z"></path><path id="c" d="M0.411359385 0.528L5.26323441 0.528 5.26323441 9.73807317 0.411359385 9.73807317z"></path></defs><g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1" transform="translate(-762 -367) translate(762 366)"><g transform="translate(0 9.472)"><mask id="b" fill="#fff"><use xlink:href="#a"></use></mask><path fill="#EAF0FA" d="M125.952 25.15c-6.686-4.4-17.46-6.252-30.366-5.478C83.61 3.27 62.287-4.058 43.587 3.162c-18.7 7.222-28.78 26.675-25.57 46.46C8.151 57.64 1.721 66.137.078 73.753c-.636 2.95 2.736 5.327 5.09 3.568 5.2-3.884 11.414-7.884 18.444-11.856.182-.102.374-.204.557-.307 3.657 19.527 13.737 35.548 32.07 38.41 19.404 3.03 37.285-8.931 43.111-30.802l5.101-3.555c2.036-1.418 2.905-3.922 2.162-6.228-1.834-5.69-5.175-16.177-6.427-20.895l-.147.255a42.667 42.667 0 00-2.073-6.323 242.89 242.89 0 015.03-1.205c7.937-1.81 15.31-3.054 21.863-3.708 2.968-.297 3.682-4.251 1.093-5.955" mask="url(#b)"></path></g><path stroke="#FFF" stroke-linecap="round" stroke-width="2" d="M43.516 12.377c-2.532 2.559-5.038 12.17-2.354 21.185M42.866 11.615c8.641-.044 23.172 8.607 27.435 19.625"></path><g transform="translate(43 .472)"><mask id="d" fill="#fff"><use xlink:href="#c"></use></mask><path fill="#EAF0FA" d="M1.691 9.645C-.347 10.818-.09.528 3.473.528c3.565 0 1.19 7.408-1.782 9.117" mask="url(#d)"></path></g><path fill="#EAF0FA" d="M41.709 10.677c2.16-.26-1.195-5.848-4.35-4.255-3.154 1.592 1.202 4.635 4.35 4.255"></path><path fill="#031D44" d="M89.426 65.262a2.115 2.115 0 11-4.23 0 2.115 2.115 0 014.23 0"></path><path stroke="#031D44" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M51.954 118.09a56.621 56.621 0 006.298 2.235 3.637 3.637 0 002.039-6.98l3.76 1.098a3.636 3.636 0 002.038-6.981l4.296 1.255a3.636 3.636 0 002.04-6.981L53.36 96.168l10.568-3.771"></path><path stroke="#031D44" stroke-linecap="round" stroke-width="2" d="M113.04 65.262c0 14.21-11.52 25.73-25.73 25.73-14.209 0-25.729-11.52-25.729-25.73 0-14.209 11.52-25.729 25.73-25.729 14.208 0 25.728 11.52 25.728 25.73z"></path><path stroke="#031D44" stroke-linecap="round" stroke-width="2" d="M68.943 100.181L75.013 88.538"></path><path stroke="#FFF" stroke-linecap="round" stroke-width="2" d="M84.556 96.967c-1.377 2.755-3.673 4.133-3.673 4.133"></path></g></svg></div>
                                    <div style="display:flex;flex-direction:column;align-items:center;padding-top:32px;"><h2 class="landing_sentence3">0 search results for "' . $searchTerm . '"</h2></div>
                                </div>
                            </div>
                        </div>
                    </div>';
            } else {
                // Display a message for no jobs
                echo '<div style="padding-top:24px;">
                        <div style="width:100%;margin:0 auto;">
                            <div style="padding:24px;background:white;">
                                <div style="text-align:center;padding:24px 0;">
                                    <div style="display:flex;flex-direction:column;align-items:center;padding-top:10px;"><svg width="121px" height="121px" viewBox="0 0 121 121" version="1.1"><title>Profile icon</title><defs><polygon id="path-1" points="0 0.8577 120.1422 0.8577 120.1422 120.9997 0 120.9997"></polygon></defs><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Zero_states_inbox" transform="translate(-797.000000, -376.000000)"><g id="Group-10" transform="translate(797.000000, 375.000000)"><g id="Group-3" transform="translate(0.000000, 0.143000)"><g id="Clip-2"></g><path d="M120.1422,60.9287 C120.1422,94.1047 93.2472,120.9997 60.0712,120.9997 C26.8952,120.9997 -0.0008,94.1047 -0.0008,60.9287 C-0.0008,27.7527 26.8952,0.8577 60.0712,0.8577 C93.2472,0.8577 120.1422,27.7527 120.1422,60.9287" id="Fill-1" fill="#EAF0FA" mask="url(#mask-2)"></path></g><path d="M83.0836,40.2451 C83.0836,53.4971 71.3146,68.2551 59.0886,68.2551 C46.9676,68.2551 35.0926,53.4971 35.0926,40.2451 C35.0926,26.9931 45.8356,16.2491 59.0886,16.2491 C72.3406,16.2491 83.0836,26.9931 83.0836,40.2451 Z" id="Stroke-4" stroke="#031D44" stroke-width="2" stroke-linecap="round"></path><path d="M13.2144,120.08 L13.2144,108.427 C13.2144,93.333 21.7154,80.347 33.4364,77.671 C41.6034,75.807 51.0804,74.206 59.5474,74.206 C67.5894,74.206 77.2184,75.881 85.6094,77.799 C95.2794,80.011 102.7734,89.198 105.1134,100.818" id="Stroke-6" stroke="#031D44" stroke-width="2" stroke-linecap="round"></path><path d="M84.1793,99.998 L69.9173,99.998 C68.2303,99.998 66.8623,98.63 66.8623,96.942 C66.8623,95.254 68.2303,93.886 69.9173,93.886 L84.1793,93.886 C85.8663,93.886 87.2353,95.254 87.2353,96.942 C87.2353,98.63 85.8663,99.998 84.1793,99.998 Z" id="Stroke-8" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"></path></g></g></g></svg></div>
                                    <div style="display:flex;flex-direction:column;align-items:center;padding-top:24px;"><h2 class="landing_sentence1">No applicants yet</h2></div>
                                    <div style="display:flex;flex-direction:column;align-items:center;padding-top:10px;"><span class="joblisttitle">Check back later to see if you have new applications.</span></div>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }


        ?>
        <div id="mySidebar" class="sidebar">
            <!-- Your content goes here -->

        </div>

    </div>
</div>

<script>

    
</script>

<script>
    document.getElementById("overlay").addEventListener('click', closeNav);

    function openNav() {
        document.body.classList.add('no-scroll');
        document.getElementById("mySidebar").classList.add("open");
        document.getElementById("overlay").classList.add("open");
    }

    function closeNav() {
        document.body.classList.remove('no-scroll');
        document.getElementById("mySidebar").classList.remove("open");
        document.getElementById("overlay").classList.remove("open");

        // Refresh the applicant list
    }

    // Listen for click events on the document
    document.addEventListener('mouseup', function (e) {
        var sidebar = document.getElementById("mySidebar");

        // If the clicked element is not the sidebar and not the button, close the sidebar
        if (!sidebar.contains(e.target) && e.target.className !== 'listlink') {
            closeNav();
        }
    });


    document.addEventListener('DOMContentLoaded', function () {
        // Get the elements
        var clearapplicant = document.getElementById('clearapplicant');
        var applicantInput = document.getElementById('applicantInput');

        // Hide the clear button initially
        clearapplicant.style.display = 'none';

        // Show/hide the clear button when the input box content changes
        applicantInput.addEventListener('input', function () {
            if (this.value) {
                clearapplicant.style.display = 'flex';
            } else {
                clearapplicant.style.display = 'none';
            }
        });

        // Clear the input box when the clear button is clicked
        clearapplicant.addEventListener('click', function (e) {
            e.preventDefault();
            applicantInput.value = '';
            // Manually trigger the input event
            var event = new Event('input', {
                bubbles: true,
                cancelable: true,
            });
            applicantInput.dispatchEvent(event);
        });
    });

    $(document).ready(function () {
        $('#applicantForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the form from being submitted normally

            var searchTerm = $('#applicantInput').val();

            // Pass the search term to a function
            searchApplicant(searchTerm);
        });
    });

</script>

<?php
// Free the result set and close the connection
mysqli_free_result($result);
mysqli_close($connect);
?>