<?php
require('fpdf.php');

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(10, 10, 10); // Set the margins to 10mm on each side

$pdf->AddPage();
// Insert an image
$imagePath = 'logo.png'; // Replace with the path to your image
$imageWidth = 50; // The width of the image
$imageX = (210 / 2) - ($imageWidth / 2); // 210 is the width of an A4 page in mm
$pdf->Image($imagePath, $imageX, 10, $imageWidth); // The image will be centered and the height will be calculated automatically

// Add a line of text under the image
$pdf->SetXY(-200, 40); // Position at 1 cm from bottom
$pdf->SetFont('Arial','B',24); // Set font to Arial, Bold, 12 pt
$pdf->Cell(0,0,'INVOICE',0,0,'C'); // Right-aligned text

// Add a line of text under the image
$pdf->SetXY(10, 50); // Position at 1 cm from bottom
$pdf->SetFont('Arial','B',16); // Set font to Arial, Bold, 24 pt
$pdf->Cell(95,10,'Infinion sdn bhd',0,0,'L'); // Left-aligned text
$pdf->SetXY(10, 60); // Position at 1 cm from bottom
$pdf->SetFont('Arial','',12); // Set font to Arial, Bold, 24 pt
$pdf->Cell(95,10,'Date Issued: ',0,0,'L'); // Left-aligned text
$pdf->SetXY(35, 60); // Position at 1 cm from bottom
$pdf->SetFont('Arial','B',12); // Set font to Arial, Bold, 24 pt
$pdf->Cell(95,10,'10 Jan 2018',0,0,'L'); // Left-aligned text
$pdf->SetXY(10, 70); // Position at 1 cm from bottom
$pdf->SetFont('Arial','',12); // Set font to Arial, Bold, 24 pt
$pdf->Cell(95,10,'Invoice No  : ',0,0,'L'); // Left-aligned text
$pdf->SetXY(35, 70); // Position at 1 cm from bottom
$pdf->SetFont('Arial','B',12); // Set font to Arial, Bold, 24 pt
$pdf->Cell(95,10,'4556',0,0,'L'); // Left-aligned text

$pdf->SetXY(105, 50); // Position at 1 cm from bottom
$pdf->SetFont('Arial','',12); // Set font to Arial, Bold, 24 pt
$pdf->Cell(95,10,'GEC JOB FACT',0,0,'R'); // Right-aligned text
$pdf->SetXY(105, 60); // Position at 1 cm from bottom
$pdf->SetFont('Arial','',12); // Set font to Arial, Bold, 24 pt
$pdf->Cell(95,10,'Jalan Ayer Keroh Lama',0,0,'R'); // Right-aligned text
$pdf->SetXY(105, 70); // Position at 1 cm from bottom
$pdf->SetFont('Arial','',12); // Set font to Arial, Bold, 24 pt
$pdf->Cell(95,10,'Bukit Beruang',0,0,'R'); // Right-aligned text
$pdf->SetXY(105, 80); // Position at 1 cm from bottom
$pdf->SetFont('Arial','',12); // Set font to Arial, Bold, 24 pt
$pdf->Cell(95,10,'75450, Melaka',0,0,'R'); // Right-aligned text

$pdf->SetXY(10, 100); // Position at 1 cm from bottom
$pdf->SetFont('Arial','',12); // Set font to Arial, Bold, 12 pt

// Set the fill color to light gray (RGB: 200, 200, 200)
$pdf->SetFillColor(234, 234, 234);

// Header
$padding = 10; // Padding in mm
$pdf->Cell(5,10,'',0,0,'', true); // Left padding
$pdf->Cell(42,10,'Description',0,0,'L', true); // Header for the Item column

$pdf->Cell($padding,10,'',0,0,'', true); // Left padding
$pdf->Cell(37,10,'Price(per month)',0,0,'L', true); // Header for the Description column

$pdf->Cell($padding,10,'',0,0,'', true); // Left padding
$pdf->Cell(34,10,'Quantity',0,0,'L', true); // Header for the Quantity column

$pdf->Cell($padding,10,'',0,0,'', true); // Left padding
$pdf->Cell(42,10,'SubTotal',0,1,'L', true); // Header for the Price column
$pdf->SetFont('Arial','',12); // Set font to Arial, regular, 12 pt

// Add some space before the data
$pdf->Cell(0,5,'',0,1);

// Data
$padding = 10; // Padding in mm
$pdf->Cell(5,10,'',0,0); // Left padding
$pdf->Cell(42,10,'1',0,0,'L'); // Data for the Item column

$pdf->Cell($padding,10,'',0,0); // Left padding
$pdf->Cell(37,10,'2',0,0,'L'); // Data for the Description column

$pdf->Cell($padding,10,'',0,0); // Left padding
$pdf->Cell(34,10,'3',0,0,'L'); // Data for the Quantity column

$pdf->SetFont('Arial','B',12); // Set font to Arial, Bold, 12 pt
$pdf->Cell($padding,10,'',0,0); // Left padding
$pdf->Cell(42,10,'4',0,1,'L'); // Data for the Price column
// Draw the line
// Or move the line up by adding a negative line break
$pdf->Ln(1); // Move up by 1mm
$pdf->SetDrawColor(234, 234, 234); // RGB color
$pdf->Cell(190,0.01,'',1,1); // Create a cell with a height of 0.2mm and a width of 190mm

$pdf->SetFont('Arial','',12); // Set font to Arial, Bold, 12 pt
$pdf->Cell(0,75,'',0,1);

$padding = 10; // Padding in mm
$pdf->Cell(5,10,'',0,0); // Left padding
$pdf->Cell(42,10,'',0,0,'L'); // Data for the Item column

$pdf->Cell($padding,10,'',0,0); // Left padding
$pdf->Cell(37,10,'',0,0,'L'); // Data for the Description column

$pdf->Cell($padding,10,'',0,0); // Left padding
$pdf->Cell(34,10,'SST(6%):',0,0,'L'); // Data for the Quantity column

$pdf->Cell($padding,10,'',0,0); // Left padding
$pdf->Cell(42,10,'4',0,1,'L'); // Data for the Price column

// Set the fill color to light gray (RGB: 200, 200, 200)
$pdf->SetFillColor(234, 234, 234);

$pdf->Cell(0,10,'',0,1);
// Header
$padding = 10; // Padding in mm
$pdf->Cell(5,10,'',0,0,'', true); // Left padding
$pdf->Cell(63,10,'Card Info',0,0,'L', true); // Header for the Item column

$pdf->Cell($padding,10,'',0,0,'', true); // Left padding
$pdf->Cell(60,10,'Pay By',0,0,'L', true); // Header for the Quantity column

$pdf->Cell($padding,10,'',0,0,'', true); // Left padding
$pdf->Cell(42,10,'Total Price',0,1,'L', true); // Header for the Price column

$pdf->Cell(0,5,'',0,1);
// Data


$pdf->SetFont('Arial','',10); // Set font to Arial, Regular, 10pt
$pdf->Cell(5,10,'',0,0,''); // Left padding
$pdf->Cell(19,10,'Card No:',0,0,'L'); // Print "1" in regular font

$pdf->SetFont('Arial','B',10); // Set font to Arial, Bold, 10pt
$pdf->Cell(44,10,'A',0,0,'L'); // Print "A" in bold

$pdf->SetFont('Arial','B',20); // Set font to Arial, Regular, 10pt
$pdf->Cell($padding,10,'',0,0,''); // Left padding
$pdf->Cell(60,10,'2',0,0,'L'); // Data for the Quantity column

$pdf->SetTextColor(255, 0, 0); // RGB color
$pdf->SetFont('Arial','B',24); // Set font to Arial, Regular, 10pt
$pdf->Cell($padding,10,'',0,0,''); // Left padding
$pdf->Cell(42,10,'3',0,1,'L'); // Data for the Price column

$pdf->Cell(0,5,'',0,1);

// Or move the line up by adding a negative line break
$pdf->Ln(1); // Move up by 1mm
$pdf->SetDrawColor(234, 234, 234); // RGB color
$pdf->Cell(190,0.01,'',1,1); // Create a cell with a height of 0.2mm and a width of 190mm

$pdf->Cell(0,10,'',0,1);

$pdf->SetTextColor(0, 0, 0); // RGB color
$pdf->SetFont('Arial','B',24); // Set font to Arial, Bold, 12 pt
$pdf->Cell(0,10,'Thank You!!',0,0,'C'); // Right-aligned text

$pdf->Output();
?>