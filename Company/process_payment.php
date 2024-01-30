<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_POST['CompanyID'])) {
    $CompanyID = $_POST['CompanyID'];
    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['job_post_ID'])) {
    $job_post_ID = $_POST['job_post_ID'];
}

$CompanyName = $row['CompanyName'];
$CompanyPhone = $row['CompanyPhone'];
$ContactPerson = $row['ContactPerson'];
$totalPrice = $_POST['totalPrice'];
$postDuration = $_POST['postDuration'];

if (isset($_POST['payment_type']) && $_POST['payment_type'] == 'existcardRadio') {
    $selectedCard = $_POST['cardSelect'];

    $sql = "SELECT * FROM credit_card WHERE CreditCardID = $selectedCard";
    $result = mysqli_query($connect, $sql);
    $cardDetails = mysqli_fetch_assoc($result);

    // Now you can use the details of the selected card
    $cardType = $cardDetails['CreditCard_Type'];
    $cardNumber = $cardDetails['CreditCard_Number'];
    $cardName = $cardDetails['CreditCard_Holder'];
    $cardMonth = $cardDetails['CreditCard_ExpMonth'];
    $cardYear = $cardDetails['CreditCard_ExpYear'];
    $cardCvv = $cardDetails['CreditCard_CVV'];

    // Insert the details into the payment table
    $sql = "INSERT INTO payment (CompanyID, CompanyName, CompanyPhone, ContactPerson, CreditCard_Type, CreditCard_Number, CreditCard_Holder, CreditCard_ExpMonth, CreditCard_ExpYear, CreditCard_CVV, JobID, Payment_Duration, Payment_Amount) VALUES ('$CompanyID', '$CompanyName', '$CompanyPhone', '$ContactPerson', '$cardType', '$cardNumber', '$cardName', '$cardMonth', '$cardYear', '$cardCvv', '$job_post_ID', '$postDuration', '$totalPrice')";
    $result = mysqli_query($connect, $sql);


} else if (isset($_POST['payment_type']) && $_POST['payment_type'] == 'newcardRadio') {
    $cardNumber = $_POST['cardNumberInput'];
    $cardName = $_POST['cardNameInput'];
    $cardType = $_POST['cardTypeInput'];
    $cardMonth = $_POST['cardMonthInput'];
    $cardYear = $_POST['cardYearInput'];
    $cardCvv = $_POST['cardCvvInput'];
    // Now you can use these variables
    $sql = "INSERT INTO credit_card (CompanyID, CreditCard_Type, CreditCard_Number, CreditCard_Holder, CreditCard_ExpMonth, CreditCard_ExpYear, CreditCard_CVV) VALUES ('$CompanyID', '$cardType', '$cardNumber', '$cardName', '$cardMonth', '$cardYear', '$cardCvv')";
    $result = mysqli_query($connect, $sql);

    $sql = "INSERT INTO payment (CompanyID, CompanyName, CompanyPhone, ContactPerson, CreditCard_Type, CreditCard_Number, CreditCard_Holder, CreditCard_ExpMonth, CreditCard_ExpYear, CreditCard_CVV, JobID, Payment_Duration, Payment_Amount) VALUES ('$CompanyID', '$CompanyName', '$CompanyPhone', '$ContactPerson', '$cardType', '$cardNumber', '$cardName', '$cardMonth', '$cardYear', '$cardCvv', '$job_post_ID', '$postDuration', '$totalPrice')";
    $result = mysqli_query($connect, $sql);

}

if ($result) {
    echo 'success';
} else {
    echo 'error';
}


?>