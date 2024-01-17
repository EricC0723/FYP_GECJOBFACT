<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_GET['id'])) {
    $creditcardID = $_GET['id'];

    // Prepare the SQL statement
    $sql = "UPDATE credit_card SET Card_isDeleted = '1' WHERE CreditCardID = $creditcardID";

    // Execute the SQL statement
    if (mysqli_query($connect, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
}

?>
