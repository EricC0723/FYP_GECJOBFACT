<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning

?>

<div style="width:100%;padding-top:32px;">
    <div style="flex-direction:row;display:flex;justify-content:space-between;align-items:center;">
        <?php
        $CompanyID = null;
        if (isset($_SESSION['companyID'])) {
            $CompanyID = $_SESSION['companyID'];
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
                        style="padding-left:44px;padding-right:44px;width:512px;" placeholder="Search job title"
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
    if (isset($_SESSION['companyID'])) {
        $CompanyID = $_SESSION['companyID'];
        $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
        $result = mysqli_query($connect, $sql);
        $rowc = mysqli_fetch_assoc($result);
    }

    $limit = 10; // Number of entries to show in a page.
    // Look for a GET variable page if not found default is 1.  
    if (isset($_GET["page"])) {
        $pn = $_GET["page"];
    } else {
        $pn = 1;
    }
    ;

    $start_from = ($pn - 1) * $limit;

    $searchTerm = '';
    if (isset($_GET['draftsearch'])) {
        $searchTerm = mysqli_real_escape_string($connect, $_GET['draftsearch']);
    }

    $draftSortOrder = isset($_GET['draft_sort_order']) ? $_GET['draft_sort_order'] : 'normal';

    if ($draftSortOrder === 'titleasc' || $draftSortOrder === 'titledesc') {
        if ($draftSortOrder === 'titleasc') {
            $order = 'ASC';
        } else {
            $order = 'DESC';
        }
        $sql = "SELECT * FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Draft' AND Job_Post_Title LIKE '%$searchTerm%' AND Job_isDeleted = '0' ORDER BY Job_Post_Title $order LIMIT $start_from, $limit";
    } else if ($draftSortOrder === 'dateasc' || $draftSortOrder === 'datedesc') {
        if ($draftSortOrder === 'dateasc') {
            $order = 'ASC';
        } else {
            $order = 'DESC';
        }
        $sql = "SELECT * FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Draft' AND Job_Post_Title LIKE '%$searchTerm%' AND Job_isDeleted = '0' ORDER BY AdStartDate $order LIMIT $start_from, $limit";
    } else {
        $sql = "SELECT * FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Draft' AND Job_Post_Title LIKE '%$searchTerm%' AND Job_isDeleted = '0' ORDER BY AdStartDate DESC LIMIT $start_from, $limit";
    }


    // Execute the SQL statement
    $result = mysqli_query($connect, $sql);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        ?>
        <script>
            var draftSortOrder = localStorage.getItem('draftSortOrder') || 'normal';
            var searchTerm = '';

            $(document).off('click', '.page-button.draft').on('click', '.page-button.draft', function (e) {
                e.preventDefault();
                searchTerm = $('#draftInput').val(); // Update the searchTerm variable
                var pageNumber = $(this).data('page-number'); // Get the page number from the data attribute
                localStorage.setItem('draftSortOrder', draftSortOrder);
                loadDraftPage(pageNumber, searchTerm, draftSortOrder);
            });

            document.querySelector('#draft_title_asc').addEventListener('click', function () {
                draftSortOrder = (draftSortOrder === 'normal' || draftSortOrder === 'titledesc' || draftSortOrder === 'datedesc' || draftSortOrder === 'dateasc') ? 'titleasc' : 'normal';
                searchTerm = $('#draftInput').val(); // Update the searchTerm variable
                localStorage.setItem('draftSortOrder', draftSortOrder);
                loadDraftPage(1, searchTerm, draftSortOrder); // Load the first page with the new sort order
            });

            document.querySelector('#draft_title_desc').addEventListener('click', function () {
                draftSortOrder = (draftSortOrder === 'normal' || draftSortOrder === 'titleasc' || draftSortOrder === 'datedesc' || draftSortOrder === 'dateasc') ? 'titledesc' : 'normal';
                searchTerm = $('#draftInput').val(); // Update the searchTerm variable
                localStorage.setItem('draftSortOrder', draftSortOrder);
                loadDraftPage(1, searchTerm, draftSortOrder); // Load the first page with the new sort order
            });

            document.querySelector('#draft_date_asc').addEventListener('click', function () {
                draftSortOrder = (draftSortOrder === 'normal' || draftSortOrder === 'datedesc' || draftSortOrder === 'titledesc' || draftSortOrder === 'titleasc') ? 'dateasc' : 'normal';
                searchTerm = $('#draftInput').val(); // Update the searchTerm variable
                localStorage.setItem('draftSortOrder', draftSortOrder);
                loadDraftPage(1, searchTerm, draftSortOrder); // Load the first page with the new sort order
            });

            document.querySelector('#draft_date_desc').addEventListener('click', function () {
                draftSortOrder = (draftSortOrder === 'normal' || draftSortOrder === 'dateasc' || draftSortOrder === 'titledesc' || draftSortOrder === 'titleasc') ? 'datedesc' : 'normal';
                searchTerm = $('#draftInput').val(); // Update the searchTerm variable
                localStorage.setItem('draftSortOrder', draftSortOrder);
                loadDraftPage(1, searchTerm, draftSortOrder); // Load the first page with the new sort order
            });

            function loadDraftPage(pageNumber, searchTerm, draftSortOrder) {
                $.ajax({
                    url: 'getjoblist/get-draft-job.php',
                    type: 'get',
                    data: {
                        page: pageNumber,
                        draft_sort_order: draftSortOrder, // Pass the title sort order as a parameter
                        draftsearch: searchTerm // Pass the current search term as a parameter
                    },
                    success: function (response) {
                        // Replace your table content with the response
                        $('#draft').html(response);
                    }
                });
            }
        </script>
        <?php
        echo '<table style="background-color: #fff;border-collapse: collapse;width: 100%;">
        <thead>
            <tr>
                <th style="width:100px">
                    <div class="th_title">Status</div>
                </th>
                <th>
                    <div class="th_title">
                        <div>
                            Job
                        </div>
                        <div style="width:10px;"></div>
                        <div style="display:flex;flex-direction:column;justify-content:center">
                            <div>
                                <button class="sorting_asc" id="draft_title_asc">
                                    <svg style="width:10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 15l-6-6-6 6"/></svg>                                    
                                </button>
                            </div>
                            <div>
                                <button class="sorting_desc" id="draft_title_desc">
                                    <svg style="width:10px;" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                                </button>
                            </div>
                        </div>

                        <div style="width:250px"></div>

                        <div style="display:flex;flex-direction:column;justify-content:center">
                            <div>
                                <button class="sorting_asc" id="draft_date_asc">
                                    <svg style="width:10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 15l-6-6-6 6"/></svg>                                    
                                </button>
                            </div>
                            <div>
                                <button class="sorting_desc" id="draft_date_desc">
                                    <svg style="width:10px;" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                                </button>
                            </div>
                        </div>
                        <div style="width:10px;"></div>
                        <div>
                            Created date
                        </div>
                    </div>
                </th>
                <th style="width:120px;">
                    <div class="th_title" style="justify-content:right;">Draft Actions</div>
                </th>
            </tr>
        </thead>';
        // Fetch all the rows
        while ($row = mysqli_fetch_assoc($result)) {

            echo '
                <tbody>
                <tr style="border-top: 4px solid #f5f6f8;height: 80px" >
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
                                            <div style="font-size:16px;line-height:24px;">Created at ' . date('j F Y', strtotime($row['AdStartDate'])) . ' by ' . htmlspecialchars($rowc['ContactPerson']) . ' .</div>
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
                                            <button class="listlink" style="background:none;border:none;" onclick="confirmDeleteDraft(\'' . $row['Job_Post_ID'] . '\')"><svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="e41a2bdd-71ff-4371-9193-37aee43f4338-delete"  role="img">
                                            <title>Delete</title><path d="M10 17c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1zm4 0c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1z"></path><path d="M20 4h-4V3c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v1H4c-.6 0-1 .4-1 1s.4 1 1 1v13c0 1.7 1.3 3 3 3h10c1.7 0 3-1.3 3-3V6c.6 0 1-.4 1-1s-.4-1-1-1zM10 3h4v1h-4V3zm8 16c0 .6-.4 1-1 1H7c-.6 0-1-.4-1-1V6h12v13z"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            </tbody>';
        }
        echo '</table>';
        $sql_total = "SELECT COUNT(*) FROM job_post WHERE CompanyID = $CompanyID AND job_status = 'Draft' AND Job_Post_Title LIKE '%$searchTerm%' AND Job_isDeleted = '0' ORDER BY AdStartDate DESC";
        $rs_result = mysqli_query($connect, $sql_total);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        // Number of pages required. 
        $total_pages = ceil($total_records / $limit);
        $pagLink = "<div class='pagination'>";

        $range = 1; // Range of pages to show around the current page
        $currentPage = $pn; // Current page - you should replace this with the actual current page
    
        for ($i = 1; $i <= $total_pages; $i++) {
            // If total pages are less than 10, show all pages
            if ($total_pages < 10) {
                $pagLink .= "<button class='page-button draft" . ($i == $currentPage ? " current-page" : "") . "' data-page-number='" . $i . "'>" . $i . "</button>";
            } else {
                // Always show the first and last pages
                if ($i == 1 || $i == $total_pages) {
                    $pagLink .= "<button class='page-button draft" . ($i == $currentPage ? " current-page" : "") . "' data-page-number='" . $i . "'>" . $i . "</button>";
                }
                // If the page is in the range of the current page, show it
                else if ($i >= $currentPage - $range && $i <= $currentPage + $range) {
                    $pagLink .= "<button class='page-button draft" . ($i == $currentPage ? " current-page" : "") . "' data-page-number='" . $i . "'>" . $i . "</button>";
                }
                // If the page is just outside the range of the current page, show an ellipsis
                else if ($i == $currentPage - $range - 1 || $i == $currentPage + $range + 1) {
                    $pagLink .= "<span>...</span>";
                }
            }
        }

        echo $pagLink . "</div>";

    } else {
        // No results, check if a search term was provided
        if ($searchTerm != '') {
            // Display a message for no search results
            echo '<div style="padding:32px;">
                    <div style="max-width:660px;width:100%;margin:0 auto;">
                        <div style="padding:24px;background:white;">
                            <div style="text-align:center;padding:24px 0;">
                                <div style="display:flex;flex-direction:column;align-items:center;padding-top:32px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="121" viewBox="0 0 128 121"><title>Empty search icon</title><defs><path id="a" d="M0 0.38516965L127.544 0.38516965 127.544 104.031405 0 104.031405z"></path><path id="c" d="M0.411359385 0.528L5.26323441 0.528 5.26323441 9.73807317 0.411359385 9.73807317z"></path></defs><g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1" transform="translate(-762 -367) translate(762 366)"><g transform="translate(0 9.472)"><mask id="b" fill="#fff"><use xlink:href="#a"></use></mask><path fill="#EAF0FA" d="M125.952 25.15c-6.686-4.4-17.46-6.252-30.366-5.478C83.61 3.27 62.287-4.058 43.587 3.162c-18.7 7.222-28.78 26.675-25.57 46.46C8.151 57.64 1.721 66.137.078 73.753c-.636 2.95 2.736 5.327 5.09 3.568 5.2-3.884 11.414-7.884 18.444-11.856.182-.102.374-.204.557-.307 3.657 19.527 13.737 35.548 32.07 38.41 19.404 3.03 37.285-8.931 43.111-30.802l5.101-3.555c2.036-1.418 2.905-3.922 2.162-6.228-1.834-5.69-5.175-16.177-6.427-20.895l-.147.255a42.667 42.667 0 00-2.073-6.323 242.89 242.89 0 015.03-1.205c7.937-1.81 15.31-3.054 21.863-3.708 2.968-.297 3.682-4.251 1.093-5.955" mask="url(#b)"></path></g><path stroke="#FFF" stroke-linecap="round" stroke-width="2" d="M43.516 12.377c-2.532 2.559-5.038 12.17-2.354 21.185M42.866 11.615c8.641-.044 23.172 8.607 27.435 19.625"></path><g transform="translate(43 .472)"><mask id="d" fill="#fff"><use xlink:href="#c"></use></mask><path fill="#EAF0FA" d="M1.691 9.645C-.347 10.818-.09.528 3.473.528c3.565 0 1.19 7.408-1.782 9.117" mask="url(#d)"></path></g><path fill="#EAF0FA" d="M41.709 10.677c2.16-.26-1.195-5.848-4.35-4.255-3.154 1.592 1.202 4.635 4.35 4.255"></path><path fill="#031D44" d="M89.426 65.262a2.115 2.115 0 11-4.23 0 2.115 2.115 0 014.23 0"></path><path stroke="#031D44" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M51.954 118.09a56.621 56.621 0 006.298 2.235 3.637 3.637 0 002.039-6.98l3.76 1.098a3.636 3.636 0 002.038-6.981l4.296 1.255a3.636 3.636 0 002.04-6.981L53.36 96.168l10.568-3.771"></path><path stroke="#031D44" stroke-linecap="round" stroke-width="2" d="M113.04 65.262c0 14.21-11.52 25.73-25.73 25.73-14.209 0-25.729-11.52-25.729-25.73 0-14.209 11.52-25.729 25.73-25.729 14.208 0 25.728 11.52 25.728 25.73z"></path><path stroke="#031D44" stroke-linecap="round" stroke-width="2" d="M68.943 100.181L75.013 88.538"></path><path stroke="#FFF" stroke-linecap="round" stroke-width="2" d="M84.556 96.967c-1.377 2.755-3.673 4.133-3.673 4.133"></path></g></svg></div>
                                <div style="display:flex;flex-direction:column;align-items:center;padding-top:32px;"><h2 class="landing_sentence3">0 search results for "' . htmlspecialchars($searchTerm) . '"</h2></div>
                            </div>
                        </div>
                    </div>
                </div>';
        } else {
            // Display a message for no jobs
            echo '<div style="padding:32px;">
                    <div style="max-width:660px;width:100%;margin:0 auto;">
                        <div style="padding:24px;background:white;">
                            <div style="text-align:center;padding:24px 0;">
                                <div style="display:flex;flex-direction:column;align-items:center;padding-top:10px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="140" height="120" viewBox="0 0 140 120"><title>Profile icon</title><defs><path id="a" d="M0 0.38516965L127.544 0.38516965 127.544 104.031405 0 104.031405z"></path><path id="c" d="M0.411359385 0.528L5.26323441 0.528 5.26323441 9.73807317 0.411359385 9.73807317z"></path></defs><g fill="none" fill-rule="evenodd"><path fill="#EAF0FA" d="M95.5774415,120 C103.525557,120 110.029288,113.408 110.029288,105.351 L110.029288,14.649 C110.029288,6.592 103.525557,0 95.5774415,0 L14.4518469,0 C6.50273094,0 0,6.592 0,14.649 L0,105.351 C0,113.408 6.50273094,120 14.4518469,120 L95.5774415,120 Z"></path><line x1="21.397" x2="70.595" y1="84.302" y2="84.302" stroke="#FFF" stroke-linecap="round" stroke-width="2"></line><line x1="21.397" x2="71.223" y1="91.747" y2="91.747" stroke="#FFF" stroke-linecap="round" stroke-width="2"></line><path fill="#FFF" d="M58.3214244,51.5234 C58.3214244,55.9234 54.7194656,59.5234 50.3192943,59.5234 L28.9556076,59.5234 C24.5534358,59.5234 20.9534775,55.9234 20.9534775,51.5234 L20.9534775,29.6284 C20.9534775,25.2284 24.5534358,21.6284 28.9556076,21.6284 L50.3192943,21.6284 C54.7194656,21.6284 58.3214244,25.2284 58.3214244,29.6284 L58.3214244,51.5234 Z"></path><path stroke="#031D44" stroke-linecap="round" stroke-width="2" d="M46.4051525 37.1264C46.4051525 40.9174 43.086269 45.1384 39.6363507 45.1384 36.2174406 45.1384 32.8685492 40.9174 32.8685492 37.1264 32.8685492 33.3354 35.8983557 30.2624 39.6363507 30.2624 43.375346 30.2624 46.4051525 33.3354 46.4051525 37.1264zM52.6890251 58.1635C52.3809431 54.2335 50.0843318 50.9765 47.0055123 50.2635 44.6388823 49.7145 41.9221591 49.2355 39.6545555 49.2355 37.2659197 49.2355 34.592208 49.6925 32.2885948 50.2265 28.9827148 50.9915 26.5850766 54.7065 26.5850766 59.0235L26.5850766 64.3595"></path><line x1="21.397" x2="50.462" y1="99.077" y2="99.077" stroke="#FFF" stroke-linecap="round" stroke-width="2"></line><path stroke="#031D44" stroke-linecap="round" stroke-width="2" d="M71.9031397,71.924 L56.5140433,56.708 C62.5786576,50.7 66.3336572,42.367 66.3336572,33.158 C66.3336572,14.845 51.4847046,0 33.1668286,0 C14.8499529,0 0,14.845 0,33.158 C0,51.47 14.8499529,66.316 33.1668286,66.316 C39.085404,66.316 44.6418831,64.766 49.4521635,62.05" transform="translate(67.097 24.038)"></path></g></svg></div>
                                <div style="display:flex;flex-direction:column;align-items:center;padding-top:10px;"><h2 class="landing_sentence1">You have no drafts to edit</h2></div>
                                <div style="display:flex;flex-direction:column;align-items:center;padding-top:10px;"><span class="joblisttitle">Create your job ad now</span></div>
                                <div style="display:flex;flex-direction:column;align-items:center;padding-top:10px;"><a href="post-job-classify.php" class="continue_job_link">Create a job ad</a></div>
                            </div>
                        </div>
                    </div>
                </div>';
        }
    }
    ?>

</div>

<script>
    // Get the elements
    var cleardraft = document.getElementById('cleardraft');
    var draftInput = document.getElementById('draftInput');

    // Hide the clear button initially
    cleardraft.style.display = 'none';

    // Function to show/hide the clear button
    function toggledraftClearButton() {
        if (draftInput.value.trim() !== '') {
            cleardraft.style.display = 'flex';
        } else {
            cleardraft.style.display = 'none';
        }
    }

    // Call the function initially to set the correct display
    toggledraftClearButton();

    draftInput.addEventListener('input', toggledraftClearButton);

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

    $(document).ready(function () {
        $('#draftForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the form from being submitted normally

            searchTerm = $('#draftInput').val();

            // Pass the search term to a function
            loadDraftPage(1, searchTerm);
        });
    });

</script>

<?php
// Free the result set and close the connection
mysqli_free_result($result);
mysqli_close($connect);
?>