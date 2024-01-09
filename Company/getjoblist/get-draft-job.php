<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning

?>

<div style="width:100%;padding-top:32px;">
    <div style="flex-direction:row;display:flex;justify-content:space-between;align-items:center;">
        <?php
        $CompanyID = null;
        if (isset($_SESSION['companyData']['CompanyID'])) {
            $CompanyID = $_SESSION['companyData']['CompanyID'];
        }

        $searchTerm = '';
        if (isset($_GET['draftsearch'])) {
            $searchTerm = mysqli_real_escape_string($connect, $_GET['draftsearch']);
        }

        // Prepare the SQL statement to count the total number of jobs
        $sql = "SELECT COUNT(*) as total FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Draft' AND Job_Post_Title LIKE '%$searchTerm%' AND Job_isDeleted = '0'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $totalJobs = $row['total'];
        ?>
        <h2 class="landing_sentence3" style="width:500px">
            <?php echo $totalJobs; ?> draft
            <?php echo $totalJobs == 1 ? 'ad' : 'ads'; ?>
        </h2>
        <div>
            <form id="draftForm" method="GET" action="">
                <div style="position:relative">
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
                    $searchTerm = isset($_GET['draftsearch']) ? $_GET['draftsearch'] : '';
                    ?>
                    <input id="draftInput" type="text" class="input-box" name="draftsearch"
                        style="padding-left:44px;padding-right:44px;width:512px;"
                        placeholder="Search job title or reference number"
                        value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button id="cleardraft" class="clear-button" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                            focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                            style="width:20px;height:20px;">
                            <path
                                d="m13.4 12 5.3-5.3c.4-.4.4-1 0-1.4s-1-.4-1.4 0L12 10.6 6.7 5.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l5.3 5.3-5.3 5.3c-.4.4-.4 1 0 1.4.2.2.4.3.7.3s.5-.1.7-.3l5.3-5.3 5.3 5.3c.2.2.5.3.7.3s.5-.1.7-.3c.4-.4.4-1 0-1.4L13.4 12z">
                            </path>
                        </svg>
                    </button>
                </div>
                <input type="submit" value="Search" style="display: none;">
            </form>
        </div>
        <div style="align-items:center;display:flex;width:147px;">
            <a href="post-job-classify.php" class="create_btn">Create a job ad</a>
        </div>
    </div>
</div>

<div style="width: 100%;margin: auto;height: 100%;padding-top:12px;">

    <?php

    $CompanyID = null;
    if (isset($_SESSION['companyData']['CompanyID'])) {
        $CompanyID = $_SESSION['companyData']['CompanyID'];
    }

    $searchTerm = '';
    if (isset($_GET['draftsearch'])) {
        $searchTerm = mysqli_real_escape_string($connect, $_GET['draftsearch']);
    }

    // Prepare the SQL statement
    $sql = "SELECT * FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Draft' AND Job_Post_Title LIKE '%$searchTerm%' AND Job_isDeleted = '0' ORDER BY AdStartDate DESC";

    // Execute the SQL statement
    $result = mysqli_query($connect, $sql);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Fetch all the rows
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<table style="background-color: #fff;border-collapse: collapse;width: 100%;">
                <thead>
                    <tr>
                        <th style="width:97.05px">
                            <div class="th_title">Status</div>
                        </th>
                        <th>
                            <div class="th_title">Job</div>
                        </th>
                        <th style="width:156px;">
                            <div class="th_title" style="text-align:right;">Draft Actions</div>
                        </th>
                    </tr>
                </thead>
                <tbody><tr style="border-top: 4px solid #f5f6f8;height: 80px" >
                                <td>
                                    <div class="td_title"><span class="draft-box">
                                        <span class="draft-text">' . htmlspecialchars($row['job_status']) . '</span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="td_title">
                                        <div>
                                            <div><a href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '" class="td_job_link">' . htmlspecialchars($row['Job_Post_Title']) . '</a></div>
                                            <div style="font-size:16px;line-height:24px;">' . htmlspecialchars($row['Job_Post_Location']) . '</div>
                                            <div style="font-size:16px;line-height:24px;">Created ' . date('j F Y', strtotime($row['AdStartDate'])) . ' by ' . htmlspecialchars($_SESSION['companyData']['ContactPerson']) . ' .</div>
                                            </div>
                                    </div>
                                </td>
                                <td>
                                <div class="td_title" style="width:160px;">
                                    <div style="flex-direction:row;display:flex;justify-content:end;">
                                    <div style="display:flex;justify-content:center;align-items:center;width:44px;">
                                        <a class="listlink" href="post-job-classify.php?jobPostID=' . htmlspecialchars($row['Job_Post_ID']) . '">
                                            <svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="b33ee29c-5454-4dc1-a348-be2854231b73-edit"  role="img"><title>Edit</title><path d="M20.7 4.1c-1.4-1.4-4-1.4-5.4 0l-11 11c-.1.1-.2.3-.3.5l-1 5c-.1.3 0 .7.3.9.2.2.4.3.7.3h.2l5-1c.2 0 .4-.1.5-.3l11-11c1.5-1.5 1.5-3.9 0-5.4zM8.5 18.9l-3.2.6.6-3.2 8.6-8.6 2.6 2.6-8.6 8.6zM19.3 8.1l-.8.8-2.6-2.6.8-.8c.7-.7 1.9-.7 2.6 0 .7.7.7 1.9 0 2.6z"></path></svg>
                                            </a>
                                        </div>
                                        <div style="display:flex;justify-content:center;align-items:center;width:44px;">
                                            <button class="listlink" style="background:none;border:none;" onclick="confirmDeleteJobPost(\'' . $row['Job_Post_ID'] . '\')"><svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="e41a2bdd-71ff-4371-9193-37aee43f4338-delete"  role="img">
                                            <title>Delete</title><path d="M10 17c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1zm4 0c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1z"></path><path d="M20 4h-4V3c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v1H4c-.6 0-1 .4-1 1s.4 1 1 1v13c0 1.7 1.3 3 3 3h10c1.7 0 3-1.3 3-3V6c.6 0 1-.4 1-1s-.4-1-1-1zM10 3h4v1h-4V3zm8 16c0 .6-.4 1-1 1H7c-.6 0-1-.4-1-1V6h12v13z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            </tbody>
                            </table>';

        }
    } else {
        // No results, check if a search term was provided
        if ($searchTerm != '') {
            // Display a message for no search results
            echo '<div>No results found for "' . htmlspecialchars($searchTerm) . '"</div>';
        } else {
            // Display a message for no jobs
            echo '<div>No jobs found</div>';
        }
    }
    ?>

</div>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        // Get the elements
        var cleardraft = document.getElementById('cleardraft');
        var draftInput = document.getElementById('draftInput');

        // Hide the clear button initially
        cleardraft.style.display = 'none';

        // Show/hide the clear button when the input box content changes
        draftInput.addEventListener('input', function () {
            if (this.value) {
                cleardraft.style.display = 'inline';
            } else {
                cleardraft.style.display = 'none';
            }
        });

        // Clear the input box when the clear button is clicked
        cleardraft.addEventListener('click', function (e) {
            e.preventDefault();
            draftInput.value = '';
            // Manually trigger the input event
            var event = new Event('input', {
                bubbles: true,
                cancelable: true,
            });
            draftInput.dispatchEvent(event);
        });
    });

    $(document).ready(function () {
        $('#draftForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the form from being submitted normally

            var searchTerm = $('#draftInput').val();

            // Pass the search term to a function
            searchDraft(searchTerm);
        });
    });

</script>

<?php
// Free the result set and close the connection
mysqli_free_result($result);
mysqli_close($connect);
?>