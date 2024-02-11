<?php 
    session_start();
    require 'C:/xampp/htdocs/FYP/dataconnection.php';
    require('C:/xampp/htdocs/final_fyp/FYP/Company/fpdf.php');

    if(isset($_GET['payment_id'])) {
        $payment_id = mysqli_real_escape_string($connect, $_GET['payment_id']);

        // Step 1: Retrieve Payment and JobID associated with the payment_id
        $payment_query = "SELECT * FROM payment WHERE PaymentID='$payment_id'";
        $payment_query_run = mysqli_query($connect, $payment_query);

        if ($payment_query_run) {
            // 查询成功
            $payment = mysqli_fetch_array($payment_query_run);
            $job_id = $payment['JobID'];
            $company_id = $payment['CompanyID'];

            // Step 2: Use JobID to fetch Job_Post_ID and related data
            $job_query = "SELECT * FROM job_post WHERE Job_Post_ID='$job_id'";
            $job_query_run = mysqli_query($connect, $job_query);

            if ($job_query_run) {
                // 查询成功
                $job_data = mysqli_fetch_array($job_query_run);

                // Step 3: Use CompanyID to fetch data from companies table
                $company_query = "SELECT * FROM companies WHERE CompanyID='$company_id'";
                $company_query_run = mysqli_query($connect, $company_query);

                if ($company_query_run) {
                    // 查询成功
                    $company_data = mysqli_fetch_array($company_query_run);

                    // 最后返回结果
                    $res = [
                        'status' => 200,
                        'message' => 'Payment, Job, and Company Data Fetch Successfully by id',
                        'data' => [
                            'payment' => $payment,
                            'job' => $job_data,
                            'company' => $company_data
                        ]
                    ];
                    echo json_encode($res);
                    return;
                } else {
                    // 查询失败
                    $res = [
                        'status' => 404,
                        'message' => 'Company Data Not Found'
                    ];
                    echo json_encode($res);
                    return;
                }
            } else {
                // 查询失败
                $res = [
                    'status' => 404,
                    'message' => 'Job Data Not Found'
                ];
                echo json_encode($res);
                return;
            }
        } else {
            // 查询失败
            $res = [
                'status' => 404,
                'message' => 'Payment Id Not Found'
            ];
            echo json_encode($res);
            return;
        }
    }
    
    if(isset($_GET['paymentid'])) {
        $paymentid = $_GET['paymentid'];
        $sql = "SELECT * FROM payment WHERE PaymentID = $paymentid";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        if(!empty($row['CompanyID']))
        {
            $CompanyID = $row['CompanyID'];
            $sqlc = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
            $resultc = mysqli_query($connect, $sqlc);
            $rowc = mysqli_fetch_assoc($resultc);
        }
        if (!empty($row['JobID'])) {
        $job_post_ID = $row['JobID'];
        $sql = "SELECT * FROM job_post WHERE Job_Post_ID = $job_post_ID";
        $result = mysqli_query($connect, $sql);
        $rowj = mysqli_fetch_assoc($result);
        }
        $CompanyName = $rowc['CompanyName'];
        $CompanyEmail = $rowc['CompanyEmail'];
        $CompanyPhone = $rowc['CompanyPhone'];
        $ContactPerson = $rowc['ContactPerson'];
        $totalPrice = $row['Payment_Amount'];
        $postDuration = $row['Payment_Duration'];
        $JobTitle = $rowj['Job_Post_Title'];
        $AdStartDateFormatted = date('d M Y', strtotime($rowj['AdStartDate']));
        $AdEndDateFormatted = date('d M Y', strtotime($rowj['AdEndDate']));
        $cardNumber = $row['CreditCard_Number'];

        $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->SetMargins(10, 10, 10);

    $pdf->AddPage();
    // Insert an image
    $imagePath = 'vendors/images/logo.png'; // Replace with the path to your image
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
    // $AdStartDateFormatted = date('d M Y H:i:s', strtotime($AdStartDate));
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
    // $AdStartDateFormatted = date('d M Y', strtotime($AdStartDate));
    // $AdEndDateFormatted = date('d M Y', strtotime($AdEndDate));
    $dateRange = $AdStartDateFormatted . ' - ' . $AdEndDateFormatted;
    $pdf->SetXY(35, 80); // Position at 1 cm from bottom
    $pdf->SetFont('Arial', 'B', 12); // Set font to Arial, Bold, 24 pt
    $pdf->Cell(95, 10, $dateRange, 0, 0, 'L'); // Left-aligned text

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

    $pdf->SetXY(10, 100); // Position at 1 cm from bottom
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
    $pdf->Cell(0, 10, 'Thank You', 0, 0, 'C'); // Right-aligned text

    $pdf->Output('F', 'D:/Job_Post_' . $job_post_ID . '_Receipt.pdf');

    header('Content-Disposition: inline; filename="../Admin/receipt/Job Post ' . $job_post_ID . '_Receipt.pdf"');
    
    }
?>