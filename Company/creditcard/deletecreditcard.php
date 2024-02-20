<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_GET['id'])) {
    $creditcardID = $_GET['id'];

    // Prepare the SQL statement
    $sql = "DELETE FROM credit_card WHERE CreditCardID = $creditcardID";

    // Execute the SQL statement
    if (mysqli_query($connect, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
}

?>
