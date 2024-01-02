<?php
include("dataconnection.php");

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $stmt = $connect->prepare("SELECT CompanyEmail FROM companies WHERE CompanyEmail=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
      echo 1;
    }else{
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

    if($result->num_rows > 0){
      echo 1;
    }else{
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

  if($result->num_rows > 0){
    echo 1;
  }else{
    echo 0;
  }
  $stmt->close();
}
?>