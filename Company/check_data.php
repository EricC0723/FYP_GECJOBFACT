<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");

if (isset($_POST['email'])) {
  $email = $_POST['email'];

  $stmt = $connect->prepare("SELECT CompanyEmail FROM companies WHERE CompanyEmail=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo 1;
  } else {
    echo 0;
  }
  $stmt->close();
}

if (isset($_POST['cardnum'])) {
  $cardnum = $_POST['cardnum'];

  $stmt = $connect->prepare("SELECT CompanyEmail FROM companies WHERE CompanyEmail=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo 1;
  } else {
    echo 0;
  }
  $stmt->close();
}

if (isset($_POST['phone'])) {
  $phone = $_POST['phone'];

  $stmt = $connect->prepare("SELECT CompanyPhone FROM companies WHERE CompanyPhone=?");
  $stmt->bind_param("s", $phone);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo 1;
  } else {
    echo 0;
  }
  $stmt->close();
}

if (isset($_POST['registrationNo'])) {
  $registrationNo = $_POST['registrationNo'];

  $stmt = $connect->prepare("SELECT RegistrationNo FROM companies WHERE RegistrationNo=?");
  $stmt->bind_param("s", $registrationNo);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo 1;
  } else {
    echo 0;
  }
  $stmt->close();
}

if (isset($_POST['cardNumber']) && isset($_POST['companyId'])) {
  $cardNumber = $_POST['cardNumber'];
  $companyId = $_POST['companyId'];

  // Connect to the database
  // $conn = new mysqli($servername, $username, $password, $dbname);
  $stmt = $connect->prepare("SELECT * FROM credit_card WHERE CreditCard_Number = ? AND CompanyID = ?");
  $stmt->bind_param("si", $cardNumber, $companyId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo 1;
  } else {
    echo 0;
  }

  $stmt->close();
  # code...
}

if (isset($_POST['cardNumber']) && isset($_POST['companyId']) && isset($_POST['originalCardNumber'])) {
  $cardNumber = $_POST['cardNumber'];
  $originalCardNumber = $_POST['originalCardNumber'];
  $companyId = $_POST['companyId'];

  // If the new card number is different from the original card number
  if ($cardNumber !== $originalCardNumber) {
    // Prepare a SQL statement to check if the new card number exists for the company
    $stmt = $connect->prepare("SELECT * FROM credit_card WHERE CreditCard_Number = ? AND CompanyID = ?");
    $stmt->bind_param("si", $cardNumber, $companyId);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the new card number exists for the company, return 1
    if ($result->num_rows > 0) {
      echo 1;
    } else {
      // If the new card number does not exist for the company, return 0
      echo 0;
    }
  } else {
    // If the new card number is the same as the original card number, return 0
    echo 0;
  }

  $stmt->close();
  # code...
}
?>