<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
require('C:/xampp/htdocs/FYP/Company/fpdf.php');
require 'vendor/autoload.php'; // Add this line to include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['CompanyID'])) {
  $CompanyID = $_POST['CompanyID'];
  $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['job_post_ID'])) {
  $job_post_ID = $_POST['job_post_ID'];
  $sql = "SELECT * FROM job_post WHERE Job_Post_ID = $job_post_ID";
  $result = mysqli_query($connect, $sql);
  $rowj = mysqli_fetch_assoc($result);
}

$CompanyName = $row['CompanyName'];
$CompanyEmail = $row['CompanyEmail'];
$CompanyPhone = $row['CompanyPhone'];
$ContactPerson = $row['ContactPerson'];
$totalPrice = $_POST['totalPrice'];
$postDuration = $_POST['postDuration'];
$JobTitle = $rowj['Job_Post_Title'];
$paymentId = '';
$cardNumber = '';


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
  $paymentId = mysqli_insert_id($connect);
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
  $paymentId = mysqli_insert_id($connect);
}


// Get the current date and time
$AdStartDate = date('Y-m-d H:i:s');

// Calculate the AdEndDate based on the postDuration
$AdEndDate = date('Y-m-d H:i:s', strtotime("+$postDuration months", strtotime($AdStartDate)));

// Prepare the SQL query
$sql = "UPDATE job_post SET job_status = 'Active', AdStartDate = '$AdStartDate', AdEndDate = '$AdEndDate' WHERE Job_Post_ID = '$job_post_ID'";

// Execute the query
$result = mysqli_query($connect, $sql);

if ($result) {

  $pdf = new FPDF('P', 'mm', 'A4');
  $pdf->SetMargins(10, 10, 10);

  $pdf->AddPage();
  // Insert an image
  $imagePath = 'logo.png'; // Replace with the path to your image
  $imageWidth = 50; // The width of the image
  $imageX = (210 / 2) - ($imageWidth / 2); // 210 is the width of an A4 page in mm
  $pdf->Image($imagePath, $imageX, 10, $imageWidth); // The image will be centered and the height will be calculated automatically

  // Add a line of text under the image
  $pdf->SetXY(-200, 40); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', 'B', 24); // Set font to Arial, Bold, 12 pt
  $pdf->Cell(0, 0, 'INVOICE', 0, 0, 'C'); // Right-aligned text

  // Add a line of text under the image
  $pdf->SetXY(10, 50); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', 'B', 16); // Set font to Arial, Bold, 24 pt
  $pdf->Cell(95, 10, $CompanyName, 0, 0, 'L'); // Left-aligned text
  $pdf->SetXY(10, 60); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', '', 12); // Set font to Arial, Bold, 24 pt
  $pdf->Cell(95, 10, 'Date Issued: ', 0, 0, 'L'); // Left-aligned text
  $pdf->SetXY(35, 60); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', 'B', 12); // Set font to Arial, Bold, 24 pt
  $AdStartDateFormatted = date('d M Y h:i:s A', strtotime($AdStartDate));
  $pdf->Cell(95, 10, $AdStartDateFormatted, 0, 0, 'L'); // Left-aligned text
  $pdf->SetXY(10, 70); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', '', 12); // Set font to Arial, Bold, 24 pt
  $pdf->Cell(95, 10, 'Email  : ', 0, 0, 'L'); // Left-aligned text
  $pdf->SetXY(35, 70); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', 'B', 12); // Set font to Arial, Bold, 24 pt
  $pdf->Cell(95, 10, $CompanyEmail, 0, 0, 'L'); // Left-aligned text
  $pdf->SetXY(10, 80); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', '', 12); // Set font to Arial, Bold, 24 pt
  $pdf->Cell(95, 10, 'Duration  : ', 0, 0, 'L'); // Left-aligned text
  $AdStartDateFormatted = date('d M Y h:i:s A', strtotime($AdStartDate));
  $AdEndDateFormatted = date('d M Y h:i:s A', strtotime($AdEndDate));
  $startDateRange = $AdStartDateFormatted . ' - ';
  $endDateRange = '                      ' . $AdEndDateFormatted;
  $pdf->SetXY(35, 80); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', 'B', 12); // Set font to Arial, Bold, 24 pt
  $pdf->Cell(95, 10, $startDateRange, 0, 1, 'L'); // Left-aligned text
  $pdf->Cell(95, 10, $endDateRange, 0, 0, 'L'); // Left-aligned text

  $pdf->SetXY(105, 50); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', '', 12); // Set font to Arial, Bold, 24 pt
  $pdf->Cell(95, 10, 'GEC JOB FACT', 0, 0, 'R'); // Right-aligned text
  $pdf->SetXY(105, 60); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', '', 12); // Set font to Arial, Bold, 24 pt
  $pdf->Cell(95, 10, 'Jalan Ayer Keroh Lama', 0, 0, 'R'); // Right-aligned text
  $pdf->SetXY(105, 70); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', '', 12); // Set font to Arial, Bold, 24 pt
  $pdf->Cell(95, 10, 'Bukit Beruang', 0, 0, 'R'); // Right-aligned text
  $pdf->SetXY(105, 80); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', '', 12); // Set font to Arial, Bold, 24 pt
  $pdf->Cell(95, 10, '75450, Melaka', 0, 0, 'R'); // Right-aligned text

  $pdf->SetXY(10, 110); // Position at 1 cm from bottom
  $pdf->SetFont('Arial', '', 12); // Set font to Arial, Bold, 12 pt

  $pdf->SetFillColor(234, 234, 234);

  // Header
  $padding = 10; // Padding in mm
  $pdf->Cell(5, 10, '', 0, 0, '', true); // Left padding
  $pdf->Cell(42, 10, 'Description', 0, 0, 'L', true); // Header for the Item column

  $pdf->Cell($padding, 10, '', 0, 0, '', true); // Left padding
  $pdf->Cell(37, 10, 'Price(per month)', 0, 0, 'L', true); // Header for the Description column

  $pdf->Cell($padding, 10, '', 0, 0, '', true); // Left padding
  $pdf->Cell(24, 10, 'Quantity', 0, 0, 'L', true); // Header for the Quantity column

  $pdf->Cell($padding, 10, '', 0, 0, '', true); // Left padding
  $pdf->Cell(52, 10, 'SubTotal', 0, 1, 'L', true); // Header for the Price column
  $pdf->SetFont('Arial', '', 12); // Set font to Arial, regular, 12 pt

  // Add some space before the data
  $pdf->Cell(0, 5, '', 0, 1);

  // Save the current position
  $x = $pdf->GetX();
  $y = $pdf->GetY();
  $cellWidth = 42; // Cell width
  $cellHeight = 5; // Cell height

  // Data
  $padding = 10; // Padding in mm
  $pdf->Cell(5, 5, '', 0, 0); // Left padding
  $pdf->SetFillColor(255, 255, 255); // Set the fill color to white
  $pdf->MultiCell($cellWidth, $cellHeight, $JobTitle, 0, 'L', true); // Data for the Item column

  // Calculate the height of the blank cell
  $blankCellHeight = 70 - $cellHeight;

  // Make sure the blank cell height is not less than 0
  $blankCellHeight = max($blankCellHeight, 0);

  // Save the current Y position
  $ly = $pdf->GetY();

  // Restore the position
  $pdf->SetXY($x + 47, $y);

  $pdf->Cell($padding, 5, '', 0, 0); // Left padding
  $pdf->Cell(37, 5, 'RM 98.00', 0, 0, 'L'); // Data for the Description column

  $pdf->Cell($padding, 5, '', 0, 0); // Left padding
  $pdf->Cell(24, 5, $postDuration, 0, 0, 'L'); // Data for the Quantity column

  $pdf->SetFont('Arial', 'B', 12); // Set font to Arial, Bold, 12 pt
  $pdf->Cell($padding, 5, '', 0, 0); // Left padding
  $subtotal = $postDuration * 98.00; // Calculate the price
  $formattedSubtotal = 'RM ' . number_format($subtotal, 2); // Format the Subtotal
  $pdf->Cell(52, 5, $formattedSubtotal, 0, 1, 'L'); // Data for the Price column

  // Move the cursor to the next line
  $pdf->SetY($ly);

  $pdf->Ln(1); // Move up by 1mm
  $pdf->SetDrawColor(234, 234, 234); // RGB color
  $pdf->Cell(190, 0.01, '', 1, 1); // Create a cell with a height of 0.2mm and a width of 190mm

  $pdf->SetFont('Arial', '', 12); // Set font to Arial, Bold, 12 pt
  $pdf->Cell(0, $blankCellHeight, '', 0, 1);

  $padding = 10; // Padding in mm
  $pdf->Cell(5, 10, '', 0, 0); // Left padding
  $pdf->Cell(42, 10, '', 0, 0, 'L'); // Data for the Item column

  $pdf->Cell($padding, 10, '', 0, 0); // Left padding
  $pdf->Cell(37, 10, '', 0, 0, 'L'); // Data for the Description column

  $pdf->Cell($padding, 10, '', 0, 0); // Left padding
  $pdf->Cell(24, 10, 'SST(6%):', 0, 0, 'L'); // Data for the Quantity column

  $sst = $subtotal * 0.06; // Calculate the 
  $formattedSst = 'RM ' . number_format($sst, 2); // Format the SST
  $pdf->SetFont('Arial', 'B', 12); // Set font to Arial, Bold, 12 pt
  $pdf->Cell($padding, 10, '', 0, 0); // Left padding
  $pdf->Cell(52, 10, $formattedSst, 0, 1, 'L'); // Data for the Price column


  $pdf->SetFont('Arial', '', 12); // Set font to Arial, Bold, 12 pt
  // Set the fill color to light gray (RGB: 200, 200, 200)
  $pdf->SetFillColor(234, 234, 234);

  $pdf->Cell(0, 10, '', 0, 1);
  // Header
  $padding = 10; // Padding in mm
  $pdf->Cell(5, 10, '', 0, 0, '', true); // Left padding
  $pdf->Cell(63, 10, 'Card Info', 0, 0, 'L', true); // Header for the Item column

  $pdf->Cell($padding, 10, '', 0, 0, '', true); // Left padding
  $pdf->Cell(50, 10, 'Pay By', 0, 0, 'L', true); // Header for the Quantity column

  $pdf->Cell($padding, 10, '', 0, 0, '', true); // Left padding
  $pdf->Cell(52, 10, 'Total Price', 0, 1, 'L', true); // Header for the Price column

  $pdf->Cell(0, 5, '', 0, 1);
  // Data


  $pdf->SetFont('Arial', '', 10); // Set font to Arial, Regular, 10pt
  $pdf->Cell(5, 10, '', 0, 0, ''); // Left padding
  $pdf->Cell(19, 10, 'Card No:', 0, 0, 'L'); // Print "1" in regular font

  $pdf->SetFont('Arial', 'B', 10); // Set font to Arial, Bold, 10pt
  $formattedCardNumber = ''; // Initialize the variable
  if (strlen($cardNumber) == 17) { // If the card number is "3488 888888 88887"
    $formattedCardNumber = substr_replace($cardNumber, '******', 5, 6);
  } else if (strlen($cardNumber) == 19) { // If the card number is "9999 9999 9999 9999"
    $formattedCardNumber = substr_replace($cardNumber, '**** ****', 5, 9);
  }

  $pdf->Cell(44, 10, $formattedCardNumber, 0, 0, 'L'); // Print the formatted card number

  $pdf->SetFont('Arial', 'B', 20); // Set font to Arial, Regular, 10pt
  $pdf->Cell($padding, 10, '', 0, 0, ''); // Left padding
  $pdf->Cell(50, 10, $ContactPerson, 0, 0, 'L'); // Data for the Quantity column

  $pdf->SetTextColor(255, 0, 0); // RGB color
  $pdf->SetFont('Arial', 'B', 24); // Set font to Arial, Regular, 10pt
  $pdf->Cell($padding, 10, '', 0, 0, ''); // Left padding
  $formattedTotalPrice = 'RM ' . number_format($totalPrice, 2); // Format the Total Price
  $pdf->Cell(52, 10, $formattedTotalPrice, 0, 1, 'L'); // Data for the Price column

  $pdf->Cell(0, 5, '', 0, 1);

  // Or move the line up by adding a negative line break
  $pdf->Ln(1); // Move up by 1mm
  $pdf->SetDrawColor(234, 234, 234); // RGB color
  $pdf->Cell(190, 0.01, '', 1, 1); // Create a cell with a height of 0.2mm and a width of 190mm

  $pdf->Cell(0, 10, '', 0, 1);

  $pdf->SetTextColor(0, 0, 0); // RGB color
  $pdf->SetFont('Arial', 'B', 24); // Set font to Arial, Bold, 12 pt
  $pdf->Cell(0, 10, 'Thank You!!', 0, 0, 'C'); // Right-aligned text

  $pdf->Output('F', 'C:/xampp/htdocs/FYP/Company/receipt/Job Post ' . $job_post_ID . ' Receipt.pdf');

  $receiptPath = '../Company/receipt/Job Post ' . $job_post_ID . ' Receipt.pdf';
  $sql = "UPDATE payment SET Payment_Receipt = '$receiptPath' WHERE PaymentID = $paymentId";
  $updateResult = mysqli_query($connect, $sql);

  if ($updateResult) {
    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com'; // Changed to Gmail's SMTP server
      $mail->SMTPAuth = true;
      $mail->Username = 'gecjobfacts888@gmail.com'; // Your Gmail address
      $mail->Password = 'atteeyliyxloitmo'; // Your Gmail password
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      //Recipients
      $mail->setFrom('gecjobfacts888@gmail.com', 'GEC Job Facts');
      $mail->addAddress($CompanyEmail, $CompanyName);

      //Attachments
      $mail->addAttachment('C:/xampp/htdocs/FYP/Company/receipt/Job Post ' . $job_post_ID . ' Receipt.pdf');

      //Content
      $mail->isHTML(true);
      $mail->Subject = 'Payment Receipt';
      $mail->Body = '
<html>
<head>
  <style>
    .email-content {
      font-family: Arial, sans-serif;
    }
    .email-content .header {
      color: #333;
      font-size: 24px;
    }
    .email-content .body {
      color: #666;
      font-size: 16px;
    }
    .email-content .footer {
      color: #999;
      font-size: 12px;
    }
  </style>
</head>
<body>
  <div class="email-content">
    <div class="header">Dear ' . $ContactPerson . ',</div>
    <div class="body">
    <p>Thank you for your purchasing. Please find attached the PDF receipt.</p>
    </div>
    <div style="height:20px"></div>
    <div class="footer">Best regards,<br> GEC Job Facts.</div>
  </div>
</body>
</html>';

      $mail->send();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    echo 'success';

  } else {
    echo 'error';
  }
} else {
  echo 'error';
}
