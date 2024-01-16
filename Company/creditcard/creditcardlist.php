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
    <div style="width: 110px;position: relative;top: 25px;left: 25px;"><button id="add-creditcard-button"
            class="employee_sentence"
            style="height: 28px;display: flex;align-items: center;border:none;background:none;cursor:pointer">Add
            new card</button>
    </div>
    <div class="wrapper">
        <div style="padding: 0 30px 30px 30px;width:100%;">
            <?php

            $sql = "SELECT * FROM credit_card WHERE CompanyID = $CompanyID";
            $result = mysqli_query($connect, $sql);

            echo "<table style='width:100%;'>";
            $counter = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                if ($counter % 2 == 0) {
                    echo "<tr>";
                }

                echo '<td style="padding:20px;border:1px solid #838fa5;position:relative;"><div>
                        <button class="listlink" onclick="editCreditCard(this)" id="editcreditcardbtn" style="background:none;border:none;position:absolute;right:15px;cursor:pointer" data-id="' . htmlspecialchars($row['CreditCardID']) . '">
                        <svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor"  aria-labelledby="b33ee29c-5454-4dc1-a348-be2854231b73-edit"  role="img"><title>Edit</title><path d="M20.7 4.1c-1.4-1.4-4-1.4-5.4 0l-11 11c-.1.1-.2.3-.3.5l-1 5c-.1.3 0 .7.3.9.2.2.4.3.7.3h.2l5-1c.2 0 .4-.1.5-.3l11-11c1.5-1.5 1.5-3.9 0-5.4zM8.5 18.9l-3.2.6.6-3.2 8.6-8.6 2.6 2.6-8.6 8.6zM19.3 8.1l-.8.8-2.6-2.6.8-.8c.7-.7 1.9-.7 2.6 0 .7.7.7 1.9 0 2.6z"></path></svg>
                        </button>
                    <span class="landing_sentence2">Card Number: ' . htmlspecialchars($row['CreditCard_Number']) . '</span><br>
                    <span class="landing_sentence2">Card Holder: ' . htmlspecialchars($row['CreditCard_Holder']) . '</span><br>
                    <span class="landing_sentence2">Card Type: ' . htmlspecialchars($row['CreditCard_Type']) . '</span><br>
                    <span class="landing_sentence2">Card Expire Date: ' . htmlspecialchars($row['CreditCard_ExpMonth']) . '/ ' . htmlspecialchars($row['CreditCard_ExpYear']) . '</span><br>
                    <span class="landing_sentence2">Card CVV: ' . htmlspecialchars($row['CreditCard_CVV']) . '</span><br></div>
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
            ?>
        </div>
    </div>
</div>




<script src="post-job.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    
// Select the add button
var addButton = document.getElementById('add-creditcard-button'); // replace 'add-button-id' with your actual button id

// Add click event listener to the add button
addButton.addEventListener('click', function () {
    // Load the addcreditcard.php file into the addcreditcard div
    $('#creditcard').load('creditcard/addcreditcard.php');
});

function editCreditCard(button) {
    // Get the credit card ID from the data attribute
    var id = button.getAttribute('data-id'); // make sure your button has a 'data-id' attribute

    // Load the editcreditcard.php file into the editcreditcard div
    $('#creditcard').load('creditcard/editcreditcard.php?id=' + id);
}


    
</script>