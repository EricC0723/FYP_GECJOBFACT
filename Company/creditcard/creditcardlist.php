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

<div id="creditcardlist">
    <div style="width: 110px;position: relative;top: 25px;left: 25px;"><button id="add-creditcard-button1"
            class="employee_sentence"
            style="height: 28px;display: flex;align-items: center;border:none;background:none;cursor:pointer">Add
            new card</button>
    </div>
    <div class="wrapper">
        <div style="padding: 0 30px 30px 30px;width:100%;">
            <?php


            $limit = 10; // Number of entries to show in a page.
            // Look for a GET variable page if not found default is 1.  
            if (isset($_GET["page"])) {
                $pn = $_GET["page"];
            } else {
                $pn = 1;
            }
            ;

            $start_from = ($pn - 1) * $limit;


            $sql = "SELECT * FROM credit_card WHERE CompanyID = $CompanyID AND CreditCard_isDeleted = 0 ORDER BY CreditCardID DESC LIMIT $start_from, $limit";
            $result = mysqli_query($connect, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Existing code...
                if(mysqli_num_rows($result) > 1)
                {
                    echo "<table style='width:100%;'>";
                }
                else
                {
                    echo "<table style='width:100%;max-width:50%'>";
                }
                $counter = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    if ($counter % 2 == 0) {
                        echo "<tr>";
                    }

                    if ($row['CreditCard_Type'] == 'amex') {
                        $imgSrc = "/FYP/Company/creditcardimg/amex.png";
                    } elseif ($row['CreditCard_Type'] == 'discover') {
                        $imgSrc = "/FYP/Company/creditcardimg/discover.png";
                    } elseif ($row['CreditCard_Type'] == 'mastercard') {
                        $imgSrc = "/FYP/Company/creditcardimg/mastercard.png";
                    } elseif ($row['CreditCard_Type'] == 'troy') {
                        $imgSrc = "/FYP/Company/creditcardimg/troy.png";
                    } elseif ($row['CreditCard_Type'] == 'visa') {
                        $imgSrc = "/FYP/Company/creditcardimg/visa.png";
                    }

                    $cardNumber = htmlspecialchars($row['CreditCard_Number']);
                    $maskedNumber = '';

                    if (strlen(str_replace(' ', '', $cardNumber)) == 15) {
                        // For cards with format "3411 111111 11111"
                        $maskedNumber = substr_replace($cardNumber, '****** **', 5, 9);
                    } else {
                        // For cards with format "6011 1111 1111 1111"
                        $maskedNumber = substr_replace($cardNumber, '**** **** ', 5, 9);
                    }

                    echo '<td style="padding:20px;border:0.5px solid #d2d7df; ">
                        <div style="border: 1px solid #d2d7df;border-radius:15px;padding:20px;position:relative;box-shadow: -5px 5px 10px rgba(0, 0, 0, 0.1);display:flex;flex-direction:column;">
                            <button class="listlink" onclick="editCreditCard(this)" id="editcreditcardbtn" style="background:none;border:none;position:absolute;right:50px;cursor:pointer" data-id="' . htmlspecialchars($row['CreditCardID']) . '">
                            <svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="b33ee29c-5454-4dc1-a348-be2854231b73-edit"  role="img"><title>Edit</title><path d="M20.7 4.1c-1.4-1.4-4-1.4-5.4 0l-11 11c-.1.1-.2.3-.3.5l-1 5c-.1.3 0 .7.3.9.2.2.4.3.7.3h.2l5-1c.2 0 .4-.1.5-.3l11-11c1.5-1.5 1.5-3.9 0-5.4zM8.5 18.9l-3.2.6.6-3.2 8.6-8.6 2.6 2.6-8.6 8.6zM19.3 8.1l-.8.8-2.6-2.6.8-.8c.7-.7 1.9-.7 2.6 0 .7.7.7 1.9 0 2.6z"></path></svg>
                            </button>
                            <button class="listlink" id="deletecreditcardbtn" style="background:none;border:none;position:absolute;right:15px;cursor:pointer" onclick="deleteCreditCard(this)" data-id="' . htmlspecialchars($row['CreditCardID']) . '"><svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="e41a2bdd-71ff-4371-9193-37aee43f4338-delete"  role="img">
                            <title>Delete</title><path d="M10 17c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1zm4 0c.6 0 1-.4 1-1v-6c0-.6-.4-1-1-1s-1 .4-1 1v6c0 .6.4 1 1 1z"></path><path d="M20 4h-4V3c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v1H4c-.6 0-1 .4-1 1s.4 1 1 1v13c0 1.7 1.3 3 3 3h10c1.7 0 3-1.3 3-3V6c.6 0 1-.4 1-1s-.4-1-1-1zM10 3h4v1h-4V3zm8 16c0 .6-.4 1-1 1H7c-.6 0-1-.4-1-1V6h12v13z"></path></svg>
                            </button>
                            <div style="width:80px;"><img src="' . $imgSrc . '" style="width:100%"></div>
                            <div style="display:flex;flex-direction:row;justify-content:space-between;align-items:flex-end;">   
                                <span class="landing_sentence3" style="font-weight:400">' . $maskedNumber . '</span>
                            </div> 
                            <div style="height:50px;"></div>
                            <div style="display:flex;flex-direction:row;justify-content:space-between">
                                <div style="display:flex;flex-direction:column">
                                    <span class="landing_sentence2">Card Holder</span>
                                    <span class="landing_sentence1" style="font-weight:400">' . htmlspecialchars($row['CreditCard_Holder']) . '</span>
                                </div>
                                <div style="display:flex;flex-direction:column">
                                    <span class="landing_sentence2">Expires</span>
                                    <span class="landing_sentence1" style="font-weight:400">' . htmlspecialchars($row['CreditCard_ExpMonth']) . ' / ' . htmlspecialchars($row['CreditCard_ExpYear']) . '</span>
                                </div>
                            </div>
                    </div>
                    </td>';

                    if ($counter % 2 != 0) {
                        echo "</tr>";
                    }

                    $counter++;
                }

                if ($counter % 2 != 0) {
                    echo "</tr>";
                }

                echo "</table>";

                $sql_total = "SELECT COUNT(*) FROM credit_card WHERE CompanyID = $CompanyID AND CreditCard_isDeleted = 0 ORDER BY CreditCardID DESC";
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
                        $pagLink .= "<button class='page-button card" . ($i == $currentPage ? " current-page" : "") . "' data-page-number='" . $i . "'>" . $i . "</button>";
                    } else {
                        // Always show the first and last pages
                        if ($i == 1 || $i == $total_pages) {
                            $pagLink .= "<button class='page-button card" . ($i == $currentPage ? " current-page" : "") . "' data-page-number='" . $i . "'>" . $i . "</button>";
                        }
                        // If the page is in the range of the current page, show it
                        else if ($i >= $currentPage - $range && $i <= $currentPage + $range) {
                            $pagLink .= "<button class='page-button card" . ($i == $currentPage ? " current-page" : "") . "' data-page-number='" . $i . "'>" . $i . "</button>";
                        }
                        // If the page is just outside the range of the current page, show an ellipsis
                        else if ($i == $currentPage - $range - 1 || $i == $currentPage + $range + 1) {
                            $pagLink .= "<span>...</span>";
                        }
                    }
                }

                echo $pagLink . "</div>";
            } else {
                // Display a message for no jobs
                echo '<div style="padding:32px;">
                        <div style="max-width:660px;width:100%;margin:0 auto;">
                            <div style="padding:24px;background:white;">
                                <div style="text-align:center;padding:24px 0;">
                                    <div style="display:flex;flex-direction:column;align-items:center;padding-top:10px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="140" height="120" viewBox="0 0 140 120"><title>Profile icon</title><defs><path id="a" d="M0 0.38516965L127.544 0.38516965 127.544 104.031405 0 104.031405z"></path><path id="c" d="M0.411359385 0.528L5.26323441 0.528 5.26323441 9.73807317 0.411359385 9.73807317z"></path></defs><g fill="none" fill-rule="evenodd"><path fill="#EAF0FA" d="M95.5774415,120 C103.525557,120 110.029288,113.408 110.029288,105.351 L110.029288,14.649 C110.029288,6.592 103.525557,0 95.5774415,0 L14.4518469,0 C6.50273094,0 0,6.592 0,14.649 L0,105.351 C0,113.408 6.50273094,120 14.4518469,120 L95.5774415,120 Z"></path><line x1="21.397" x2="70.595" y1="84.302" y2="84.302" stroke="#FFF" stroke-linecap="round" stroke-width="2"></line><line x1="21.397" x2="71.223" y1="91.747" y2="91.747" stroke="#FFF" stroke-linecap="round" stroke-width="2"></line><path fill="#FFF" d="M58.3214244,51.5234 C58.3214244,55.9234 54.7194656,59.5234 50.3192943,59.5234 L28.9556076,59.5234 C24.5534358,59.5234 20.9534775,55.9234 20.9534775,51.5234 L20.9534775,29.6284 C20.9534775,25.2284 24.5534358,21.6284 28.9556076,21.6284 L50.3192943,21.6284 C54.7194656,21.6284 58.3214244,25.2284 58.3214244,29.6284 L58.3214244,51.5234 Z"></path><path stroke="#031D44" stroke-linecap="round" stroke-width="2" d="M46.4051525 37.1264C46.4051525 40.9174 43.086269 45.1384 39.6363507 45.1384 36.2174406 45.1384 32.8685492 40.9174 32.8685492 37.1264 32.8685492 33.3354 35.8983557 30.2624 39.6363507 30.2624 43.375346 30.2624 46.4051525 33.3354 46.4051525 37.1264zM52.6890251 58.1635C52.3809431 54.2335 50.0843318 50.9765 47.0055123 50.2635 44.6388823 49.7145 41.9221591 49.2355 39.6545555 49.2355 37.2659197 49.2355 34.592208 49.6925 32.2885948 50.2265 28.9827148 50.9915 26.5850766 54.7065 26.5850766 59.0235L26.5850766 64.3595"></path><line x1="21.397" x2="50.462" y1="99.077" y2="99.077" stroke="#FFF" stroke-linecap="round" stroke-width="2"></line><path stroke="#031D44" stroke-linecap="round" stroke-width="2" d="M71.9031397,71.924 L56.5140433,56.708 C62.5786576,50.7 66.3336572,42.367 66.3336572,33.158 C66.3336572,14.845 51.4847046,0 33.1668286,0 C14.8499529,0 0,14.845 0,33.158 C0,51.47 14.8499529,66.316 33.1668286,66.316 C39.085404,66.316 44.6418831,64.766 49.4521635,62.05" transform="translate(67.097 24.038)"></path></g></svg></div>
                                    <div style="display:flex;flex-direction:column;align-items:center;padding-top:10px;"><h2 class="landing_sentence1">This account has no exists cards.</h2></div>
                                    <div style="display:flex;flex-direction:column;align-items:center;padding-top:10px;"><span class="landing_sentence2" style="color:#5a6881;">Add your card now</span></div>
                                    <div style="display:flex;flex-direction:column;align-items:center;padding-top:10px;">
                                    <button id="add-creditcard-button2" class="continue_job_link" style="background:none;cursor:pointer;">Add a new card</button></div>
                                </div>
                            </div>
                        </div>
                        </div>';
            }
            ?>

        </div>
    </div>
</div>




<script src="post-job.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="company_creditcard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).off('click', '.page-button.card').on('click', '.page-button.card', function (e) {
        e.preventDefault();
        var pageNumber = $(this).data('page-number'); // Get the page number from the data attribute
        loadCardPage(pageNumber);
    });

    function loadCardPage(pageNumber) {
        $.ajax({
            url: 'creditcard/creditcardlist.php',
            type: 'get',
            data: {
                page: pageNumber
            },
            success: function (response) {
                // Replace your table content with the response
                $('#creditcard').html(response);
            }
        });
    }
    
    // Select the add buttons
    var addButton1 = document.getElementById('add-creditcard-button1');
    var addButton2 = document.getElementById('add-creditcard-button2');

    // Function to load addcreditcard.php
    function loadAddCreditCard() {
        $('#creditcard').load('creditcard/addcreditcard.php');
    }

    // Add click event listener to the add buttons
    addButton1.addEventListener('click', loadAddCreditCard);
    addButton2.addEventListener('click', loadAddCreditCard);

    function editCreditCard(button) {
        // Get the credit card ID from the data attribute
        var id = button.getAttribute('data-id'); // make sure your button has a 'data-id' attribute

        // Load the editcreditcard.php file into the editcreditcard div
        $('#creditcard').load('creditcard/editcreditcard.php?id=' + id);
    }
</script>